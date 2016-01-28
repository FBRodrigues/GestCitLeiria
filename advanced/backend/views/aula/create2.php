<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Aula */

$this->title = 'Marcar aulas';
$this->params['breadcrumbs'][] = ['label' => 'Aulas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="aula-create2">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form2', [
        'model' => $model,
    ]) ?>

</div>
