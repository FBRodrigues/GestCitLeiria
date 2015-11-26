<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Escalao */

$this->title = 'Update Escalao: ' . ' ' . $model->idEscalao;
$this->params['breadcrumbs'][] = ['label' => 'Escalaos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idEscalao, 'url' => ['view', 'id' => $model->idEscalao]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="escalao-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
