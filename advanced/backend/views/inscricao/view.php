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
var_dump($id);
?>
<div class="inscricao-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->idInscricao], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->idInscricao], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Deseja apagar este Item?',
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
            'nrAulas',
            'tipo',
            //'AulasEfectuadas'
        ],
    ]) ?>
    <p>
        <?=Html::beginForm(['pagamento/create'],'post' );?>

        <?=Html::submitButton('Executar',['class' => 'btn btn-info','name'=>'formal2']);?>


        <?//= Html::a('Criar Pagamento', ['pagamento/create', 'onclick' => , ['class' => 'btn btn-success']]);?>
    </p>
    <?=Html::endForm();?>
</div>