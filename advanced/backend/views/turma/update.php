<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Turma */

$this->title = 'Update Turma: ' . ' ' . $model->idTurma;
$this->params['breadcrumbs'][] = ['label' => 'Turmas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idTurma, 'url' => ['view', 'id' => $model->idTurma]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="turma-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
