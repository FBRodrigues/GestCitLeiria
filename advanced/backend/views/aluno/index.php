<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\AlunoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Alunos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="aluno-index">

   <?php
   $session = new Yii::$app->session;
   $session->open();
   $session['Sexo'] = Yii::$app->request->post('Aluno')['Sexo'];
   $session['Escaloes']=Yii::$app->request->post('Aluno')['Escaloes'];

   ?>
    <h1><?= Html::encode($this->title) ?></h1>
    <?php //echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="criarSo" >
        <p>
            <?= Html::a('Criar Sócio', ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    </div>

    <div class="pesquisaAvanc" >
        <?=Html::beginForm(['aluno/view2'],'post' );?>
        <p>
            <?=Html::submitButton('Pesquisa Avançada',['class' => 'btn btn-info','name'=>'pesAva']);?>
        </p>
        <?=Html::endForm();?>
    </div>
    <?=Html::beginForm(['site/init'],'post' );?>

    <?=Html::checkboxList('action', array('selection'=>'checked'))?>


    <?=Html::submitButton('Executar',['class' => 'btn btn-info','name'=>'formal1']);?>
    <?=Html::dropDownList('action1','',[','=>'Operação...',
        'ePer'=>'Enviar Email Personalizado','pPag'=>'Enviar Email Pagamentos'],['class'=>'dropdown'])?>

<p>
   <?php
   $itemArray = [];
    if($session['Escaloes']!=null){
        foreach($session['Escaloes'] as $item){
           switch($item){
                case "1":
                    $item = "Sub8";
                    break;
                case "2":
                    $item = "Sub10";
                    break;
                case "3":
                    $item = "Sub12";
                    break;
                case "4":
                    $item = "Sub14";
                    break;
                case "5":
                    $item = "Sub16";
                    break;
                case "6":
                    $item = "Sub18";
                    break;
                case "7":
                    $item = "Senior";
                    break;
                case "8":
                    $item = "Vet+35";
                    break;
                case "9":
                    $item = "Vet+45";
                    break;
                case "10":
                    $item = "Vet+50";
                    break;
                case "11":
                    $item = "Vet+55";
                    break;
                case "12":
                    $item = "Vet+60";
                    break;
           }
            $itemArray[$item] = $item;
            $item= implode(",",$itemArray);
            $value=$item;
        };
    }else {
       $value= 'Indefenido';
    }

   if($session['Sexo']=='M'){
       $sexo = 'Masculino';
   } else if($session['Sexo']=='F'){
        $sexo='Feminino';
   }else{
       $sexo = 'Indefenido';
   }

    echo 'Parametros da Pesquisa Avançada : <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; --> Sexo : ' . $sexo .
        ' <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; --> Escalão(ões) :  ' . $value . ' '  ?>
</p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class'=>'yii\grid\CheckboxColumn',
                'checkboxOptions' => function($model, $key, $index, $widget) {
                    return ["value" => $model->Contato3_Email
                    ];
                }],
             'Nome',
            [
                'attribute' => 'Escalao_idEscalao',
                'value' => 'escalaoIdEscalao.Valor',
                'label' => 'Escalão',
                'format'=>'text'
            ],

            [
                'label'=> ' Contato 1 ',
                'attribute'=> 'Contato1',
            ],
            [
                'label'=> ' Contato 2 ',
                'attribute'=> 'Contato2',
            ],
            [
                'label'=> 'Email',
                'attribute'=> 'Contato3_Email',
            ],
            'Sexo',
            /*[
                'class'=>'yii\grid\DataColumn',
                'value'=>function($data){
                    return $data->pagamentos[0]->idPagamento;
                },

            ],
           /* [
                'attribute'=>'Categorias',
                'value'=>'categorizacaos.idCategorias.Valor',


            ],*/

            ['class' => 'yii\grid\ActionColumn'],
        ],

    ]);
    ?>

    <?=Html::submitButton('Executar',['class' => 'btn btn-info','name'=>'formal']);?>
    <?=Html::dropDownList('action','',[','=>'Operação...',
        'ePer'=>'Enviar Email Personalizado','pPag'=>'Enviar Email Pagamentos'],['class'=>'dropdown'])?>
    <?=Html::endForm();?>
</div>
