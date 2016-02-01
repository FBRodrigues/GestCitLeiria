<?php

use yii\helpers\Html;
use yii\grid\GridView;
use frontend\controllers\PresencaController;


/* @var $this yii\web\View */
/* @var $searchModel frontend\models\AulaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


$this->title = 'Agenda';
$this->params['breadcrumbs'][] = $this->title;
$nomeUser = Yii::$app->user->identity->username;
$idUser = Yii::$app->user->getId();
$tipoUtilizador = Yii::$app->user->identity->TipoUtilizador;
$visibility = true;
$btn = 'btn btn-success';
if($tipoUtilizador == 'A'){
    $visibility = false;
    $btn = 'visible';
}
?>
<div class="aula-index">

    <h1><?= Html::encode("Bem vindo ".$nomeUser) ?></h1>

    <h3><?= Html::encode("$this->title") ?></h3>
    <?php //echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="botao-create">

        <p>
            <?= Html::a('Adicionar Aula', ['create'], ['class' => $btn]) ?>
        </p>


    </div>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,

//        'rowOptions' => function($model){
//            if($model->nrPresentes == '0'){
//                //return ['class' => 'danger'];
//                return ['style'=>'color: white; background-color:red;'];
//            }else{
//                return ['class' => 'sucess'];
//            }
//        },

        //Experiencia
       /* 'columns' => array(
            array(
                'id' => 'selectedIds',
                'class' => 'CCheckBoxColumn'
            ),*/

        'columns' => [
         //['class'=>'yii\grid\CheckboxColumn'],
            //['class' => 'yii\grid\SerialColumn'],
            //'idAula',
            //'Choveu',
            'Nome',
            //'nrPresentes' => ['visible' => $visibility],
            [
                'label' => 'Numero de Alunos Presentes',
                'attribute' => 'nrPresentes',
                'visible' => $visibility,
            ],
            'Data',
            //'Estado',
            'HoraInicio',
            'HoraFim',
            //linha seguinte gera os 3 bot�es (ver, editar e apagar)
            //['class' => 'yii\grid\ActionColumn', 'template' => '{delete}'],

        ],

            /*'rowOptions' => function($model, $key, $index, $grid) {
                return ['id' => $model['idAula'], 'onClick' => 'location.href="'.Yii::$app->urlManager->createUrl('presenca/view',array('idPresenca'=>'0', 'Aula_idAula'=>'0')).'"'];
            }*/

            /*'rowOptions' => function($model, $key, $index, $grid) {
            return ['id' => $model['idAula'], 'onClick' => 'location.href="'.Yii::$app->urlManager->createUrl('presenca/view').'&idPresenca="+(this.id)/&Aula_idAula="(idAula)'];
        }*/
             'rowOptions' => function($model, $key, $index, $grid) {
                 //echo $model->idAula.'__';
                 $tipoUtilizador = Yii::$app->user->identity->TipoUtilizador;
                 if($tipoUtilizador == 'T'){
                     return ['id' => $model['idAula'], 'onClick' => 'location.href="'.Yii::$app->urlManager->createUrl('aula/view').'&id="+(this.id)'];
                 }else{
                     return null;
                 }

        }
    ]);




    /*$data=Yii::$app->request->post();
    if (!empty($data)) {
    $data['User']['modules']=implode(",", $data['User']['modules']);



    if ($model->load(Yii::$app->request->post()) && $model->save()) {
        $this->setRole($model);
        $this->setTasks($model);
        return $this->redirect(['view', 'id' => $model->id]);
    } else {
    Yii::$app->session->set("oldRole", $model->getCompanyRole($model->role));*///

    ?>



</div>
