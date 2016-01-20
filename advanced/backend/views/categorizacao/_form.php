<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Categorizacao */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="categorizacao-form">

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'Aluno_idAluno')->listBox($model->getAlunos(),['multiple' => 'true',
    ])?>


    <?= $form->field($model, 'Categorias_idCategorias')->listBox($model->getCategorias())?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Criar' : 'Atualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
