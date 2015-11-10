<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

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

    <!-- WTV DAS PRESENCAS -->
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idPresenca',
            'Aluno_idAluno',
            'Aula_idAula',
            'Presente',
        ],
    ]) ?>

    <!-- LISTA DE ALUNOS -->
    <?= GridView::widget([
/*        'filterModel' => $searchModel,
        'idPresenca' => $idPresenca, */
        'listaAlunos' => $listaAlunos,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idAluno',
            'Nome',
            'Idade',
            'Sexo',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
