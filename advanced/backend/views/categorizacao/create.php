<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Categorizacao */

$this->title = 'Create Categorizacao';
$this->params['breadcrumbs'][] = ['label' => 'Categorizacaos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="categorizacao-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
