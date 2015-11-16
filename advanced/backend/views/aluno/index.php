<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\AlunoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider  */

$this->title = 'Alunos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="aluno-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Aluno', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

   <?=Html::beginForm(['site/init'],'post' );?>
   <?=Html::checkboxList('action', array('selection'=>'checked'))?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class'=>'yii\grid\CheckboxColumn',
                 'checkboxOptions' => function($model, $key, $index, $widget) {
                    return ["value" => $model->Contato3_Email
                    ];

                }],

            //['class' => 'yii\grid\SerialColumn'],
             'idAluno',
            //'Pessoa_idPessoa',
            //'Horario_idHorario',
            'Escalao_idEscalao',
            'Nome',
            // 'DataNascimento',
             'Idade',
             'Contato1',
             'Contato2',
             'Contato3_Email:email',
            // 'EncarregadoEducacao',
             'Sexo',

            ['class' => 'yii\grid\ActionColumn'],
        ],

    ]);
    ?>

    <?=Html::submitButton('Enviar mail',['class' => 'btn btn-info']);?>
    <?=Html::endForm( );?>
    <?=Html::beginForm(['site/pagamentos'],'post' );?>
    <?=Html::submitButton('Enviar mail pagamentos',['class' => 'btn btn-danger']);?>
    <?=Html::endForm( );?>

</div>
