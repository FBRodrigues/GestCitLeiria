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

        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'idAula',
            'Nome',
            'HoraInicio',
            'HoraFim',
            //'Choveu',

            //linha seguinte gera os 3 bot�es (ver, editar e apagar)
            //['class' => 'yii\grid\ActionColumn', 'template' => '{view}'],
        ],


        'rowOptions' => function($model, $key, $index, $grid) {
            return ['id' => $model['idAula'], 'onClick' => 'location.href="'.Yii::$app->urlManager->createUrl('aluno/view').'&id="+(this.id)'];
        }




    ]); ?>

</div>
