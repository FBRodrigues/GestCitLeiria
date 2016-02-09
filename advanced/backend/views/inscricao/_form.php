<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model backend\models\Inscricao */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="inscricao-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'idAluno')->dropDownList([$model->getAlunos(),],['prompt'=>'Selecione uma opção...'])->label('Aluno')?>

    <?= $form->field($model, 'dataInicio')->widget(DatePicker::className(),[
        'name' => 'check_issue_date',
            'type' => \kartik\date\DatePicker::TYPE_COMPONENT_APPEND,
        'options' => ['placeholder' => 'Selecione uma Data ...'],
        'pluginOptions' => [
            'format' => 'yyyy-mm-dd',
            'todayHighlight' => true,
            'autoclose' => true,
        ]
        ]
    );?>

    <?= $form->field($model, 'dataFim')->textInput() -> widget(DatePicker::className(),[
            'name' => 'check_issue_date',
            'type' => \kartik\date\DatePicker::TYPE_COMPONENT_APPEND,
            'options' => ['placeholder' => 'Selecione uma Data ...'],
            'pluginOptions' => [
                'format' => 'yyyy-mm-dd',
                'todayHighlight' => true,
                'autoclose' => true,
            ]
        ]
    );?>

    <?= $form->field($model, 'nrAulas')->textInput()->label('Nr de aulas/semana') ?>

    <?= $form->field($model, 'tipo')->dropDownList([ 'casual' => 'Casual', 'mensal' => 'Mensal', 'anual' => 'Anual',], ['prompt' => 'Selecione uma opção...']) ?>




    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Criar' : 'Atualizar', ['class' =>$model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
