<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
/* @var $this yii\web\View */
/* @var $model frontend\models\Aula */

$this->title = $model->idAula;
$this->params['breadcrumbs'][] = ['label' => 'Aulas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="aula-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Alterar', ['update', 'id' => $model->idAula], ['class' => 'btn btn-primary']) ?>
        <!--
        <?= Html::a('Delete', ['delete', 'id' => $model->idAula], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>  -->
    </p>


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idAula',
            'Nome',
            'HoraInicio',
            'HoraFim',
            'Choveu',
        ],
    ])  ?>



    <?= GridView::widget([
        //Lista de alunos carregada aqui
        'alunosDataProvider' => $alunosDataProvider,
        //'filterModel' => $searchModel,

        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'idAluno',
            //'Pessoa_idPessoa',
            //'Horario_idHorario',
            //'Escalao_idEscalao',
            'Nome',
            'DataNascimento',
            'Idade',
            'Contato1',
            'Contato2',
            'Contato3_Email',
            'EncarregadoEducacao',
            'Sexo',

            //linha seguinte gera os 3 bot�es (ver, editar e apagar)
            ['class' => 'yii\grid\ActionColumn', 'template' => '{view}', 'class' => 'yii\grid\ChekedboxColumn'],
        ],


        'rowOptions' => function($model, $key, $index, $grid) {
            return ['id' => $model['idAula'], 'onClick' => 'location.href="'.Yii::$app->urlManager->createUrl('aula/view').'&id="+(this.id)'];
        }




    ]); ?>


</div>
