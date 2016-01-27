<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Inscricao */

$this->title = $model->idInscricao;
$this->params['breadcrumbs'][] = ['label' => 'Inscricões', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="inscricao-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->idInscricao], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->idInscricao], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Deseja apagar este Item?',
                'method' => 'post',
            ],
        ]) ?>


    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idInscricao',
            'idAluno0.Nome',
            'dataInicio',
            'dataFim',
            'nrAulas',
            'tipo',
            //'AulasEfectuadas'
        ],
    ]) ?>
    <p>
        <?= Html::a('Criar Pagamento', ['pagamento/create'], ['class' => 'btn btn-success'],[
        'data' => ['method' => 'post']]
        )?>
    </p>

</div>
