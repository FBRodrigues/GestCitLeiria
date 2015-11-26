<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Escalao */

$this->title = $model->idEscalao;
$this->params['breadcrumbs'][] = ['label' => 'Escalaos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="escalao-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->idEscalao], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->idEscalao], [
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
            'idEscalao',
            'Valor',
        ],
    ]) ?>

</div>
