<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;


/* @var $this yii\web\View */
/* @var $model frontend\models\Presenca */

/* @var $modelPresencaController frontend\controllers\PresencaController */
/* @var $idAula frontend\controllers\PresencaController */
/* @var $idPresenca frontend\controllers\PresencaController */

$this->title = $model->idAula;
$this->params['breadcrumbs'][] = ['label' => 'Presencas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="presenca-view">

    <h1><?= Html::encode($this->title) ?> </h1>



    <?php $form = ActiveForm::begin([
        'action' => ['presenca/update']
    ]);

    //var_dump($alunosInscritos);

    //echo $form->field($model, 'alunosPresentes')->checkboxList($alunosInscritos);
    //echo $form->field($model, 'alunosInscritos')->dropDownList($alunosInscritos);
    //echo json_encode($alunosInscritos);
    /*foreach($alunosInscritos as $alunoInscrito){
        echo $form->field($model, 'Estado')->dropDownList(['0'=> 'Presente', '1'=> 'Ausente'])->label($alunoInscrito[0]." - ".$alunoInscrito[1]);
    }*/

    //echo $form->radioButtonList($model, 'campos', array('0'=>"Presente", '1'=>"Ausente"));



    echo Html::submitButton($model->isNewRecord ? 'Create' : 'Confirmar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']);

    ActiveForm::end();

    ?>



</div>
