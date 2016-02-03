<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\TreinadorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Treinadores';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="treinador-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="botao-create">
    <p>
        <?= Html::a('Criar Treinador', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    </div>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idTreinador',
            'Nome',
            'Contato',
            'Email:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
