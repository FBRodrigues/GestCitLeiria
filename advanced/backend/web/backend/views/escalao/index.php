<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\EscalaoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Escalaos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="escalao-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Escalao', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idEscalao',
            'Valor',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
