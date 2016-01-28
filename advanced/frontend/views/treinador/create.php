<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Treinador */

$this->title = 'Create Treinador';
$this->params['breadcrumbs'][] = ['label' => 'Treinadors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="treinador-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
