<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\InscricaoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Inscricões';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="inscricao-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="botao-create">
    <p>
        <?= Html::a('Criar Inscrição', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    </div>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idInscricao',
            [
                'attribute' => 'idAluno',
                'value' => 'idAluno0.Nome',
                'label' => 'Aluno',
                'format'=>'text'
            ],
            'dataInicio',
            'dataFim',
            [
                'attribute' => 'nrAulas',
                'label' => 'nr de Aulas/Semana',
            ],
            'tipo',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
