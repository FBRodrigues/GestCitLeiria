<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\datetime\DateTimePicker;

/* @var $this yii\web\View */
/* @var $model backend\models\Inscricao */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="inscricao-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'idAluno')->dropDownList([$model->getAlunos(),],['prompt'=>'Selecione uma opção...'])->label('Aluno')?>

    <?= $form->field($model, 'dataInicio')->widget(DateTimePicker::className(),[
        'name' => 'check_issue_date',
        'options' => ['placeholder' => 'Selecione uma Data ...'],
        'pluginOptions' => [
            'format' => 'yyyy-mm-dd',
            'todayHighlight' => true
        ]
        ]
    );?>

    <?= $form->field($model, 'dataFim')->textInput() -> widget(DateTimePicker::className(),[
            'name' => 'check_issue_date',
            'options' => ['placeholder' => 'Selecione uma Data ...'],
            'pluginOptions' => [
                'format' => 'yyyy-mm-dd',
                'todayHighlight' => true
            ]
        ]
    );?>

    <?= $form->field($model, 'nrAulas')->textInput() ?>

    <?= $form->field($model, 'tipo')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Criar' : 'Atualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
