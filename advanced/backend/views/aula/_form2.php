<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\base\View;
use backend\models\Aluno;
use backend\models\Treinador;


/* @var $this yii\web\View */
/* @var $model backend\models\Aula */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="aula-form">

    <?php $form = ActiveForm::begin(); ?>

    <!-- <?= $form->field($model, 'idAula')->textInput() ?> -->

    <?= $form->field($model, 'Nome')->textInput(['maxlength' => true])->label('Nome') ?>

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


        <?= $form->field($model, 'DiaSemana')->checkboxList(array(0=>'Domingo', 1=>'Segunda', 2=>'Terça', 3=>'Quarta', 4=>'Quinta', 5=>'Sexta', 6=>'Sábado'))->label('Dias da semana'); ?>

    <label for="numeroVezes">Número de vezes</label>
        <select name="numRepeticoes" class="form-control">
            <option value=0>Não escolhido</option>
            <option value=1>1 semana</option>
            <option value=2>2 semanas</option>
            <option value=3>3 semanas</option>
            <option value=4>1 mês</option>
            <option value=12>3 meses</option>
            <option value=24>6 meses</option>
        </select>



    <!--<?= $form->field($model, 'presencas')->dropDownList([0=>'Não escolhido', 1=>'1 semana', 2=>'2 semanas', 3=>'3 semanas', 4=>'1 mês', 12=>'3 meses', 24=>'6 meses'])->label('Número de semanas');?>-->



        <!-- echo $form->field($model, 'Estado')->dropDownList(['0'=> 'Não escolhido...','1'=> 'Realizada', '2'=> 'Não realizada-Condições meteorológicas', '3'=> 'Não realizada-FP', '4'=> 'Não realizada-FA']); -->



    <!-- <?//= $form->checkBox($model,'active', array('value'=>1, 'uncheckValue'=>0)) ?> -->

    <!-- <?//= $form->field($model, 'selecionado')->checkbox(['label'=>'','checked'=>true,'uncheck'=>'0','value'=>'1']); ?> -->

    <div class="form-group">



        <div class="associar-professor">

            <?= '<h3>'.Html::encode("Associar Treinador").'</h3>'; ?>

            <?php

            $dataProviderTreinador = Treinador::find()->all();

            $treinadores = [];
            foreach($dataProviderTreinador as $treinador){
                $treinadores[$treinador->idTreinador] = $treinador->Nome;
            }

            echo $form->field($model, 'turmas')->checkboxList($treinadores, ['separator'=>'<br>'])->label('Adicionar treinador:');

            ?>

        </div>

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




        <?= Html::submitButton($model->isNewRecord ? 'Marcar' : 'Atualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
