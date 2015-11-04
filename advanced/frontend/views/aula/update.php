<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Aula */

$this->title = 'Alterar Aula: ' . ' ' . $model->idAula;
$this->params['breadcrumbs'][] = ['label' => 'Aulas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idAula, 'url' => ['view', 'id' => $model->idAula]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="aula-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
