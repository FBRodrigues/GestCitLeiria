<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Aluno */

$this->title = $model->idAluno;
$this->params['breadcrumbs'][] = ['label' => 'Sócios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="aluno-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Atualizar', ['update', 'id' => $model->idAluno], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Apagar', ['delete', 'id' => $model->idAluno], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Tem a certeza que pretende apagar este Sócio?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idAluno',
            'Escalao_idEscalao',
            'Valor',
            'Nome',
            'DataNascimento',
            //'Idade',
            'Contato1',
            'Contato2',
            'Contato3_Email:email',
            'EncarregadoEducacao',
            'Sexo',
        ],
    ]) ?>

</div>
