<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\PagamentoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pagamentos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pagamento-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Criar Pagamento', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
           // ['class' => 'yii\grid\SerialColumn'],

           [
               'label'=>'ID',
               'attribute'=>'idPagamento',

           ],
           [
               'attribute'=>'Aluno_idAluno',
               'value'=>'alunoIdAluno.Nome',
               'label'=>'Nome Aluno'
           ],
            'valor',
            'referencia',
            'data',
            // 'periodo',
            // 'nAulas',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
