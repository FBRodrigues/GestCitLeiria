<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Categorizacao */

$this->title = $model->idCategorizacao;
$this->params['breadcrumbs'][] = ['label' => 'Categorizacaos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="categorizacao-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->idCategorizacao], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->idCategorizacao], [
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
            'idCategorizacao',
            'Aluno_idAluno',
            'Categorias_idCategorias',
        ],
    ]) ?>

</div>
