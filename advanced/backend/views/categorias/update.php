<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Categorias */

$this->title = 'Update Categorias: ' . ' ' . $model->idCategorias;
$this->params['breadcrumbs'][] = ['label' => 'Categorias', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idCategorias, 'url' => ['view', 'id' => $model->idCategorias]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="categorias-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
