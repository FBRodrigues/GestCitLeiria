<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Pagamento */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pagamento-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Aluno_idAluno')->textInput()->label('Aluno') ?>

    <?= $form->field($model, 'valor')->textInput()->label('Valor do Pagamento') ?>

    <?= $form->field($model, 'referencia')->textInput(['maxlength' => true])->label('Referência') ?>

    <?= $form->field($model, 'data')->textInput()->widget(\kartik\datetime\DateTimePicker::className(),[
        'name' => 'check_issue_date',
        'options' => ['placeholder' => 'Selecione uma Data ...'],
        'pluginOptions' => [
        'format' => 'yyyy-mm-dd',
        'todayHighlight' => true
            ]
        ])->label('Data do Pagamento');
    ?>

    <?= $form->field($model, 'periodo')->textInput()->label('Periodo do Pagamento') ?>

    <?= $form->field($model, 'nAulas')->textInput()->label('Número de Aulas') ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Criar Pagamento' : 'Atualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
