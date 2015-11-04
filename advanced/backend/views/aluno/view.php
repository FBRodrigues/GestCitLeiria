<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Aluno */

$this->title = $model->idAluno;
$this->params['breadcrumbs'][] = ['label' => 'Alunos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="aluno-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->idAluno], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->idAluno], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idAluno',
            'Pessoa_idPessoa',
            'Horario_idHorario',
            'Escalao_idEscalao',
            'Nome',
            'DataNascimento',
            'Idade',
            'Contato1',
            'Contato2',
            'Contato3/Email:email',
            'EncarregadoEducacao',
            'Sexo',
        ],
    ]) ?>

</div>
