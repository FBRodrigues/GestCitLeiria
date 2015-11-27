<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PresencaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Presencas';
$this->params['breadcrumbs'][] = $this->title;
$id = Yii::$app->getRequest()->getQueryParam('idAula');
?>
<div class="presenca-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
       <!-- <?=  Html::a('Create Presenca', ['create'], ['class' => 'btn btn-success']) ?> -->
    </p>

    <?=
        $id = Yii::$app->getRequest()->getQueryParam('idAula');
    //echo $id;

    //echo var_dump($searchModel);

    ?>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idPresenca',
            'Aluno_idAluno',
            'Aula_idAula',
            'Presente',

            ['class' => 'yii\grid\ActionColumn'],
        ],




    ]); ?>






</div>
