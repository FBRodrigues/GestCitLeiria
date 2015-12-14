<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\models\Aluno;


/* @var $this yii\web\View */
/* @var $model frontend\models\Aula */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="aula-form">

    <?php $form = ActiveForm::begin(); ?>

   <!-- <?= $form->field($model, 'idAula')->textInput() ?> -->

    <?= $form->field($model, 'Nome')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'HoraInicio')->widget(\kartik\datetime\DateTimePicker::className(),[
        'name' => 'check_issue_date1',
        'options' => ['placeholder' => 'Selecione a data pretendida'],
        'pluginOptions' => [
            'format' => 'yyyy-mm-dd hh:ii',
            'todayHighlight' => true]]);?>

    <?= $form->field($model, 'HoraFim')->widget(\kartik\datetime\DateTimePicker::className(),[
        'name' => 'check_issue_date2',
        'options' => ['placeholder' => 'Selecione a data pretendida'],
        'pluginOptions' => [
            'format' => 'yyyy-mm-dd hh:ii',
            'todayHighlight' => true]]);?>

    <!-- <?= $form->field($model, 'Estado')->textInput(['maxlength' => true]) ?> -->



    <!-- <?//= $form->checkBox($model,'active', array('value'=>1, 'uncheckValue'=>0)) ?> -->

    <!-- <?//= $form->field($model, 'selecionado')->checkbox(['label'=>'','checked'=>true,'uncheck'=>'0','value'=>'1']); ?> -->

    <div class="form-group">

        <?= '<h3>'.Html::encode("Adicionar Aluno").'</h3>'; ?>


        <?php

        $dataProviderAluno = Aluno::find()->all();

        $alunos = [];
        foreach($dataProviderAluno as $aluno){
            $alunos[$aluno->idAluno] = $aluno->Nome;
        }

        echo $form->field($model, 'presencas')->checkboxList($alunos, ['separator'=>'<br>'])->label('Alunos existentes');

        ?>

        <?= Html::submitButton($model->isNewRecord ? 'Criar' : 'Atualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
