<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\PagamentoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pagamento-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idPagamento') ?>

    <?= $form->field($model, 'Aluno_idAluno') ?>

    <?= $form->field($model, 'valor') ?>

    <?= $form->field($model, 'referencia') ?>

    <?= $form->field($model, 'data') ?>

    <?php // echo $form->field($model, 'periodo') ?>

    <?php // echo $form->field($model, 'nAulas') ?>

    <div class="form-group">
        <?= Html::submitButton('Procurar', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reiniciar', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
