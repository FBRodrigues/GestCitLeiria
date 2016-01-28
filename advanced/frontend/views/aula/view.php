<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use yii\jui;
use frontend\models\Aluno;
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
    echo 'Data: '.$model->Data.'</br>';
    echo 'Hora de inicio: '.$model->HoraInicio.'</br>';
    echo 'Hora de fim: '.$model->HoraFim.'</br>';
    ?>

    <?php $form = ActiveForm::begin([
        'action' => \yii\helpers\Url::to(['aula/update','id' => $model->idAula])

    ]);

    echo $form->field($model, 'Estado')->dropDownList(['0'=> 'Realizada', '1'=> 'Não realizada-Condições meteorológicas', '2'=> 'Não realizada-FP', '3'=> 'Não realizada-FA']);

    echo '<h3>'.Html::encode("Lista de inscritos").'</h3>';

    $index = 0;
   // var_dump($model->presencas);
    if($model->presencas != null){
        foreach($model->presencas as $presenca){
            echo $form->field($model, 'presencas['.$index.'][idPresenca]')->hiddenInput(['value' => $presenca->idPresenca])->label(false);
            echo $form->field($model, 'presencas['.$index.'][Aluno_idAluno]')->hiddenInput(['value' => $presenca->alunoIdAluno->idAluno])->label(false);
            echo $form->field($model, 'presencas['.$index.'][Aula_idAula]')->hiddenInput(['value' => $presenca->aulaIdAula->idAula])->label(false);
            echo $form->field($model, 'presencas['.$index.'][TipoAula]')->hiddenInput(['value' => $presenca->TipoAula])->label(false);



            $cc;
            $contato1 = $presenca->alunoIdAluno->Contato1;
            $contato2 = $presenca->alunoIdAluno->Contato2;
            $contato3 = $presenca->alunoIdAluno->Contato3_Email;

            if($contato1 != ''){
                $cc = $contato1;
            }elseif($contato2 != ''){
                $cc = $contato2;
            }elseif($contato3 != ''){
                $cc = $contato3;
            }else{
                $cc = 'Aluno não tem contato!';
            }


            echo $form->field($model, 'presencas['.$index.'][Estado]')->dropDownList(['0'=>'Não escolhido...','1'=> 'Presente', '2'=> 'Ausente',
                '3'=> 'Ausente-Doença', '4'=> 'Ausente-FP'])->label($presenca->alunoIdAluno->Nome." - ".$cc);

            $index++;
        }

        echo Html::submitButton($model->isNewRecord ? 'Create' : 'Confirmar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']);
    } else {
        echo "Esta aula não tem alunos";
    }


    /*echo '<h3>'.Html::encode("Adicionar Aluno").'</h3>';

    echo $form->field($model, 'presencas')->checkboxList($alunos, ['separator'=>'<br>','itemOptions' => ['checked' => true]])->label('Alunos existentes');



    echo Html::submitButton($model->isNewRecord ? 'Create' : 'Confirmar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']);
*/

    ActiveForm::end();
    ?>

    <?php $form = ActiveForm::begin([
        'action' => \yii\helpers\Url::to(['aula/addaluno','id' => $model->idAula])

    ]);

    echo '<h3>'.Html::encode("Adicionar aluno").'</h3>';

    //TODO: instalar auto complete widget
    echo yii\jui\AutoComplete::widget([
        'model' => $model,
        'attribute' => 'presencas[aluno]',
        'clientOptions' => [
            'source' => $nomesAlunos,
        ],
    ]);

    //http://www.yiiframework.com/doc-2.0/yii-jui-autocomplete.html
        //echo $form->field($model, 'presencas[Aluno_idAluno]')->dropDownList($alunos)->label('Adicionar aluno:');
        echo $form->field($model, 'presencas[Estado]')->hiddenInput(['value' => 1])->label(false);
        echo $form->field($model, 'presencas[TipoAula]')->dropDownList(['0'=> 'Normal', '1'=> 'Aula compensação'])->label('Tipo de aula');




    echo Html::submitButton('Adicionar', ['class' => 'btn btn-success']);

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
