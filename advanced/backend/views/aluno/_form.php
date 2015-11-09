<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model backend\models\Aluno */
/* @var $form yii\widgets\ActiveForm */
/*cenas*/
?>

<div class="aluno-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'idAluno')->textInput() ?>

    <?= $form->field($model, 'Pessoa_idPessoa')->textInput() ?>

    <?= $form->field($model, 'Horario_idHorario')->textInput() ?>

    <?= $form->field($model, 'Escalao_idEscalao')->textInput() ?>

    <?= $form->field($model, 'Nome')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DataNascimento')->textInput() ?>

    <?= $form->field($model, 'Idade')->textInput() ?>

    <?= $form->field($model, 'Contato1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Contato2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Contato3_Email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'EncarregadoEducacao')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Sexo')->textInput(['maxlength' => true]) ?>


   /* <?php
    //$emails = ArrayHelper::map($emails,'Contato3_Email','Contato3_Email');
    //$selected_keys = array_key_exists(ArrayHelper::map($model->Contato3_Email,'idAluno','Contato3_Email'),'Contato3_Email');
    //var_dump($selected_keys);
    //return $selected_keys;
    //echo Html::checkboxList('Aluno[emails][]',$selected_keys,$emails);
   // $selected_keys = array_keys(CHtml::listData( $model->books, 'id' , 'id'));
   // CHtml::checkBoxList('Author[books][]', $selected_keys, $books);
    ?>
    <div class="form-group">

        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
