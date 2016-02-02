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

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
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
                /* ['class'=>'yii\grid\DataColumn',
                     'rowOptions'=>function($dataProvider,$index,$widget,$grid){
                         if($dataProvider->situacao == "Concluido"){
                             return ['class'=>'sucess'];
                         }elseif($dataProvider->situacao == "Em atraso"){
                             return ['class'=> 'danger'];
                         }
                     },

                 ],
        */


                'value'=> function($dataProvider){
                    $data = date('Y-m-d');
                    if($dataProvider->situacao != "Concluido"){
                        if($dataProvider->dataMaxPagamento < $data ){
                        $dataProvider->situacao = "Em atraso";
                             "<span style='background-color: red'>";
                        }
                    }else{
                         "<span style='background-color: green '>" . $dataProvider->situacao . "</span>";
                    }
                    return  $dataProvider->situacao;//implode(",",ArrayHelper::map($dataProvider->categorias,'idCategorias','Valor'));

                },

                'format' =>'text',
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
