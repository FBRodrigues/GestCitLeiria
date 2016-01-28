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

    <?= $form->field($model, 'Data')->widget(\kartik\date\DatePicker::className(),[
        'name' => 'check_issue_date1',
        'options' => ['placeholder' => 'Selecione a data pretendida'],
        'type' => \kartik\date\DatePicker::TYPE_COMPONENT_APPEND,
        'pluginOptions' => [
            'format' => 'yyyy-mm-dd',
            'todayHighlight' => true,
            'autoclose' => true]])->label('Data de inicio');?>


    <?= $form->field($model, 'HoraInicio')->widget(\kartik\time\TimePicker::className(),[
        'name' => 'check_issue_date2',
        'options' => ['placeholder' => 'Selecione a hora pretendida'],
        'pluginOptions' => [
            'defaultTime' => '00:00',
            'showSeconds' => false,
            'showMeridian' => false,
            'minuteStep' => 10,
            'secondStep' => 5,
            'autoclose' => true]])->label('Hora Inicio');?>


    <?= $form->field($model, 'HoraFim')->widget(\kartik\time\TimePicker::className(),[
        'name' => 'check_issue_date2',
        'options' => ['placeholder' => 'Selecione a hora pretendida'],
        'pluginOptions' => [
            'defaultTime' => '00:00',
            'showSeconds' => false,
            'showMeridian' => false,
            'minuteStep' => 10,
            'secondStep' => 5,
            'autoclose' => true]])->label('Hora Fim');?>

    <!-- <?= $form->field($model, 'Estado')->textInput(['maxlength' => true]) ?> -->



    <!-- <?//= $form->checkBox($model,'active', array('value'=>1, 'uncheckValue'=>0)) ?> -->

    <!-- <?//= $form->field($model, 'selecionado')->checkbox(['label'=>'','checked'=>true,'uncheck'=>'0','value'=>'1']); ?> -->



        <?= '<h3>'.Html::encode("Adicionar Aluno").'</h3>'; ?>

        <div id="alunos_a_adicionar"></div>


        <?php

        $dataProviderAluno = Aluno::find()->all();

        $alunos = [];
        $nomesAlunos = [];
        foreach($dataProviderAluno as $aluno){
            $alunos[$aluno->idAluno] = $aluno->Nome;
            array_push($nomesAlunos, $aluno->Nome.' - '.$aluno->Contato1);
        }




        //TODO: instalar auto complete widget
        echo yii\jui\AutoComplete::widget([
            'model' => $model,
            'attribute' => 'presencas[aluno]',
            'clientOptions' => [
                'source' => $nomesAlunos,
            ],
        ]);
        ?>

        <?= Html::button("Adicionar", ['class' => 'btn btn-success', 'id' => 'btn_adicionar_aluno']) ?>

        <?= $this->registerJs("jQuery('#btn_adicionar_aluno').click(function(){
                                   var input = jQuery('<input></input>').attr('name','Aula[alunos_a_adicionar][]').attr('value', jQuery('#aula-presencas-aluno').val());
                                   input.html(jQuery('#aula-presencas-aluno').val());
                                   jQuery('#alunos_a_adicionar').append(input);
                                   jQuery('#alunos_a_adicionar').append(jQuery('<br></br>'));
                                   jQuery('#aula-presencas-aluno').val('')
                                   });") ?>

        <?= Html::submitButton($model->isNewRecord ? 'Criar' : 'Atualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
