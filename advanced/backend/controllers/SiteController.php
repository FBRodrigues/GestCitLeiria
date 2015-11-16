<?php
namespace backend\controllers;

use backend\models\Aluno;
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



        $emails =(array)Yii::$app->request->post('selection');
        //return \yii\helpers\Json::encode($emails);
        if((empty($emails))){

            $model = new Aluno();
            $searchModel = new \backend\models\AlunoSearch();
           $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
            Yii::$app->session->setFlash('error', 'Não tem nenhum email selecionado!');
            return $this->render('..\aluno\index',
                ['model'=>$model,
                    'searchModel'=>$searchModel,
                    'dataProvider'=>$dataProvider
            ]);

            $this->refresh();


        }else {

            $model = new ContactForm();
            $model->select =implode(',', $emails);
            return $this->render('contact', [
                'model' => $model,

            ]);
        }
        //return $this->render('aluno/index', [
           // 'model' => $model,



     //   $model->emails =(array) Yii::$app->request->post('selection1');

//        return \yii\helpers\Json::encode($model->select);
  // $emails= implode(",",$selection);



    }
    public function actionPagamentos()
    {

        $model = new ContactForm();
     //   $model->select =implode(',', (array)Yii::$app->request->post('selection'));
        //   $model->emails =(array) Yii::$app->request->post('selection1');

//        return \yii\helpers\Json::encode($model->select);
        // $emails= implode(",",$selection);

      //  $emails =  Aluno::find()->select('Contato3_Email')->all();
       // return \yii\helpers\Json::encode($emails);

        return $this->render('contact', [
            'model' => $model,

        ]);


    }

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


