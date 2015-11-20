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

$this->title = $model->idPresenca;
$this->params['breadcrumbs'][] = ['label' => 'Presencas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="presenca-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'idPresenca' => $model->idPresenca, 'Aula_idAula' => $model->Aula_idAula], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'idPresenca' => $model->idPresenca, 'Aula_idAula' => $model->Aula_idAula], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?php

    //var_dump($listaAlunos);

        $form = ActiveForm::begin();

        //$nomesAlunos = ArrayHelper::getColumn($listaAlunos, 'Nome');

        foreach($listaAlunos as $aluno){
            echo $aluno->idAluno.'__'.$aluno->Nome.'</br>';
            echo $form->field($model, 'Presente')->checkbox(['label'=>$aluno->Nome,'checked'=>'s','uncheck'=>'n','value'=>'0']);
        }

    var_dump($listaPresencas);
    /*foreach($listaPresencas as $presenca){
        echo $presenca->Presente.'</br>';
    }*/

        //botão pa submeter as presenças
        //Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']);

        ActiveForm::end();

    ?>


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
