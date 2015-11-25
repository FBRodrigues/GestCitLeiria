<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Escalao */

$this->title = 'Create Escalao';
$this->params['breadcrumbs'][] = ['label' => 'Escalaos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="escalao-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
