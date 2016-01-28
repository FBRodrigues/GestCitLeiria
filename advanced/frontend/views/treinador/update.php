<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Treinador */

$this->title = 'Update Treinador: ' . ' ' . $model->idTreinador;
$this->params['breadcrumbs'][] = ['label' => 'Treinadors', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idTreinador, 'url' => ['view', 'id' => $model->idTreinador]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="treinador-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
