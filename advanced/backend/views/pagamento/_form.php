<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\datetime\DateTimePicker;


/* @var $this yii\web\View */
/* @var $model backend\models\Pagamento */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pagamento-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'idInscricao')->dropDownList([$model->getInscricoes(),],['prompt'=>'Selecione uma opção...'])->label('Inscrição')?>

    <?= $form->field($model, 'valor')->textInput() ?>

    <?= $form->field($model, 'nrFatura')->textInput() ?>

    <?= $form->field($model, 'dataFatura')->widget(DateTimePicker::className(),[
        'name' => 'check_issue_date',
        'options' => ['placeholder' => 'Selecione uma Data ...'],
        'pluginOptions' => [
            'format' => 'yyyy-mm-dd',
            'todayHighlight' => true
        ]
    ]
    ); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Criar' : 'Atualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
