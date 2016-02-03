<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Inscricao */

$this->title = $model->idInscricao;
$this->params['breadcrumbs'][] = ['label' => 'Inscricões', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$session = Yii::$app->session;
$session['id'] = $model->idInscricao;
$id = $session->get('id');
?>
<div class="inscricao-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->idInscricao], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->idInscricao], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Tem a certeza que pretende apagar este Item?',
                'method' => 'post',
            ],
        ]) ?>


    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idInscricao',
            'idAluno0.Nome',
            'dataInicio',
            'dataFim',
            [
                'attribute' => 'nrAulas',
                'label' => 'nr de Aulas/Semana',
            ],
            'tipo',
            //'AulasEfectuadas'
        ],
    ]) ?>
    <p>
        <?=Html::beginForm(['pagamento/create2'],'post' );?>

        <?=Html::submitButton('Criar Pagamento',['class' => 'btn btn-info','name'=>'formal2']);?>


    </p>
    <?=Html::endForm();?>
</div>
