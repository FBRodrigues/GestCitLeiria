<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Categorizacao */

$this->title = 'Atualizar Categorizacao: ' . ' ' . $model->idCategorizacao;
$this->params['breadcrumbs'][] = ['label' => 'Categorizacaos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idCategorizacao, 'url' => ['view', 'id' => $model->idCategorizacao]];
$this->params['breadcrumbs'][] = 'Atualizar';
?>
<div class="categorizacao-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
