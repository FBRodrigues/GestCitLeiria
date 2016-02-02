<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Inscricao */

$this->title = 'Criar Inscricão';
$this->params['breadcrumbs'][] = ['label' => 'Inscricoes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="inscricao-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
