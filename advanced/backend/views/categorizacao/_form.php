<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Categorizacao */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="categorizacao-form">

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'Aluno_idAluno')->dropDownList($model->getAlunos())?>

    <?= $form->field($model, 'Categorias_idCategorias')->dropDownList($model->getCategorias())?>
   <!-- <//?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,

        'columns' => [
            ['class'=>'yii\grid\CheckboxColumn',
                'checkboxOptions' => function($model, $key, $index, $widget) {
                    return ["value" => $model->Contato3_Email
                    ];

                }],




            'Nome',
            [
                'attribute' => 'Escalao_idEscalao',
                'value' => 'escalaoIdEscalao.Valor',
                'label' => 'Escalão',
                'format'=>'text'
            ],

            [
                'label'=> ' Contato 1 ',
                'attribute'=> 'Contato1',
            ],
            [
                'label'=> ' Contato 2 ',
                'attribute'=> 'Contato2',
            ],
            [
                'label'=> 'Email',
                'attribute'=> 'Contato3_Email',
            ],
            'Sexo',
            /*[
                'class'=>'yii\grid\DataColumn',
                'value'=>function($data){
                    return $data->pagamentos[0]->idPagamento;
                },

            ],
           /* [
                'attribute'=>'Categorias',
                'value'=>'categorizacaos.idCategorias.Valor',


            ],*/

            ['class' => 'yii\grid\ActionColumn'],
        ],

    ]);
    ?>-->

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Criar' : 'Atualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
