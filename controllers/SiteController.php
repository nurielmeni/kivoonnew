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
            $this->redirect('/',);
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
        $jobs = $request->post('jobs');
        $idnumber = $request->post('idnumber');
        $name = $request->post('name');

        if (empty($jobs)) {
            return $this->asJson(['status' => 'error', 'html' => $this->renderPartial('_errorNoJobs')]);
            Yii::$app->end();
        }

        $jobs = $jobs === "null" ? [] : explode(',', $jobs);

        $campaignid = $request->post('campaignid');
        $campaign = $this->validCampaign($campaignid);

        $model = new ContactForm();
        $model->supplierId = Yii::$app->request->get('sid', Yii::$app->params['supplierId']);

        $count = 0;
        if ($model->load(Yii::$app->request->post(), '')) {
            $model->cvfile = UploadedFile::getInstance($model, 'cvfile');
            if ($model->cvfile) $model->upload();

            if (count($jobs) === 0) {
                $count += $this->applyJob($model);
            } else {
                foreach ($jobs as $job) {
                    $count += $this->applyJob($model, trim($job));
                }
            }

            $model->removeTmpFiles();

            $campaign->apply += $count;
            $campaign->save(false, ['apply']);
        }

        return count($jobs) === 0
            ? $this->asJson(['status' => 'success', 'html' => $this->renderPartial('_submitGeneralSuccess')])
            : $this->asJson(['status' => 'success', 'html' => $this->renderPartial('_submitSuccess', ['count' => $count])]);
    }

    private function applyJob($model, $job = null)
    {
        if ($job) {
            $search = new Search($model->supplierId);
            $model->jobDetails = $search->getJobById($job);
        } else {
            $model->jobDetails = null;
        }

        return $model->contact(Yii::$app->params['cvWebMail'], $this->renderPartial('_cvView', [
            'model' => $model,
        ]));
    }
}
