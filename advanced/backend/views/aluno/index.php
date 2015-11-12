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
    <?php  //echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Aluno', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

   <?=Html::beginForm();?>
   <?=Html::
    checkboxList('', array('selection'=>'checked'),[])?>
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

    <?=Html::submitButton('Send', ['class' => 'btn btn-info','href'=>'site/contact']);?>
   <?= Html::endForm();?>

   <!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script type="text/javascript">

        $(document).ready(function(){
            $("#w0 input[type=checkbox]").click(function(){
                var keys = $('#w0').yiiGridView('getSelectedRows');
                alert(keys);
            });

        });
    </script>-->




</div>
