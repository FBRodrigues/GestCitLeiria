<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;


/* @var $this yii\web\View */
/* @var $model backend\models\Aluno */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="aluno-form">

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'Escalao_idEscalao')->dropDownList($model->getEscaloes())?>

    <?= $form->field($model, 'Nome')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DataNascimento')->widget(DatePicker::className(),[
        'name' => 'check_issue_date',
        'options' => ['placeholder' => 'Selecione uma Data ...'],
        'pluginOptions' => [
            'format' => 'yyyy-mm-dd',
            'todayHighlight' => true
    ]
    ]

    ); ?>

    <?= $form->field($model, 'Idade')->textInput() ?>

    <?= $form->field($model, 'Contato1')->textInput(['maxlength' => true])->label('Contato 1') ?>

    <?= $form->field($model, 'Contato2')->textInput(['maxlength' => true])->label('Contato 2') ?>

    <?= $form->field($model, 'Contato3_Email')->textInput(['maxlength' => true])->label('Email') ?>

    <?= $form->field($model, 'EncarregadoEducacao')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Sexo')->textarea(['maxlength'=> true])?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Criar' : 'Atualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
