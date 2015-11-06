<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Presenca */

$this->title = 'Update Presenca: ' . ' ' . $model->idPresenca;
$this->params['breadcrumbs'][] = ['label' => 'Presencas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idPresenca, 'url' => ['view', 'idPresenca' => $model->idPresenca, 'Aula_idAula' => $model->Aula_idAula]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="presenca-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
