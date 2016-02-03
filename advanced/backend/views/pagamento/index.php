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

    <p>
        <?= Html::a('Create Pagamento', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <style>
        .perigo {
            color: black;
            background-color: red !important;
        }

        .sucesso {
            color: black;
            background-color: #C0FFBE !important;
        }
        .infor{
            color: black;
            background-color: yellow;
        }
    </style>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'rowOptions'=> function($model) {
            if($model->situacao == 'Concluido'){

                return ['class'=>'sucesso'];
            }elseif($model->situacao == 'Em Atraso'){
                return ['class'=>'perigo'];

            }elseif($model->situacao == 'pendente'){
                return ['class'=>'infor'];
            }

        },
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],


            'idPagamento',
            'idInscricao',
            'valor',
            'nrFatura',
            'dataFatura',
            // 'nrAulas',
             'dataMaxPagamento',
            [
                'label' => 'Situacao',
                'attribute'=> 'situacao',
                'value'=> function($dataProvider){
                    $data = date('Y-m-d');
                    if($dataProvider->situacao != "Concluido"){
                        if($dataProvider->dataMaxPagamento < $data ){
                        $dataProvider->situacao = "Em atraso";
                        }
                    }
                    return  $dataProvider->situacao;//implode(",",ArrayHelper::map($dataProvider->categorias,'idCategorias','Valor'));

                },

                'format' =>'text',
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
