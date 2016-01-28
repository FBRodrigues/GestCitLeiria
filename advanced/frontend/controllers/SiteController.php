<?php
namespace frontend\controllers;

use Yii;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use frontend\models\AgendaForm;
use frontend\models\ListaAlunosForm;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\db;
use yii\widgets\ListView;
use yii\data\ActiveDataProvider;
use yii\db\ActiveRecord;


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
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
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
           // 'captcha' => [
            //    'class' => 'yii\captcha\CaptchaAction',
            //    'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            //],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        if (!\Yii::$app->user->isGuest) {
//            $user = \Yii::$app->user->TipoUtilizador;
//            if($user->TipoUtilizador == 'T'){
//                return $this->goAgenda();
//            }
//            if($user->TipoUtilizador == 'A'){
//                //return $this->goAgenda();
//            } else {
//                return $this->goHome();
//            }

        }

        return $this->render('index');
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            $tipoUtilizador = Yii::$app->user->identity->TipoUtilizador;
            if($tipoUtilizador == 'T'){
                return $this->goAgenda();
            }else if($tipoUtilizador == 'A'){
                return $this->goAgenda();
            }
            else {
                return $this->goBack();
            }

        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
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

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password was saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }


    public function actionAgenda()
    {

        $connection = new \yii\db\Connection([
            'dsn' => 'mysql:host=127.0.0.1;dbname=mydb',
            'username' => 'root',
            'password' => '',
        ]);

        $connection -> open();

        $command = $connection -> createCommand('SELECT * FROM aula');
        $command -> execute();
        $aulas = $command -> queryAll();



        //CENAS A LISVIEW  ---  ver find(), findAll(), findBySql()
        //na t� a encontrar a tabela
        /*
        $pesquisa = "SELECT * FROM aula";
        //$aula = new Aula();
        $dataProvider = new ActiveDataProvider([
            //'query' => $this->actionAgenda(),
            'query' => findBySql($pesquisa)->all(),
        ]);

        echo ListView::widget([
            'dataProvider' => $dataProvider,
            'itemView' => 'agenda'
        ]);
        */


        return $this->render('agenda', [
            'aulas' => $aulas
        ]);

    }

    public function actionListaAlunos()
    {
        $connection = new \yii\db\Connection([
            'dsn' => 'mysql:host=127.0.0.1;dbname=mydb',
            'username' => 'root',
            'password' => '',
        ]);

        $connection -> open();

        $command = $connection -> createCommand('SELECT * FROM aluno al, presenca p, aula au WHERE al.idAluno = p.Aluno_idAluno AND p.Aluno_idAluno = au.idAula AND au.idAula = $idAula');
        $command -> execute();
        $alunos = $command -> queryAll();


        return $this->render('listaAlunos', [
            'alunos' => $alunos
        ]);

    }




}
