<?php

namespace frontend\controllers;

use frontend\models\Presenca;
use Yii;
use frontend\models\Aula;
use frontend\models\Treinador;
use frontend\models\Turma;
use frontend\models\AulaSearch;
use frontend\models\AlunoSearch;
use frontend\models\Aluno;
use yii\data\ArrayDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AulaController implements the CRUD actions for Aula model.
 */
class AulaController extends Controller
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
     * Lists all Aula models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AulaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $idUser = Yii::$app->user->getId();
        $treinador = Treinador::find()->where(['Id_User' => $idUser])->one();

        $aulas_turma = Turma::find()->where(['Treinador_idTreinador' => $treinador->idTreinador])->all();

        $aulas = [];

        foreach($aulas_turma as $index => $aula_turma){
            $aula = Aula::findOne($aula_turma->Aula_idAula);
            array_push($aulas, $aula);
        }

        $dataProvider = new ArrayDataProvider(['allModels' => $aulas]);
      //$aulas = Aula::find()->where(['idAula' => $aulas_turma->Aula_idAula]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'aulas' => $aulas,
        ]);
    }

    /**
     * Displays a single Aula model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $searchModelAluno = new AlunoSearch();
        $dataProvider = $searchModelAluno->search(Yii::$app->request->queryParams, $id);
        $dataProviderAluno = Aluno::find()->all();


        $aula = Aula::findOne($id);
        //$dataProvider = $aula->alunos; */

        $alunos = [];
        foreach($dataProviderAluno as $aluno){
            $alunos[$aluno->idAluno] = $aluno->Nome;
        }

        $array =  $aula->getAlunosInscritos($aula->idAula);

        return $this->render('view', [
            'model' => $this->findModel($id),
            //'presencas' => Presenca::find()->where(['idAula' => $aula->idAula]),
            'dataProvider' => $dataProvider,
            'alunosInscritos' =>$array,
            'alunos' => $alunos
        ]);
    }




    /**
     * Creates a new Aula model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Aula();

        $presencas = Yii::$app->request->post('Aula')['presencas'];

        if($presencas != 0){
            if ($model->load(Yii::$app->request->post()) && $model->save()) {


                if($presencas == 0){
                    echo 'Não selecionou nenhum aluno';
                    return $this->render('create', [
                        'model' => $model,
                    ]);
                } else {
                    foreach($presencas as $index => $idAluno){
                        $modelPresenca = new Presenca();

                        $modelPresenca->Aluno_idAluno = $idAluno;
                        $modelPresenca->Aula_idAula = $model->idAula;

                        $modelPresenca->save();
                    }
                    $modelTurma = new Turma();
                    $modelTurma->Aula_idAula = $model->idAula;

                    $idUser = Yii::$app->user->getId();
                    $idTreinador = $modelTurma->procurarTreinadorPorID($idUser);
                    $idT = $idTreinador[0]['idTreinador'];

                    $modelTurma->Treinador_idTreinador = $idT;
                    $modelTurma->save();

                }

                return $this->redirect(['view', 'id' => $model->idAula]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }


    }

    /**
     * Updates an existing Aula model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        //var_dump(Yii::$app->request->post());

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $presencas = Yii::$app->request->post('Aula')['presencas'];
            //var_dump($presencas);

            foreach($presencas as $index => $camposPresenca){
                $presenca = Presenca::findOne($camposPresenca['idPresenca']);

              $presenca->setAttributes($camposPresenca);
               $presenca->save();

           }

            Yii::$app->getSession()->setFlash('success', 'Alterações guardadas com sucesso!');

//            return $this->redirect(['view', 'id' => $model->idAula]);
            return $this->redirect(array('aula/index'));

        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }


    }

    /**
     * Deletes an existing Aula model.
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
     * Finds the Aula model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Aula the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Aula::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }




   /*public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.

        $model = new Aula();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            //return $model->selecionado = true;
            return array(
                array('active', 'numerical', 'integerOnly' => true),
                //OR optional
                array('active', 'safe'),
            );
        }
    }*/

    /*public function rules()
    {
        return [
            ['cancelled',   'boolean'],
            ['checkNumber', 'required'],
            ['payee',       'required', 'when' => function ($model) {return !$model->cancelled;}],
            ['particulars', 'required', 'when' => function ($model) {return !$model->cancelled;}],
        ];
    }*/




}
