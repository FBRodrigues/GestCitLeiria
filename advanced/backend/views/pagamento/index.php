<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\grid\DataColumn;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\PagamentoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pagamentos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pagamento-index">



    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    </div>
    <style>
        .perigo {
            color: black;
            background-color: #ff0000 !important;
        }

        .sucesso {
            color: black;
            background-color: #c8ff97 !important;
        }
        .infor{
            color: black;
            background-color: #fdff99 !important;
        }
    </style>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'idInscricao',
            'valor',
            'nrFatura',
            // 'nrAulas',
             'dataMaxPagamento',
            [
                'label' => 'Situacao',
                'attribute'=> 'situacao',
                'contentOptions'=> function($model){
                  if ($model->situacao == 'Concluido')
                  {
                      return ['class' => 'sucesso'];
                  }elseif ($model->situacao == 'Pendente'){
                      return ['class'=> 'infor'];
                  }else{
                      return ['class'=>'perigo'];
                  }
                },
                'value'=> function($dataProvider){
                    $data = date('Y-m-d');
                    if($dataProvider->situacao != "Concluido"){
                        if($dataProvider->dataMaxPagamento <= $data ){
                        $dataProvider->situacao = "Atraso";

                        }

                    }
                    $dataProvider->save();
                    return  $dataProvider->situacao;
                },

                'format' =>'text',
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
