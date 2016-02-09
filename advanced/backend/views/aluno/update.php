<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Aluno */

$this->title = 'Editar Aluno: ' . ' ' . $model->Nome;
$this->params['breadcrumbs'][] = ['label' => 'Alunos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idAluno, 'url' => ['view', 'id' => $model->idAluno]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="aluno-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
