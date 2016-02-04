<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Aula */

//$this->title = $model->idAula;
$this->params['breadcrumbs'][] = ['label' => 'Aulas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$estadoNumerico = $model->Estado;
switch($estadoNumerico){
    case 0:
        $estadoSTR = 'Não escolhido';
        break;
    case 1:
        $estadoSTR = 'Realizada';
        break;
    case 2:
        $estadoSTR = 'Não realizada-Condições meteorológicas';
        break;
    case 3:
        $estadoSTR = 'Não realizada-FP';
        break;
    case 4:
        $estadoSTR = 'Não realizada-FA';
        break;
    default:
        $estadoSTR = 'Estado da aula não existente';
        //break;
}
?>
<div class="aula-view">

    <h3><?= Html::encode("Detalhe da aula") ?></h3>

    <p>
        <!--<?= Html::a('Update', ['update', 'id' => $model->idAula], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->idAula], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>-->
    </p>

    <?php
    echo 'Nome: '.$model->Nome.'</br>'.'</br>';
    echo 'Data: '.$model->Data.'</br>'.'</br>';
    echo 'Hora de inicio: '.$model->HoraInicio.'</br>'.'</br>';
    echo 'Hora de fim: '.$model->HoraFim.'</br>'.'</br>';
    echo 'Treinador: '.$model->turmas[0]->treinadorIdTreinador->Nome.'</br>'.'</br>';
    echo 'Estado: '.$estadoSTR.'</br>'.'</br>';
    ?>


   <!--<?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idAula',
            'HoraInicio',
            'HoraFim',
            'Nome',
            'Estado',

        ],
    ]) ?>-->

    <p>
        <br>
        <?=
        $idAula = Yii::$app->request->post('Aula')['idAula'];
        $post['Aula']['idAula'] = $idAula;
        echo Html::a('Editar aula', ['update'], ['class' => 'btn btn-success'])
        ?>
    </p>

</div>
