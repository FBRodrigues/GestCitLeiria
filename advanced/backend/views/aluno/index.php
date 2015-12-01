<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\AlunoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Sócios';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="aluno-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="criarSo" >
    <p>
        <?= Html::a('Criar Sócio', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    </div>


    <?=Html::beginForm(['site/init'],'post' );?>

    <?=Html::checkboxList('action', array('selection'=>'checked'))?>


    <?=Html::submitButton('Executar',['class' => 'btn btn-info','name'=>'formal1']);?>
    <?=Html::dropDownList('action1','',[','=>'Operação...',
        'ePer'=>'Enviar Email Personalizado','pPag'=>'Enviar Email Pagamentos'],['class'=>'dropdown'])?>

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
            /*['label'=> ' ID Aluno',
              'attribute'=> 'idAluno',
               ],*/

            'Nome',

            ['label'=>'Escalao',
              'attribute'=>'NomeEscalao',

            ],
                // 'DataNascimento',
            //'Idade',
            ['label'=> ' Contato 1 ',
                'attribute'=> 'Contato1',
            ],
            ['label'=> ' Contato 2 ',
                'attribute'=> 'Contato2',
            ],
            ['label'=> 'Email',
                'attribute'=> 'Contato3_Email',
            ],
            // 'EncarregadoEducacao',
            'Sexo',

            ['class' => 'yii\grid\ActionColumn'],
        ],

    ]);
    ?>

    <?=Html::submitButton('Executar',['class' => 'btn btn-info','name'=>'formal']);?>
    <?=Html::dropDownList('action','',[','=>'Operação...',
        'ePer'=>'Enviar Email Personalizado','pPag'=>'Enviar Email Pagamentos'],['class'=>'dropdown'])?>
    <?=Html::endForm();?>

</div>

