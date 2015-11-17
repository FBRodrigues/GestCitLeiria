<?php
namespace backend\controllers;

use backend\models\Aluno;
use common\widgets\Alert;
use frontend\models\AlunoSearch;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\Json;
use yii\helpers\Url;
use yii\web\Controller;
use common\models\LoginForm;
use yii\filters\VerbFilter;
use backend\models\ContactForm;
use backend\models\AlunoForm;
use yii\helpers\BaseStringHelper;
use yii\helpers\StringHelper;


/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,

                    ],
                    [
                        'actions' => ['logout', 'index', 'contact', 'init','pagamentos'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],

                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
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

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /* public function actionAluno()
     {
         $model = new AlunoForm();

         if ($model->load(Yii::$app->request->post())) {
             if ($model->validate()) {
                 // form inputs are valid, do something here
                 return;
             }
         }

         return $this->render('aluno', [
             'model' => $model,
         ]);
     }*/


    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * @return string|\yii\web\Response
     */
    public function actionInit()
    {
        $emails = (array)Yii::$app->request->post('selection');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            if (isset($_POST['paga'])) {
                // btnPaga
                if ((empty($emails))) {

                    $model = new Aluno();
                    $searchModel = new \backend\models\AlunoSearch();
                    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

                    Yii::$app->session->setFlash('error', 'Não tem nenhum email selecionado!');
                    return $this->render('..\aluno\index',
                        ['model' => $model,
                            'searchModel' => $searchModel,
                            'dataProvider' => $dataProvider
                        ]);

                    $this->refresh();

                } else {

                    $model = new ContactForm();

                    $nome = "Fábio";
                    $date = date("Y-m-d");
                    $date = strtotime(date("Y-m-d", strtotime($date)) . " +1 month");
                    $date = date("M", $date);
                   $mes = $this->traduMes($date);


                    $model->select = implode(',', $emails);
                    $model->body = "Caro aluno," . $nome . "
                     se ainda nao efectuou o pagamento da mensalidade tem ate o dia 8 do próximo mês de "
                        . $mes . " para efectua-lo.
                    Cumprimentos, " . Yii::$app->user->identity->username;
                    $model->subject = "Pagamentos";
                    $model->name = "cenas";
                    return $this->render('contact', [
                        'model' => $model,

                    ]);
                }

            } else {
                //botão formal
                if ((empty($emails))) {

                    $model = new Aluno();
                    $searchModel = new \backend\models\AlunoSearch();
                    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

                    Yii::$app->session->setFlash('error', 'Não tem nenhum email selecionado!');
                    return $this->render('..\aluno\index',
                        ['model' => $model,
                            'searchModel' => $searchModel,
                            'dataProvider' => $dataProvider
                        ]);

                    $this->refresh();


                } else {

                    $model = new ContactForm();
                    $model->select = implode(',', $emails);
                    return $this->render('contact', [
                        'model' => $model,

                    ]);
                }

            }
        }
    }

        public function  traduMes($mes){
        switch($mes){
            case "Jan":
                $mes = "Janeiro";
            case "Feb":
                $mes = "Fevereiro";
            case "Mar":
                $mes = "Março";
            case "Apr":
                $mes = "Abril";
            case "May":
                $mes = "Maio";
            case "Jun":
                $mes = "Junho";
            case "Jul":
                $mes = "Julho";
            case "Aug":
                $mes = "Agosto";
            case "Sep":
                $mes = "Setembro";
            case "Oct":
                $mes = "Outubro";
            case "Nov":
                $mes ="Novembro";
            case  "Dec":
                $mes = "Dezembro";
        }
        return $mes;
    }
        //return $this->render('aluno/index', [
           // 'model' => $model,



     //   $model->emails =(array) Yii::$app->request->post('selection1');

//        return \yii\helpers\Json::encode($model->select);
  // $emails= implode(",",$selection);






    public function actionPagamentos()
    {

        $emails = (array)Yii::$app->request->post('selection');
        $model = new ContactForm();
        $model->body = "paga o que deves Já";
        $emails = Aluno::find()->select('Contato3_Email')->all();
        foreach ($emails as $user) {
            // fazer o sting builder das variaveis
            //$model->select = explode(',',$emails);
            $str = implode(",", $emails);
            //   $str =substr($user,15);
            return \yii\helpers\Json::encode($str);

        }
    }

        //$messages = [];

        //$user= $model->select;


      /*  if ($model->load(Yii::$app->request->post()) && $model->validate()) {

          //  $email_array = explode(",",$model->select);
            $messages = Yii::$app->mailer->compose()
                ->setTo($model->select)
                //->setTo(['dest@x.pt', 'abc@x.pt'])
                ->setFrom(array(Yii::$app->params['adminEmail']=>'CITL Leiria'))
                ->setSubject($model->subject)
                ->setTextBody($model->body)
                //        ->setTextBody($model->select)
            ;
            var_dump($messages->toString());
            $resultado= $messages->send();

            var_dump($resultado);

            if ($resultado) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending email.');
            }

            return $this->refresh();
        } else {

            return $this->render('contact', [
                'model' => $model,
            ]);
        }*/





    public function actionContact()
    {
        $model= new ContactForm();
        $messages = [];

        //$user= $model->select;


        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            $email_array = explode(",",$model->select);
            $messages = Yii::$app->mailer->compose()
                ->setTo($email_array)
//              ->setTo(['dest@x.pt', 'abc@x.pt'])
                ->setFrom(array(Yii::$app->params['adminEmail']=>'CITL Leiria'))
                ->setSubject($model->subject)
                ->setTextBody($model->body)
        //        ->setTextBody($model->select)
                ;
            var_dump($messages->toString());
            $resultado= $messages->send();

            var_dump($resultado);

          /*  foreach ($users as $user) {
                $messages[] = Yii::$app->mailer->compose()
                    ->setFrom(Yii::$app->params['adminEmail'])
                    ->setTo($user)
                    ->setSubject($model->subject)
                    ->setHtmlBody($model->body)
                    ->send();
            }*/


            if ($resultado) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending email.');
            }

            return $this->refresh();
        } else {

                  return $this->render('contact', [
                      'model' => $model,
                  ]);
              }

        }


}


