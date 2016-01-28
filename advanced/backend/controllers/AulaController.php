<?php

namespace backend\controllers;

use kartik\datetime\DateTimePicker;
use Yii;
use backend\models\Aula;
use backend\models\AulaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\Presenca;
use backend\models\Turma;
use backend\models\Aluno;
use backend\models\AlunoSearch;
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

        //$idUser = Yii::$app->user->getId();
        //$treinador = Treinador::find()->where(['Id_User' => $idUser])->one();

        //$aulas_turma = Turma::find()->where(['Treinador_idTreinador' => $treinador->idTreinador])->all();

        //$aulas = [];

        $aulas = Aula::find()->all();

        //foreach($aulas_turma as $index => $aula_turma){
        //$aula = Aula::findOne($aula_turma->Aula_idAula);
        //array_push($aulas, $aula);
        //}

        //$dataProvider = new ArrayDataProvider(['allModels' => $aulas,'sort' => ['attributes' => ['HoraInicio'], 'defaultOrder' => ['HoraInicio' => SORT_DESC]]]);
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


        $aula = Aula::findOne($id);
        //$dataProvider = $aula->alunos; */

        $array =  $aula->getAlunosInscritos($aula->idAula);
        $dataProviderAluno = Aluno::find()->where(['not in','idAluno',$array])->all();

        $alunos = [];
        $nomesAlunos = [];
        foreach($dataProviderAluno as $aluno){
            $alunos[$aluno->idAluno] = $aluno->Nome;
            array_push($nomesAlunos, $aluno->Nome.' - '.$aluno->Contato1);
        }

        return $this->render('view', [
            'model' => $this->findModel($id),
            //'presencas' => Presenca::find()->where(['idAula' => $aula->idAula]),
            'dataProvider' => $dataProvider,
            'alunosInscritos' =>$array,
            'alunos' => $alunos,
            'nomesAlunos' => $nomesAlunos
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
        $turmas = Yii::$app->request->post('Aula')['turmas'];
        $alunos_adicionados = Yii::$app->request->post('Aula')['alunos_a_adicionar'];
        //$data = Yii::$app->request->post('Aula')['Data'];

        if(count($alunos_adicionados) > 0){

            //$dataInicio = new \DateTime($data);
            //$diaSemanaData = date('w', $dataInicio->getTimestamp());
            //$post['Aula']['DiaSemana'] = $diaSemanaData;
            //$post['Aula']['Data'] = $dataInicio->format('y-m-d');

            if ($model->load(Yii::$app->request->post()) && $model->save()) {

                    foreach($alunos_adicionados as $index => $aluno){

                        $nomeAluno = substr($aluno,0,strpos($aluno,' - '));
                        $contato = substr($aluno,strpos($aluno,' - ') + 3);
                        $idAluno = Aluno::findOne(['Nome' => $nomeAluno, 'Contato1' => $contato])->idAluno;

                        $modelPresenca = new Presenca();

                        $modelPresenca->Aluno_idAluno = $idAluno;
                        $modelPresenca->Aula_idAula = $model->idAula;

                        $modelPresenca->save();
                    }
                    foreach ($turmas as $index => $idTreinador) {
                        $modelTurma = new Turma();

                        $modelTurma->Treinador_idTreinador = $idTreinador;
                        $modelTurma->Aula_idAula = $model->idAula;

                        $modelTurma->save();
                    }
                return $this->redirect(['index']);
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

    public function actionCreate2()
    {
        $model = new Aula();

        $post = Yii::$app->request->post();
        #$presencas = Yii::$app->request->post('Aula')['presencas'];
        $turmas = Yii::$app->request->post('Aula')['turmas'];
        $diasSemana = Yii::$app->request->post('Aula')['DiaSemana'];
        $numRepeticoes = Yii::$app->request->post('numRepeticoes');
        $horaInicio = Yii::$app->request->post('Aula')['HoraInicio'];
        $horaFim = Yii::$app->request->post('Aula')['HoraFim'];
        $data = Yii::$app->request->post('Aula')['Data'];
        $alunos_adicionados = Yii::$app->request->post('Aula')['alunos_a_adicionar'];

        #$nomeAluno = substr($presencas['aluno'],0,strpos($presencas['aluno'],' - '));
        #$contato = substr($presencas['aluno'],strpos($presencas['aluno'],' - ') + 3);
        #$idAluno = Aluno::findOne(['Nome' => $nomeAluno, 'Contato1' => $contato])->idAluno;

        /*$segundaId = -1; //1-7
        $segundaDia = -1; //1-31
        $diaHj = date('d'); //numero de 01-31
        $diaSemanaHj = date('w'); //numero de 1-7...0-domingo, 6-sabado
        $plusSete = 0;
        */

        if (count($alunos_adicionados) > 0) {

            $dataInicio = new \DateTime($data);
            $dataXpto = new \DateTime($data);
            $dataXpto->add(new \DateInterval('P' . ($numRepeticoes * 7) . 'D'));

            while ($dataInicio < $dataXpto) {
                $diaSemanaData = date('w', $dataInicio->getTimestamp());

                if (in_array($diaSemanaData, $diasSemana)) {

                    $model = new Aula();

                    $post['Aula']['Data'] = $dataInicio->format('y-m-d');
                    $post['Aula']['DiaSemana'] = $diaSemanaData;
                    $post['Aula']['HoraInicio'] = $dataInicio->format('y-m-d') . ' ' . $horaInicio;
                    $post['Aula']['HoraFim'] = $dataInicio->format('y-m-d') . ' ' . $horaFim;

                    if ($model->load($post) && $model->save()) {

                            foreach ($alunos_adicionados as $index => $aluno) {
                                $nomeAluno = substr($aluno,0,strpos($aluno,' - '));
                                $contato = substr($aluno,strpos($aluno,' - ') + 3);
                                $idAluno = Aluno::findOne(['Nome' => $nomeAluno, 'Contato1' => $contato])->idAluno;

                                $modelPresenca = new Presenca();

                                $modelPresenca->Aluno_idAluno = $idAluno;
                                $modelPresenca->Aula_idAula = $model->idAula;

                                $modelPresenca->save();
                            }

                            foreach ($turmas as $index => $idTreinador) {
                                $modelTurma = new Turma();

                                $modelTurma->Treinador_idTreinador = $idTreinador;
                                $modelTurma->Aula_idAula = $model->idAula;
                                $modelTurma->save();
                            }


                    } else {
                        return $this->render('create2', [
                            'model' => $model,
                        ]);
                    }

                }

                $dataInicio->add(new \DateInterval('P1D'));
            }

            return $this->redirect(['index']);

            /*            foreach($diasSemana as $diaSemana){

                                for($i = 0; $i < $numRepeticoes; $i++){

                                $model = new Aula();

                                if($i != 0 || $i != 1){
                                    $plusSete = 7;
                                    switch($diaSemana){
                                        case 1: //segunda
                                            $segundaId = $diaSemanaHj + 0;
                                            if($segundaDia == -1) {
                                                $segundaDia = $diaHj + $plusSete;
                                            }else{
                                                $segundaDia = $segundaDia + $plusSete;
                                            }
                                            $valorI = \DateTime::createFromFormat('Y-m-d H:i','2016-01-'.$segundaDia.' '.$dataInicio);
                                            $valorF = \DateTime::createFromFormat('Y-m-d H:i','2016-01-'.$segundaDia.' '.$dataFim);
                                            $model->HoraInicio = $valorI;
                                            $model->HoraFim = $valorF;
                                            break;
                                        case 2: //terça
                                            $segundaId = $diaSemanaHj - 1;

                                            if($segundaDia == -1) {
                                                $segundaDia = $diaHj + $plusSete;
                                            }else{
                                                $segundaDia = $segundaDia + $plusSete;
                                            }


                                            $valorI = \DateTime::createFromFormat('Y-m-d H:i','2016-01-'.$segundaDia.' '.$dataInicio);
                                            $valorF = \DateTime::createFromFormat('Y-m-d H:i','2016-01-'.$segundaDia.' '.$dataFim);
                                            $model->HoraInicio = $valorI;
                                            $model->HoraFim = $valorF;
                                            break;
                                        case 3: //quarta
                                            $segundaId = $diaSemanaHj - 2;

                                            if($segundaDia == -1) {
                                                $segundaDia = $diaHj + $plusSete;
                                            }else{
                                                $segundaDia = $segundaDia + $plusSete;
                                            }


                                            $valorI = '2016-01-'.$segundaDia.' '.$dataInicio;
                                            $valorF = '2016-01-'.$segundaDia.' '.$dataFim;
                                            $model->HoraInicio = $valorI;
                                            $model->HoraFim = $valorF;
                                            break;
                                        case 4: //quinta
                                            $segundaId = $diaSemanaHj - 3;

                                            if($segundaDia == -1) {
                                                $segundaDia = $diaHj + $plusSete;
                                            }else{
                                                $segundaDia = $segundaDia + $plusSete;
                                            }


                                            $valorI = \DateTime::createFromFormat('Y-m-d H:i','2016-01-'.$segundaDia.' '.$dataInicio);
                                            $valorF = \DateTime::createFromFormat('Y-m-d H:i','2016-01-'.$segundaDia.' '.$dataFim);
                                            $model->HoraInicio = $valorI;
                                            $model->HoraFim = $valorF;
                                            break;
                                        case 5: //sexta
                                            $segundaId = $diaSemanaHj - 4;


                                            if($segundaDia == -1) {
                                                $segundaDia = $diaHj + $plusSete;
                                            }else{
                                                $segundaDia = $segundaDia + $plusSete;
                                            }

                                            $valorI = \DateTime::createFromFormat('Y-m-d H:i','2016-01-'.$segundaDia.' '.$dataInicio);
                                            $valorF = \DateTime::createFromFormat('Y-m-d H:i','2016-01-'.$segundaDia.' '.$dataFim);
                                            $model->HoraInicio = $valorI;
                                            $model->HoraFim = $valorF;
                                            break;
                                        case 6: //sabado
                                            $segundaId = $diaSemanaHj - 5;


                                            if($segundaDia == -1) {
                                                $segundaDia = $diaHj + $plusSete;
                                            }else{
                                                $segundaDia = $segundaDia + $plusSete;
                                            }

                                            $valorI = '2016-01-'.$segundaDia.' '.$dataInicio;
                                            $valorF = '2016-01-'.$segundaDia.' '.$dataFim;
                                            $model->HoraInicio = $valorI;
                                            $model->HoraFim = $valorF;
                                            break;
                                        case 7: //domingo
                                            $segundaId = $diaSemanaHj + 1;

                                            if($segundaDia == -1) {
                                                $segundaDia = $diaHj + $plusSete;
                                            }else{
                                                $segundaDia = $segundaDia + $plusSete;
                                            }


                                            $valorI = '2016-01-'.$segundaDia.' '.$dataInicio;
                                            $valorF = '2016-01-'.$segundaDia.' '.$dataFim;
                                            $model->HoraInicio = $valorI;
                                            $model->HoraFim = $valorF;
                                            break;
                                    }

                                } else {
                                    switch($diaSemana){
                                        case 1: //segunda
                                            $segundaId = $diaSemanaHj + 0;
                                            $segundaDia = $diaHj;

                                            $valorI = '2016-01-'.$segundaDia.' '.$dataInicio;
                                            $valorF = '2016-01-'.$segundaDia.' '.$dataFim;
                                            $model->HoraInicio = $valorI;
                                            $model->HoraFim = $valorF;
                                            break;
                                        case 2: //terça
                                            $segundaId = $diaSemanaHj - 1;
                                            $segundaDia = $diaHj;

                                            $valorI = '2016-01-'.$segundaDia.' '.$dataInicio;
                                            $valorF = '2016-01-'.$segundaDia.' '.$dataFim;
                                            $model->HoraInicio = $valorI;
                                            $model->HoraFim = $valorF;
                                            break;
                                        case 3: //quarta
                                            $segundaId = $diaSemanaHj - 2;
                                            $segundaDia = $diaHj;

                                            $valorI = '2016-01-'.$segundaDia.' '.$dataInicio;
                                            $valorF = '2016-01-'.$segundaDia.' '.$dataFim;
                                            $model->HoraInicio = $valorI;
                                            $model->HoraFim = $valorF;
                                            break;
                                        case 4: //quinta
                                            $segundaId = $diaSemanaHj - 3;
                                            $segundaDia = $diaHj;

                                            $valorI = \DateTime::createFromFormat('Y-m-d H:i','2016-01-'.$segundaDia.' '.$dataInicio);
                                            $valorF = \DateTime::createFromFormat('Y-m-d H:i','2016-01-'.$segundaDia.' '.$dataFim);
                                            $model->HoraInicio = $valorI;
                                            $model->HoraFim = $valorF;
                                            break;
                                        case 5: //sexta
                                            $segundaId = $diaSemanaHj - 4;
                                            $segundaDia = $diaHj;

                                            $valorI = \DateTime::createFromFormat('Y-m-d H:i','2016-01-'.$segundaDia.' '.$dataInicio);
                                            $valorF = \DateTime::createFromFormat('Y-m-d H:i','2016-01-'.$segundaDia.' '.$dataFim);
                                            $model->HoraInicio = $valorI;
                                            $model->HoraFim = $valorF;
                                            break;
                                        case 6: //sabado
                                            $segundaId = $diaSemanaHj - 5;
                                            $segundaDia = $diaHj;

                                            $valorI = '2016-01-'.$segundaDia.' '.$dataInicio;
                                            $valorF = '2016-01-'.$segundaDia.' '.$dataFim;
                                            $model->HoraInicio = $valorI;
                                            $model->HoraFim = $valorF;
                                            break;
                                        case 7: //domingo
                                            $segundaId = $diaSemanaHj + 1;
                                            $segundaDia = $diaHj;

                                            $valorI = '2016-01-'.$segundaDia.' '.$dataInicio;
                                            $valorF = '2016-01-'.$segundaDia.' '.$dataFim;
                                            $model->HoraInicio = $valorI;
                                            $model->HoraFim = $valorF;
                                            break;
                                    }
                                }


                                $valorI = '2016-01-'.$segundaDia.' '.$dataInicio;
                                $valorF = '2016-01-'.$segundaDia.' '.$dataFim;



                                $post['Aula']['DiaSemana'] = $diaSemana;
                                $post['Aula']['HoraInicio'] = $valorI;
                                $post['Aula']['HoraFim'] = $valorF;

                                if ($model->load($post) && $model->save()) {

                                    if ($presencas == 0) {
                                        echo 'Não selecionou nenhum aluno';
                                        return $this->render('create2', [
                                            'model' => $model,
                                        ]);
                                    } else {
                                        foreach ($presencas as $index => $idAluno) {
                                            $modelPresenca = new Presenca();

                                            $modelPresenca->Aluno_idAluno = $idAluno;
                                            $modelPresenca->Aula_idAula = $model->idAula;

                                            $modelPresenca->save();
                                        }

                                        foreach ($turmas as $index => $idTreinador) {
                                            $modelTurma = new Turma();

                                            $modelTurma->Treinador_idTreinador = $idTreinador;
                                            $modelTurma->Aula_idAula = $model->idAula;
                                            $modelTurma->save();
                                        }
                                    }


                                } else {
                                    return $this->render('create2', [
                                        'model' => $model,
                                    ]);
                                }

                            }
                        }




                        return $this->redirect(['index', 'id' => $model->idAula]);
            */

                    } else {
                        return $this->render('create2', [
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
            $guardarPresencas = true;


            foreach ($presencas as $index => $camposPresenca) {
                if ($camposPresenca['Estado'] == 0) {

                    $guardarPresencas = false;

                }
            }

            if ($guardarPresencas == true) {


                foreach ($presencas as $index => $camposPresenca) {
                    $presenca = Presenca::findOne($camposPresenca['idPresenca']);

                    $presenca->setAttributes($camposPresenca);
                    $presenca->save();

                }


                Yii::$app->getSession()->setFlash('success', 'Alterações guardadas com sucesso!');


                return $this->redirect(array('aula/index'));
            }else{
                Yii::$app->getSession()->setFlash('error', 'Alunos não confirmados!');

                return $this->redirect(array('view', 'id' => $id));


            }


        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }


    }

    public function actionAddaluno($id){
        $model = $this->findModel($id);

        $dadosNovaPresenca = Yii::$app->request->post('Aula')['presencas'];
        $nomeAluno = substr($dadosNovaPresenca['aluno'],0,strpos($dadosNovaPresenca['aluno'],' - '));
        $contato = substr($dadosNovaPresenca['aluno'],strpos($dadosNovaPresenca['aluno'],' - ') + 3);
        $tipoAula = $dadosNovaPresenca['TipoAula'];
        $estado = $dadosNovaPresenca['Estado'];

        $idAluno = Aluno::findOne(['Nome' => $nomeAluno, 'Contato1' => $contato])->idAluno;

        $modelPresenca = new Presenca();

        if($estado == 0){
            Yii::$app->getSession()->setFlash('error', 'Alunos não confirmados!');

            return $this->redirect(array('view', 'id' => $id));
        }else{
            $modelPresenca->Aluno_idAluno = $idAluno;
            $modelPresenca->TipoAula = $tipoAula;
            $modelPresenca->Estado = $estado;
            $modelPresenca->Aula_idAula = $model->idAula;

            $modelPresenca->save();


            Yii::$app->getSession()->setFlash('success', 'Alterações guardadas com sucesso!');

            return $this->redirect(array('view', 'id' => $id));
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


    /*public static function getMonday($d) {
        $d = new Date($d);
        $day = $d.getDay();
        $diff = $d.getDate() - $day + ($day == 0 ? -6:1);

        return new Date($d.setDate($diff));
}*/


}
