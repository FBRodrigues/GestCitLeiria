<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $model frontend\models\Aula */


//$this->title = $model->idAula;
$this->params['breadcrumbs'][] = ['label' => 'Aulas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="aula-view">

    <h3><?= Html::encode("Detalhe da aula") ?></h3>

    <p>
        <!-- <?= Html::a('Alterar', ['update', 'id' => $model->idAula], ['class' => 'btn btn-primary']) ?>

        <?= Html::a('Delete', ['delete', 'id' => $model->idAula], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>  -->
    </p>

    <?php
    echo 'Nome: '.$model->Nome.'</br>';
    echo 'Hora de Inicio: '.$model->HoraInicio.'</br>';
    echo 'Hora de Fim: '.$model->HoraFim.'</br>';
    ?>

    <?php $form = ActiveForm::begin([
        'action' => \yii\helpers\Url::to(['aula/update','id' => $model->idAula])
    ]);

    echo $form->field($model, 'Estado')->dropDownList(['0'=> 'Realizada', '1'=> 'Não realizada-Tempo', '2'=> 'Não realizada-FP', '3'=> 'Não realizada-FA']);

    echo '<h3>'.Html::encode("Lista de inscritos").'</h3>';

    $index = 0;
    foreach($model->presencas as $presenca){
       echo $form->field($model, 'presencas['.$index.'][idPresenca]')->hiddenInput(['value' => $presenca->idPresenca])->label(false);
       echo $form->field($model, 'presencas['.$index.'][Aluno_idAluno]')->hiddenInput(['value' => $presenca->alunoIdAluno->idAluno])->label(false);
       echo $form->field($model, 'presencas['.$index.'][Aula_idAula]')->hiddenInput(['value' => $presenca->aulaIdAula->idAula])->label(false);
       echo $form->field($model, 'presencas['.$index.'][Estado]')->dropDownList(['0'=> 'Presente', '1'=> 'Ausente', '2'=> 'Ausente-Doença', '3'=> 'Ausente-FP'])->label($presenca->alunoIdAluno->NomeAluno." - ".$presenca->alunoIdAluno->Contato1);

       $index++;
    }

    echo Html::submitButton($model->isNewRecord ? 'Create' : 'Confirmar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']);

    ActiveForm::end();
    ?>


    <!-- <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idAula',
            'Nome',
            'HoraInicio',
            'HoraFim',
            'Estado'


        ],
    ])  ?> -->


<!--    <div class="aula-view2">-->
<!---->
<!--        <h3>--><?//= Html::encode("Lista de inscritos") ?><!--</h3>//Quando quiseres podes ligar-->
<!---->
<!--    --><?php //$form = ActiveForm::begin([
//        'action' => \yii\helpers\Url::to(['presenca/update','Aula_idAula' => $model->idAula])
//    ]);
//
//
//
//    //var_dump($alunosInscritos);
//
//    //echo $form->field($model, 'alunosPresentes')->checkboxList($alunosInscritos);
//    //echo $form->field($model, 'alunosInscritos')->dropDownList($alunosInscritos);
//    //echo json_encode($alunosInscritos);
//    foreach($alunosInscritos as $idPresenca => $inscritos){
//        echo $form->field($model, 'presencas[idPresenca]')->hiddenInput(['value' => $idPresenca])->label(false);
//        echo $form->field($model, 'presencas[idAluno]')->hiddenInput(['value' => $inscritos['idAluno']])->label(false);
//        echo $form->field($model, 'presencas[Estado]')->dropDownList(['0'=> 'Presente', '1'=> 'Ausente', '2'=> 'Ausente-Doença', '3'=> 'Ausente-FP'])->label($inscritos['nomeAluno']." - ".$inscritos['contatoAluno']);
//    }
//
//    echo Html::submitButton($model->isNewRecord ? 'Create' : 'Confirmar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']);
//
//    ActiveForm::end();
//
//    ?>
<!---->
<!--        </div>-->

    <!-- <?/*= GridView::widget([
        //Lista de alunos carregada aqui
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,

        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'idAluno',
            //'Pessoa_idPessoa',
            //'Horario_idHorario',
            //'Escalao_idEscalao',
            'NomeAluno',
            //'DataNascimento',
            //'Idade',
            'Contato1',
            //'Contato2',
            //'Contato3_Email',
            //'EncarregadoEducacao',
            //'Sexo',

            //linha seguinte gera os 3 bot�es (ver, editar e apagar)
            ['class' => 'yii\grid\ActionColumn', 'template' => '{view}'],
        ],


        'rowOptions' => function($model, $key, $index, $grid) {
            return ['id' => $model['idAluno'], 'onClick' => 'location.href="'.Yii::$app->urlManager->createUrl('aula/view').'&id="+(this.id)'];
        }


        //Mostrar dados

    ]); */?> -->




</div>
