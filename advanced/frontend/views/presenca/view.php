<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;


/* @var $this yii\web\View */
/* @var $model frontend\models\Presenca */

/* @var $modelPresencaController frontend\controllers\PresencaController */
/* @var $idAula frontend\controllers\PresencaController */
/* @var $idPresenca frontend\controllers\PresencaController */

//$this->title = $model->idPresenca;
$this->params['breadcrumbs'][] = ['label' => 'Presencas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="presenca-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <!-- <?= Html::a('Update', ['update', 'idPresenca' => $model->idPresenca, 'Aula_idAula' => $model->Aula_idAula], ['class' => 'btn btn-primary']) ?> -->
        <!-- <?= Html::a('Delete', ['delete', 'idPresenca' => $model->idPresenca, 'Aula_idAula' => $model->Aula_idAula], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?> -->
    </p>

    <?php $form = ActiveForm::begin();

    //var_dump($listaAlunos);



        //$nomesAlunos = ArrayHelper::getColumn($listaAlunos, 'Nome');


      // echo $form->field($model, 'Presente')->checkbox(['label'=>'Choveu','checked'=>false,'uncheck'=>'0','value'=>'']).'</br>';

    echo $form->field($model, 'Presente')->checkbox(['label'=>'Choveu','checked'=>false],['uncheck'=>'0','value'=>'1']).'</br>';


        foreach($listaAlunos as $aluno){
            echo $aluno->idAluno.'__'.$aluno->NomeAluno.'</br>';
            //echo ['class'=>'yii\grid\CheckboxColumn'];
            echo $form->field($model, 'Presente')->checkbox(['label'=>$aluno->NomeAluno,'checked'=>'0','uncheck'=>'1','value'=>'1']);
        }

    var_dump($listaPresencas);

    /*
    foreach($listaPresencas as $presenca){
        echo 'idAluno: '.$presenca->Aluno_idAluno.'</br>Valor presente: '.$presenca->Presente.'</br>';
        //$presente = \frontend\controllers\PresencaController::PresenteOuNao($presenca->Presente);
        $presente = $presenca->Presente;
        echo '----------------';
        var_dump($presente);
        //echo 'check 1';
        //echo $form->field($model, 'Presente')->checkbox(['value'=>$presente]);
        echo (Html::activeCheckbox($model, 'Presente', [ 'value'=>$presente]));


        //echo 'check 2';
        //echo $form->field($model, 'Presente')->checkbox(['checked'=>true,'uncheck'=>false,'value'=>$presente])->label($presenca->Aluno_idAluno);
    }
    */

    $resultData = ['0'=>"Nome dele", '1'=>"teste", '2'=>"yftunj"];

    echo ( Html::activeCheckboxList($model, 'Presente', $resultData ) );




            //echo $form->field($model, 'sprachen')->checkboxList(ArrayHelper::map(Sprachen::find()->all(), 'name', 'name'),['inline'=>true]);

    //var_dump($listaPresencas);
    /*foreach($listaPresencas as $presenca){
        echo $presenca->Presente.'</br>';
    }*/

        //botão pa submeter as presenças


        //Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']);

        ActiveForm::end();

    ?>






    <div class="form-group">
        <?=Html::submitButton($model->isNewRecord ? 'Create' : 'Confirmar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']); ?>
    </div>




    <!-- WTV DAS PRESENCAS -->
    <!--
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idPresenca',
            'Aluno_idAluno',
            'Aula_idAula',
            'Presente',
        ],
    ]) ?>

    -->

    <!-- LISTA DE ALUNOS -->


</div>
