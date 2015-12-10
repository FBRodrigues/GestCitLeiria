<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\CategorizacaoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pesquisa Avançada';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="categorizacao-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Adicionar Associaçao', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],


            'Aluno_idAluno',
           // [
             //   'label' => 'Nome',
               // 'attribute'=>'Nome'
            //],

            'Categorias_idCategorias',
            //[
              //  'label' => 'Categoria',
                //'attribute'=>'Valor'
            //],


            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
