<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Inscricao */

$this->title = $model->idInscricao;
$this->params['breadcrumbs'][] = ['label' => 'Inscricões', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$session = new Yii::$app->session;
$session ['id'] = $model->idInscricao;


?>
<div class="inscricao-view">


    <h1>Inscrição Número: <?= Html::encode($this->title) ?></h1>



    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idInscricao',
            'idAluno0.Nome',
            'dataInicio',
            'dataFim',
            [
                'attribute' => 'nrAulas',
                'label' => 'Nº de Aulas/Semana',
            ],
            'tipo',
            'AulasEfectuadas'
        ],
    ]) ?>


    <div class="botao-vista">
        <p>
            <?= Html::a('Ver Pagamentos', ['pagamento/index'], ['class' => 'btn btn-success']) ?>
        </p>
    </div>

</div>
