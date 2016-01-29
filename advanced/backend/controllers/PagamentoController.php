<?php

namespace backend\controllers;

use backend\models\Categorias;
use backend\models\Inscricao;
use Yii;
use backend\models\Pagamento;
use backend\models\PagamentoSearch;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PagamentoController implements the CRUD actions for Pagamento model.
 */
class PagamentoController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Pagamento models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PagamentoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Pagamento model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Pagamento model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $session = Yii::$app->session;
        $id = $session->get('id');
        var_dump($id);
        $model = new Pagamento();
     //   $valor = Yii::$app->request->post('Inscricao')['idInscricao0'];


     //   return Json::encode($idInscricao);
           // QUERY
//         $idInsc = Pagamento::find()->select('pagamento.idInscricao')
//            ->from('pagamento')
//            ->join('INNER JOIN','inscricao','pagamento.idInscricao  = inscricao.idInscricao')
//            ->Where(['pagamento.idInscricao' => $id]);



      // $model->idInscricao = $idInsc;


  //      $idInsc = $model->findOne('');
      //  var_dump($idInsc);

       // var_dump($idInsc);
 //      return Json::encode($idInsc);
   //     $model->idInscricao = $idInsc->idInscricao;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            return $this->redirect(['view', 'id' => $model->idPagamento] );
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Pagamento model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idPagamento]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Pagamento model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Pagamento model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Pagamento the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Pagamento::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
