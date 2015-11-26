<?php
namespace backend\controllers;

use backend\models\Aluno;
use common\widgets\Alert;
use Faker\Provider\DateTime;
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
use yii\web\JsExpression;


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
                        'actions' => ['logout', 'index', 'contact', 'init','delete'],
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

    /**
     * @return string
     */
    public function actionIndex()
    {

        $datasBD = Aluno::find();
        $datasSel = array();
        $datasSel = $datasBD->all();

        //  return \yii\helpers\Json::encode($datasSel);
        return $this->render('index',
            ['datasSel' => $datasSel]);
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
        $action = Yii::$app->request->post('action');

      /*  switch($action){
            case 'pPag':
                break;
            case 'ePer':
                break;
            default :
                break;
        }*/

        if ($action == 'pPag') {
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
                //Vai buscar o proximo mês
                date_default_timezone_set("Europe/Lisbon");
                $date = date("Y-m-d");
                $date = strtotime(date("Y-m-d", strtotime($date)) . " +1 month");
                $date = date("M", $date);
                // vai buscar a data Atual
                $date1 = date("Y-m-d ");
                //traduz o mes de Ing para Por
                $mes = $this->traduMes($date);
                $model->emails_selecionados = implode(',', $emails);
                $model->mensagem = "Caro aluno, se ainda nao efectuou o pagamento da mensalidade tem ate o dia 8 do próximo mês de " . $mes . " para efectua-lo. Cumprimentos, \n\t\t\t"
                 . Yii::$app->user->identity->username . ", " . $date1;
                $model->assunto = "Pagamentos";
                $model->name = "cenas";
                return $this->render('contact', [
                    'model' => $model,
                    'emails'=> $emails,
           ]);
            }

        } else if($action == 'ePer') {
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
                    $model->emails_selecionados = implode(',', $emails);
                    return $this->render('contact', [
                        'model' => $model,
                        'emails'=> $emails,

                    ]);


            }
        }else {
            $model = new Aluno();
            $searchModel = new \backend\models\AlunoSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
            Yii::$app->session->setFlash('error', 'Escolha uma opção!');
            return $this->render('..\aluno\index',
                ['model' => $model,
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider
                ]);

            $this->refresh();

        }
    }
    public function  traduMes($mes){
        switch($mes){
            case "Jan":
                $mes = "Janeiro";
                break;
            case "Feb":
                $mes = "Fevereiro";
                break;
            case "Mar":
                $mes = "Março";
                break;
            case "Apr":
                $mes = "Abril";
                break;
            case "May":
                $mes = "Maio";
                break;
            case "Jun":
                $mes = "Junho";
                break;
            case "Jul":
                $mes = "Julho";
                break;
            case "Aug":
                $mes = "Agosto";
                break;
            case "Sep":
                $mes = "Setembro";
                break;
            case "Oct":
                $mes = "Outubro";
                break;
            case "Nov":
                $mes ="Novembro";
                break;
            case  "Dec":
                $mes = "Dezembro";
                break;
        }
        return $mes;
    }



    public function actionContact()
    {

        $model= new ContactForm();
        $messages = [];

        //$user= $model->select;


        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            $email_array = explode(",",$model->emails_selecionados);
            $messages = Yii::$app->mailer->compose()


                ->setTo($email_array)
                ->setFrom(array(Yii::$app->params['adminEmail']=>'CITL Leiria'))
                ->setSubject($model->assunto)
                ->setTextBody($model->mensagem)

                ;
            $messages->toString();
            $resultado= $messages->send();
         if ($resultado) {
                Yii::$app->session->setFlash('success', 'Email enviado com sucesso!');
                $model = new Aluno();
                $searchModel = new \backend\models\AlunoSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

                return $this->render('..\aluno\index',
                    ['model' => $model,
                        'searchModel' => $searchModel,
                        'dataProvider' => $dataProvider
                    ]);

                return $this->refresh();
            } else {
                Yii::$app->session->setFlash('error', 'Email não enviado!');
            }


        } else {

                  return $this->render('contact', [
                      'model' => $model,
                  ]);
              }

        }

    public function actionDelete($valor)
    {

        //$model = new ContactForm();
       // if( var_dump($valor)==$model->emails_selecionados){
         //a   $model->emails_selecionados->delete();
         //   return $this->redirect(['contact']);
        //}
       // return $this->redirect(['index']);
    }


}


