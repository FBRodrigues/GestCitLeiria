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
    <?=Html::beginForm(['site/init'],'post' );?>

    <?=Html::checkboxList('action', array('selection'=>'checked'))?>


    <?=Html::submitButton('Executar',['class' => 'btn btn-info','name'=>'formal1']);?>
    <?=Html::dropDownList('action1','',[','=>'Operação...',
        'ePer'=>'Enviar Email Personalizado','pPag'=>'Enviar Email Pagamentos'],['class'=>'dropdown'])?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [

            ['class'=>'yii\grid\CheckboxColumn',
                'checkboxOptions' => function($model, $key, $index, $widget) {
                    return ["value" => $model->alunoIdAluno->Contato3_Email
                    ];

                }],

            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'Aluno_idAluno',
                'value' => 'alunoIdAluno.Nome',
                'label' => 'Nome Aluno',
            ],
            [
                'attribute' => 'Categorias_idCategorias',
                'value' => 'categoriasIdCategorias.Valor',
                'label' => 'Categoria',
            ],
            [
                'attribute' => 'Aluno_idAluno',
                'value' => 'alunoIdAluno.Contato3_Email',
                'label' => 'Email ',
            ],



            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?=Html::submitButton('Executar',['class' => 'btn btn-info','name'=>'formal']);?>
    <?=Html::dropDownList('action','',[','=>'Operação...',
        'ePer'=>'Enviar Email Personalizado','pPag'=>'Enviar Email Pagamentos'],['class'=>'dropdown'])?>
    <?=Html::endForm();?>

</div>
