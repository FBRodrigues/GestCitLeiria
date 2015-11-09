<?php

use yii\helpers\Html;
use yii\grid\GridView;


/* @var $this yii\web\View */
/* @var $searchModel frontend\models\AulaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Aulas';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="aula-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

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
            ['class'=>'yii\grid\CheckboxColumn'],

            //['class' => 'yii\grid\SerialColumn'],

            //'idAula',
            'Nome',
            'HoraInicio',
            'HoraFim',
            //'Choveu',

            //linha seguinte gera os 3 bot�es (ver, editar e apagar)
            //['class' => 'yii\grid\ActionColumn', 'template' => '{view}'],


    ],





        'rowOptions' => function($model, $key, $index, $grid)
    {
        return ['id' => $model['idAula'],'checkBox' => array('Choveu')]; /*'location.href="'.Yii::$app->urlManager->createUrl('aula/view').'&id="+(this.id)']*/;
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
