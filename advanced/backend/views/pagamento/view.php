<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Pagamento */

$this->title = $model->idPagamento;
$this->params['breadcrumbs'][] = ['label' => 'Pagamentos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pagamento-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->idPagamento], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->idPagamento], [
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
            'idPagamento',
            'idInscricao',
            'valor',
            'nrFatura',
            'dataFatura',
            'nrAulas',
            'dataMaxPagamento',
            'situacao',
        ],
    ]) ?>

</div>
