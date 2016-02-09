<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Treinador */

$this->title = $model->Nome;
$this->params['breadcrumbs'][] = ['label' => 'Treinadores', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="treinador-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Atualizar', ['update', 'id' => $model->idTreinador], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Apagar', ['delete', 'id' => $model->idTreinador], [
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
            'idTreinador',
            'Nome',
            'Contato',
            'Email:ntext',
        ],
    ]) ?>

</div>
