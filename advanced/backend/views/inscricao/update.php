<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Inscricao */

$this->title = 'Update Inscricao: ' . ' ' . $model->idInscricao;
$this->params['breadcrumbs'][] = ['label' => 'Inscricaos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idInscricao, 'url' => ['view', 'id' => $model->idInscricao]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="inscricao-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
