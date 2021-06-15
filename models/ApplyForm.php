<?php

namespace app\models;

use Yii;
use app\models\BaseForm;
use app\models\Search;
use kartik\mpdf\Pdf;
use yii\helpers\ArrayHelper;

/**
 * ContactForm is the model behind the contact form.
 */
class ContactForm extends BaseForm
{
    public $phone;
    public $jobTitle;
    public $supplierId;
    public $cvfile;
    public $education;
    public $experiance;
    public $jobDetails;

    public function __construct($config = array())
    {
        parent::__construct($config);
        $this->experiance = Yii::t('app', 'Experiance');
        $this->education = Yii::t('app', 'Education');
    }

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        ArrayHelper::merge(
            parent::rules(),
            [
                // name, email, subject and body are required
                [['jobTitle', 'cvfile'], 'required'],
                ['supplierId', 'match', 'pattern' => '/^[a-zA-Z\d-]+$/i'],
                ['phone', 'match', 'pattern' => '/^0[0-9]{1,2}[-\s]{0,1}[0-9]{3}[-\s]{0,1}[0-9]{4}/i'],
                ['cvfile', 'file', 'extensions' => ['doc', 'docx', 'pdf', 'rtf'], 'checkExtensionByMimeType' => false],
            ]
        );
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return ArrayHelper::merge(
            parent::attributeLabels(),
            [
                'phone' => Yii::t('app', 'Phone'),
                'jobTitle' => Yii::t('app', 'Job Title'),
                'jobCode' => Yii::t('app', 'Job Code'),
                'searchArea' => Yii::t('app', 'Search Area'),
                'cvfile' => Yii::t('app', 'Attach CV file'),
                'supplierId' => Yii::t('app', 'Supplier Id'),
                'education' => Yii::t('app', 'Education'),
                'experiance' => Yii::t('app', 'Experiance'),
            ]
        );
    }


    protected function generateNcai()
    {
        $xmlData = '<NiloosoftCvAnalysisInfo xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema">' . "\r\n";
        $xmlData .= '  <ApplyingPerson>' . "\r\n";
        $xmlData .= '    <AccountManagerId xsi:nil="true"/>' . "\r\n";
        $xmlData .= '    <BirthDate xsi:nil="true"/>' . "\r\n";
        $xmlData .= '    <CardId>00000000-0000-0000-0000-000000000000</CardId>' . "\r\n";
        $xmlData .= '    <CreatedBy>0</CreatedBy>' . "\r\n";
        $xmlData .= '    <CreationDate xsi:nil="true"/>' . "\r\n";
        $xmlData .= '    <Email></Email>' . "\r\n";
        $xmlData .= '    <EntityLocalName>' . $this->firstname . ' ' . $this->lastname . '</EntityLocalName>' . "\r\n";
        $xmlData .= '    <HighestStage xsi:nil="true"/>' . "\r\n";
        $xmlData .= '    <IsParseAllAsTransient xsi:nil="true"/>' . "\r\n";
        $xmlData .= '    <LockLevelStatus>0</LockLevelStatus>' . "\r\n";
        $xmlData .= '    <ParentCardId xsi:nil="true"/>' . "\r\n";
        $xmlData .= '    <Phones/>' . "\r\n";
        $xmlData .= '    <Rank xsi:nil="true"/>' . "\r\n";
        $xmlData .= '    <RecruitedBy xsi:nil="true"/>' . "\r\n";
        $xmlData .= '    <SellsStatus xsi:nil="true"/>' . "\r\n";
        $xmlData .= '    <Status xsi:nil="true"/>' . "\r\n";
        $xmlData .= '    <StatusExpirationTime xsi:nil="true"/>' . "\r\n";
        $xmlData .= '    <UpdateDate>0001-01-01T00:00:00</UpdateDate>' . "\r\n";
        $xmlData .= '    <UpdatedBy>0</UpdatedBy>' . "\r\n";
        $xmlData .= '    <Gender>mail</Gender>' . "\r\n";
        $xmlData .= '    <NumberOfChildren xsi:nil="true"/>' . "\r\n";
        $xmlData .= '    <Role xsi:nil="true"/>' . "\r\n";
        $xmlData .= '    <SupplierApplicantId xsi:nil="true"/>' . "\r\n";
        $xmlData .= '    <SupplierExpirationTime xsi:nil="true"/>' . "\r\n";
        $xmlData .= '    <SupplierId>' . $this->supplierId . '</SupplierId>' . "\r\n";
        $xmlData .= '    <UserId xsi:nil="true"/>' . "\r\n";
        $xmlData .= '  </ApplyingPerson>' . "\r\n";
        $xmlData .= '  <Notes>' . "\r\n";
        $xmlData .=      $this->getAttributeLabel('name') . ': ' . $this->firstname . ' ' . $this->lastname . "\r\n";
        if ($this->jobDetails) {
            $xmlData .=      $this->getAttributeLabel('jobCode') . ': ' . $this->jobDetails->JobCode . "\r\n";
            $xmlData .=      $this->getAttributeLabel('jobTitle') . ': ' . $this->jobDetails->JobTitle . "\r\n";
        }
        $xmlData .= '  </Notes>' . "\r\n";
        $xmlData .= '  <SupplierId>' . $this->supplierId . '</SupplierId>' . "\r\n";
        $xmlData .= '</NiloosoftCvAnalysisInfo>' . "\r\n";

        $tmpFile = 'uploads/NlsCvAnalysisInfo.ncai';
        return file_put_contents($tmpFile, $xmlData) ? $tmpFile : false;
    }

    public function getJobs()
    {
        $search = new Search($this->supplierId);
        ArrayHelper::map($search->jobs(), 'JobId', 'JobTitle');
    }

    public function getYesnoOptions()
    {
        return [
            Yii::t('app', 'Yes') => Yii::t('app', 'Yes'),
            Yii::t('app', 'No') => Yii::t('app', 'No'),
        ];
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     * @param string $email the target email address
     * @return bool whether the model passes validation
     */
    public function contact($email, $content)
    {
        Yii::debug('Contact: Started', 'meni');
        if ($this->jobDetails) {
            $subject = Yii::t('app', 'New request - Elbit Campaign') . ' [' . $this->jobDetails->JobCode . ']';
        } else {
            $subject = Yii::t('app', 'New request - Elbit Campaign') . ' [הגשה למאגר הכללי]';
        }
        Yii::debug('Contact: Subject ' . $subject, 'meni');
        if (!$this->cvfile || empty($this->cvfile)) {
            $this->generateCv($content);
            Yii::debug('Contact: cv generated', 'meni');
        }

        $ncai = $this->generateNcai();
        if ($ncai !== false) {
            $this->tmpFiles[] = $ncai;
        }

        Yii::debug('Contact: NCAI generated', 'meni');

        Yii::debug("Contact: Mail: $email, Content: $content", 'meni');

        $message = Yii::$app->mailer->compose()
            ->setTo($email)
            ->setFrom([$email => Yii::$app->params['cvWebMailName']])
            //->setBcc('nurielmeni@gmail.com')
            ->setSubject($subject)
            ->setHtmlBody($content)
            ->setTextBody(strip_tags($content));

        foreach ($this->tmpFiles as $tmpFile) {
            $message->attach($tmpFile);
        }

        $res = $message->send();

        //Yii::debug("Contact: res: $res" , 'meni');
        return $res;
    }

    public function removeTmpFiles()
    {
        foreach ($this->tmpFiles as $tmpFile) {
            unlink($tmpFile);
        }
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     * @param string $email the target email address
     * @return bool whether email sent successfully
     */
    public function followUpMail($content)
    {
        $subject = 'אתר משרות כיןןן - בקשתך התקבלה';
        return Yii::$app->mailer->compose()
            ->setTo($this->email)
            ->setFrom([Yii::$app->params['fromMail'] => Yii::$app->params['fromName']])
            ->setSubject($subject)
            ->setHtmlBody($content)
            ->setTextBody(strip_tags($content))
            ->send();
    }

    public function generateCv($content)
    {
        // setup kartik\mpdf\Pdf component
        $pdf = new Pdf([
            // set to use core fonts only
            'mode' => Pdf::MODE_UTF8,
            // A4 paper format
            'format' => Pdf::FORMAT_A4,
            // portrait orientation
            'orientation' => Pdf::ORIENT_PORTRAIT,
            // stream to browser inline
            'destination' => Pdf::DEST_FILE,
            // your html content input
            'content' => $content,
            // format content from your own css file if needed or use the
            // enhanced bootstrap css built by Krajee for mPDF formatting 
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/src/assets/kv-mpdf-bootstrap.min.css',
            // any css to be embedded if required
            'cssInline' => '.kv-heading-1{font-size:18px}',
            // set mPDF properties on the fly
            'options' => ['title' => 'כיוון - קובץ קורות חיים אוטומטי'],
            // call mPDF methods on the fly
            'methods' => [
                'SetHeader' => ['כיוון - קורות חיים למועמד'],
                'SetFooter' => ['{PAGENO}'],
            ]
        ]);

        $tmpfile = Yii::getAlias('@webroot') . '/uploads/cvFile' . date('s', time()) . '.pdf';
        $pdf->output($content, $tmpfile, Pdf::DEST_FILE);
        $this->tmpFiles[] = $tmpfile;
        return true;
    }

    protected function sanitizeFileName($file, $ext = null)
    {
        // Remove anything which isn't a word, whitespace, number
        // or any of the following caracters -_~,;[]().
        // If you don't need to handle multi-byte characters
        // you can use preg_replace rather than mb_ereg_replace
        // Thanks @Łukasz Rysiak!
        $file = mb_ereg_replace("([^\w\s\d\-_~,;\[\]\(\).])", '', $file);
        // Remove any runs of periods (thanks falstro!)
        $file = mb_ereg_replace("([\.]{2,})", '', $file);
        return $ext ? ($file . '.' . $ext) : $file;
    }

    public function upload()
    {
        $tmpFile = 'uploads/' . $this->sanitizeFileName($this->cvfile->baseName, $this->cvfile->extension);
        if ($this->cvfile->saveAs($tmpFile)) {
            $this->tmpFiles[] = $tmpFile;
        }
        return true;
    }

    public function getJobCode()
    {
        $jobCode = $this->jobTitle;
        return $jobCode;
    }
}
