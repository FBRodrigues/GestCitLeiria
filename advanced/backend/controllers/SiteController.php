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

        $datasBD = Aluno::find()->select('DataNascimento');

        $datasSel = array();
       $datasSel = $datasBD->all();

        return $this->render('index',['datasSel' => $datasSel]);
    }

  /*  public function getDataNascimento ($dataNascimento){
        $date = Aluno::find()->select('DataNascimento')->all();
        $date = strtotime(date("Y-m-d", strtotime($date)));
        $date = date("Y-m-d", $date);
        return \yii\helpers\Json::encode($date);
    }*/
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


                    //Vai buscar o proximo mês
                    date_default_timezone_set("Europe/Lisbon");
                    $date = date("Y-m-d");
                    $date = strtotime(date("Y-m-d", strtotime($date)) . " +1 month");
                    $date = date("M", $date);
                    // vai buscar a data Atual
                    $date1 = date("Y-m-d ");
                    //traduz o mes de Ing para Por
                    $mes = $this->traduMes($date);


                    $model->select = implode(',', $emails);
                    $model->body = "Caro aluno, se ainda nao efectuou o pagamento da mensalidade tem ate o dia 8 do próximo mês de " . $mes . " para efectua-lo. Cumprimentos, \n\t\t\t"

                        . Yii::$app->user->identity->username .  ",\t" . $date1  ;
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




    public function actionPagamentos()
    {

       /*$emails = (array)Yii::$app->request->post('selection');
        $model = new ContactForm();
        $model->body = "paga o que deves Já";
        $emailsBD = Aluno::find()->select('Contato3_Email');
        $emailsSel = array();
        //if(empty($emailsSel)){

        //}
        $emailsSel = $emailsBD->all();
      //  $model->select = implode(",",$emailsSel);
      //  foreach($emailsSel as $value){

        //}

      //  foreach ($emailsBD->all() as $user) {
            // fazer o sting builder das variaveis
            //$model->select = explode(',',$emails);
          //  $str = implode(",", $emails);
            //   $str =substr($user,15);
         //   return \yii\helpers\Json::encode($emailsSel);

        //}
        return $this->render('contact', [
            'model' => $model,
            'emailsSel' => $emailsSel
        ]);*/
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
                ->setFrom(array(Yii::$app->params['adminEmail']=>'CITL Leiria'))
                ->setSubject($model->subject)
                ->setTextBody($model->body)

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
                Yii::$app->session->setFlash('error', 'Email não enviado.');
            }


        } else {

                  return $this->render('contact', [
                      'model' => $model,
                  ]);
              }

        }


}


