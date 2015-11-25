<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Aluno */

$this->title = 'Criar Sócio';
$this->params['breadcrumbs'][] = ['label' => 'Alunos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="aluno-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
