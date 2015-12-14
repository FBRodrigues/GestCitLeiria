<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\CategorizacaoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="categorizacao-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

   <!-- <//?= $form->field($model, 'idCategorizacao') ?>-->
    <?php
    $dataProviderEsc= \backend\models\Escalao::find()->all();
    $escaloes = [];
        foreach($dataProviderEsc as $escalao){
            $escaloes[$escalao->idEscalao]= $escalao->Valor;
        }


    ?>
    <?php
    $dataProviderEsc= \backend\models\Categorias::find()->all();
    $categorias = [];
    foreach($dataProviderEsc as $cat){
        $categorias[$cat->idCategorias]= $cat->Valor;
    }
  ?>
    <?= $form->field($model,'Escaloes')->checkboxList($escaloes)->label('Escalões')?>
    <?= $form->field($model, 'Aluno_idAluno')->dropDownList(['M'=>'M','F'=>'F'],['prompt'=>'Selecione uma Opção...'])->label('Sexo') ?>
    <?= $form->field($model, 'Categorias_idCategorias')->checkboxList($categorias)->label('Categoria') ?>

    <div class="form-group">
        <?= Html::submitButton('Procurar', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reiniciar', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
