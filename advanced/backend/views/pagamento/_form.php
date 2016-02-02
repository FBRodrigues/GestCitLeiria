<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\datetime\DateTimePicker;
use kartik\date\DatePicker;


/* @var $this yii\web\View */
/* @var $model backend\models\Pagamento */
/* @var $form yii\widgets\ActiveForm */
?>

<?php
$session = Yii::$app->session;
$id = $session->get('id');
?>
<div class="pagamento-form">


    <?php $form = ActiveForm::begin(); ?>



    <?= $form->field($model, 'idInscricao')->textInput(array('readonly'=>true , 'value'=>'' . $id));?>
    <?= $form->field($model, 'valor')->textInput() ?>

    <?= $form->field($model, 'nrFatura')->textInput() ?>

    <?= $form->field($model, 'nrAulas')->textInput() ?>

    <?= $form->field($model, 'dataFatura')->widget(DateTimePicker::className(),[
        'name' => 'check_issue_date',
        'options' => ['placeholder' => 'Selecione uma Data ...'],
        'pluginOptions' => [
            'format' => 'yyyy-mm-dd',
            'todayHighlight' => true
        ]
    ]
    ); ?>

    <?= $form->field($model, 'dataMaxPagamento')->widget(DatePicker::className(),[
            'disabled' => 'true',
            'readonly' => 'true',
            'name' => 'check_issue_date',
            'options' => ['placeholder' => 'Selecione uma Data ...'],
            'pluginOptions' => [
                'format' => 'yyyy-mm-dd',
                'todayHighlight' => true,
                ''
            ]
        ]
    ); ?>

    <?= $form->field($model, 'situacao')->textInput(array('readonly'=>'true')) ?>




    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Criar' : 'Atualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
