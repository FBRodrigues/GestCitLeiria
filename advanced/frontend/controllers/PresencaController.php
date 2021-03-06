<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Presenca;
use frontend\models\PresencaSearch;
use frontend\models\Aula;
use frontend\models\Aluno;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PresencaController implements the CRUD actions for Presenca model.
 */
class PresencaController extends Controller
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
     * Lists all Presenca models.
     * @return mixed
     */



    public function actionIndex()
    {
        $searchModel = new PresencaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        //receber um idAula
        $idAula = Yii::$app->getRequest()->getQueryParam('idAula');
        $aula = Aula::findOne($idAula);

        $listaAlunos = $aula->alunos;

        $listaPresencas = $this->getPresencasPorIDAula($idAula);

        return $this->render('index', [
            'listaAlunos' => $listaAlunos,
            'listaPresencas' => $listaPresencas,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Presenca model.
     * @param integer $idPresenca
     * @param integer $Aula_idAula
     * @return mixed
     */
    public function actionView($idAula)
    {

          $aula = Aula::findOne($idAula);

        //$listaAlunos = Yii::$app->request->post('aulas');
        $listaAlunos = $aula->alunos;
        $idAula = Yii::$app->getRequest()->getQueryParam('idAula');

        $listaPresencas = $this->getPresencasPorIDAula($idAula);
        //vetor acociativo

      //  return \yii\helpers\Json::encode([$aula,$listaAlunos]);
        //$presencas = $aula->presencas;
        //$listaAlunos = $this->getAlunosPorIDPresenca($idGetPresenca);

        //$variavel = 'Qualquer coisa';
      return $this->render('view', [
          'listaAlunos' => $listaAlunos,
//          'listaPresencas' => $listaPresencas,
//            'aula' => $this->findModel($idAula , $idAula),
            'alunosInscritos' => $aula->getAlunosInscritos($idAula),
            'model' => $aula,
          //'idGetPresenca' => $idGetPresenca,
        ]);


        //return \yii\helpers\Json::encode([$aula, $listaAlunos]);
    }

    /**
     * Creates a new Presenca model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */







    public function actionCreate()
    {
        $model = new Presenca();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'idPresenca' => $model->idPresenca, 'Aula_idAula' => $model->Aula_idAula]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Presenca model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $idPresenca
     * @param integer $Aula_idAula
     * @return mixed
     */
    public function actionUpdate($Aula_idAula)
    {

        $aula = Yii::$app->request->post('Aula');

//        foreach($aula['presencas'] as $presenca){
//
//            $model = $this->findModel($presenca['idPresenca'],$Aula_idAula);
//
//            if ($model->load($presenca) && $model->save()) {
//
//            }
//        }

        $model = $this->findModel($aula['presencas']['idPresenca'], $Aula_idAula);

        if ($model->load($aula['presencas']) && $model->save()) {
            //return $this->redirect(['view', 'idPresenca' => $model->idPresenca, 'Aula_idAula' => $model->Aula_idAula]);
        } else {
            var_dump($aula['presencas']);
            var_dump($model->load($aula['presencas']));
        }
    }

    /**
     * Deletes an existing Presenca model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $idPresenca
     * @param integer $Aula_idAula
     * @return mixed
     */
    public function actionDelete($idPresenca, $Aula_idAula)
    {
        $this->findModel($idPresenca, $Aula_idAula)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Presenca model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $idPresenca
     * @param integer $Aula_idAula
     * @return Presenca the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($idPresenca, $Aula_idAula)
    {
        if (($model = Presenca::findOne(['idPresenca' => $idPresenca, 'Aula_idAula' => $Aula_idAula])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    //Invocar métodos do search
    public function getPresencasPorIDAula($idAula){
        $searchModel = new PresencaSearch();
        $presencas = $searchModel->procurarPresencasPorIDAula($idAula);

        return $presencas;
    }

    public static function PresenteOuNao($presente){
        if($presente == 1){
            return true;
        } elseif($presente == 0){
            return false;
        } else{
            return -1;
        }
    }

    /*
    public function getPresent($idAluno, $listaAlunos){
        foreach($listaAlunos as $aluno){
            if($aluno->idAluno == $idAluno){
                return $aluno->presente;
            }
        }
        return null;
    }
    */

    /*
    public function getAlunosPorIDPresenca($idPresenca){
        $searchModel = new PresencaSearch();
        $alunos = $searchModel->procuraAlunosPorIDPesenca($idPresenca);

        return $alunos;
    }
    */

}
