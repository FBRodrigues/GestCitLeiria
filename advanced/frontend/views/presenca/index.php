<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\DetailView;

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

        //echo var_dump($listaAlunos);
        //echo var_dump($listaPresencas)

    ?>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\CheckboxColumn'],
            //['class' => 'yii\grid\SerialColumn'],

            'idPresenca',
            'Aluno_idAluno',
            //'Aula_idAula',
            'Estado',
            'TipoAula',

            //['class' => 'yii\grid\ActionColumn'],
        ],




    ]); ?>








    <div class="form-group">
       <!-- <?= Html::submitButton('Confirmar', ['class' => 'btn btn-primary']) ?> -->
        <!-- <?= Html::submitButton('Confirmar', ['class' => 'btn btn-primary', 'Presente' => 'edit-button']) ?> -->
        <?= Html::submitButton('Apply', ['class' => 'btn btn-success', 'name' => 'submit', 'value' => 'apply']) ?>

    </div>



</div>
