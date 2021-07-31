<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\ApplyForm;
use app\models\Search;
use yii\web\UploadedFile;
use app\helpers\Helper;
use app\controllers\BaseController;

class SiteController extends BaseController
{
    public $defaultAction = 'contact';

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            // 'access' => [
            //     'class' => AccessControl::className(),
            //     'only' => ['logout'],
            //     'rules' => [
            //         [
            //             'actions' => ['logout'],
            //             'allow' => true,
            //             'roles' => ['@'],
            //         ],
            //     ],
            // ],
            // 'verbs' => [
            //     'class' => VerbFilter::className(),
            //     'actions' => [
            //         'logout' => ['post'],
            //     ],
            // ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }


    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        $this->layout = 'main_admin';
        if (!Yii::$app->user->isGuest) {
            return $this->redirect(['/site/index']);
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect(['/site/index']);
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        $this->layout = 'main_admin';
        Yii::$app->user->logout();

        return $this->redirect(['/site/index']);
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionIndex()
    {
        $apply = new ApplyForm();
        $contact = new ContactForm();
        $search = new Search(Yii::$app->params['supplierId']);

        return $this->render('index', [
            'apply' => $apply,
            'contact' => $contact,
            'categories' => $search->categories,
            'locations' => $search->locations
        ]);
    }

    public function actionSearch()
    {
        $request = Yii::$app->request;
        if (!$request->isAjax) {
            $this->redirect('/');
        }

        $response = Yii::$app->response;

        $categories = explode(',', $request->post('categories', ""));
        $regions = explode(',', $request->post('regions', ""));

        $model = new Search();
        $jobs = $model->jobs($categories, $regions);

        if (is_array($jobs) && count($jobs) > 0) {
            return $this->renderAjax('searchResults', ['jobs' => $jobs]);
        } else {
            return $this->renderAjax('noResults');
        }
        Yii::$app->end();
    }

    public function actionApply()
    {
        $request = Yii::$app->request;
        if (!$request->isAjax) {
            Yii::$app->end();
        }

        $model = new ApplyForm();
        $model->load($request->post());
        $model->supplierId = Yii::$app->request->post('sid', Yii::$app->params['supplierId']);
        $model->jobCode = Yii::$app->request->post('jobCode');
        $model->jobId = Yii::$app->request->post('jobId');


        $model->cvfile = UploadedFile::getInstance($model, 'cvfile');
        if (!$model->cvfile || !$model->upload()) {
            // File not uploaded succesfully
            return $this->renderAjax('error/_errorCvFile');
        }

        if ($model->applicationMail(
            $this->renderPartial('_cvView', [
                'model' => $model,
            ])
        )) {
            $model->removeTmpFiles();
            return $this->renderAjax('success/_submitSuccess', ['jobCode' => Helper::getObjValue($model, 'jobCode')]);
        } else { // Failed to send the CV
            $model->removeTmpFiles();
            return $this->renderAjax('error/_submitError');
        };

        Yii::$app->end();
    }

    public function actionContact()
    {
        $request = Yii::$app->request;
        if (!$request->isAjax) {
            Yii::$app->end();
        }

        $model = new ContactForm();
        $model->email = Yii::$app->params['contactMail'];
        $model->load($request->post());

        if ($model->contactMail()) {
            return $this->renderAjax('success/_contactSuccess');
        } else { // Failed to send the contact
            return $this->renderAjax('error/_contactError');
        };

        Yii::$app->end();
    }
}
