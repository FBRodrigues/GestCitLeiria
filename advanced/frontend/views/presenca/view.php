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

    echo $form->field($model, 'alunosPresentes')->checkboxList($alunosInscritos);

    echo Html::submitButton($model->isNewRecord ? 'Create' : 'Confirmar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']);

    ActiveForm::end();

    ?>



</div>
