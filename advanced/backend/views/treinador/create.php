<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Treinador */

$this->title = 'Criar Treinador';
$this->params['breadcrumbs'][] = ['label' => 'Treinadores', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="treinador-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
