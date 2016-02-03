<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Presenca */

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
                'confirm' => 'Tem a certeza que pretende apagar este Item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idPresenca',
            'Aluno_idAluno',
            'Aula_idAula',
            'Estado',
            'TipoAula',
        ],
    ]) ?>

</div>
