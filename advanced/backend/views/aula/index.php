<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\controllers\AulaController;
use backend\models\Turma;


/* @var $this yii\web\View */
/* @var $searchModel backend\models\AulaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


$this->title = 'Aulas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="aula-index">

    <h1><?= Html::encode("Bem vindo") ?></h1>


    <div class="botao-create">

        <p>
            <?= Html::a('Marcar aula única', ['create'], ['class' => 'btn btn-success']) ?>
        </p>


    </div>


    <div class="botao-create2">

        <p>
            <?= Html::a('Marcar várias aulas', ['create2'], ['class' => 'btn btn-success']) ?>
        </p>


    </div>

<?= GridView::widget([
    'dataProvider' => $dataProvider,

    'filterModel' => $searchModel,

    //Experiencia

    /* 'columns' => array(
         array(
             'id' => 'selectedIds',
             'class' => 'CCheckBoxColumn'
         ),*/

    'columns' => [

        //['class'=>'yii\grid\CheckboxColumn'],

        //'idAula',
        //'Choveu',
        'Nome',
        [
        'attribute' => 'treinador',
        'value' => 'treinador.Nome'
        ],
        //'treinadores.NomeTreinador',
        //['label' => 'Nome Treinador'],
        //'Estado',
        'Data',
        'HoraInicio',
        'HoraFim',

        ['class' => 'yii\grid\ActionColumn', 'template' => '{delete}']

    ],




    'rowOptions' => function($model, $key, $index, $grid) {
        //echo $model->idAula.'__';
        return ['id' => $model['idAula'], 'onClick' => 'location.href="'.Yii::$app->urlManager->createUrl('aula/view').'&id="+(this.id)'];
    }



]);

?>

</div>
