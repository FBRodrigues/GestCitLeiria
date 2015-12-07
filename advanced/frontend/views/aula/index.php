<?php

use yii\helpers\Html;
use yii\grid\GridView;
use frontend\controllers\PresencaController;


/* @var $this yii\web\View */
/* @var $searchModel frontend\models\AulaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */



$this->params['breadcrumbs'][] = $this->title;
?>
<div class="aula-index">

    <h1><?= Html::encode("Bem vindo (nomeTreinador)") ?></h1>
    <h3><?= Html::encode("Agenda") ?></h3>
    <?php //echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <!-- <?= Html::a('Create Aula', ['create'], ['class' => 'btn btn-success']) ?> -->
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,

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
            'HoraInicio',
            'HoraFim',


            //linha seguinte gera os 3 bot�es (ver, editar e apagar)
            //['class' => 'yii\grid\ActionColumn', 'template' => '{view}'],

           /* $model = new SomeForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($model->checkbox == true){

                $model->scenario = 'checked';
            }
        }*/
    ],

        /*'rowOptions' => function($model, $key, $index, $grid) {
            return ['id' => $model['idAula'], 'onClick' => 'location.href="'.Yii::$app->urlManager->createUrl('presenca/view',array('idPresenca'=>'0', 'Aula_idAula'=>'0')).'"'];
        }*/


        /*'rowOptions' => function($model, $key, $index, $grid) {
        return ['id' => $model['idAula'], 'onClick' => 'location.href="'.Yii::$app->urlManager->createUrl('presenca/view').'&idPresenca="+(this.id)/&Aula_idAula="(idAula)'];
    }*/


         'rowOptions' => function($model, $key, $index, $grid) {
             //echo $model->idAula.'__';
             return ['id' => $model['idAula'], 'onClick' => 'location.href="'.Yii::$app->urlManager->createUrl('aula/view').'&id="+(this.id)'];
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
