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
    if($session['Escaloes']==null){
     $va = "Nao tem nenhum Escalao selecionado";
    }else {

        $va = implode(",",$session['Escaloes']);
        $arrai = explode(",",$va);

        foreach($arrai as $item){

          //  var_dump($item);
            if($item==0){
                $no= "cenas";
            }else if($item==1){
                $no="Sub8";
            }elseif($item==2){
               $no="Sub10" ;
            }
        }

     //   var_dump($arrai);
      //  var_dump($no);


    };
      if($session['Sexo']=='M'){
       $sexo = 'Masculino';
   } else if($session['Sexo']=='F'){
        $sexo='Feminino';
   }else{
       $sexo = 'Não tem sexo selecionado';
   }


    echo 'Está a pesquisar com os Parametros : <br> Sexo : ' . $sexo . ' <br> Escalão(ões) : ' . $no = implode(",",$arrai); ?>
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
