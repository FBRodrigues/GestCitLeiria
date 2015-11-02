<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\AgendaForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
//use yii\captcha\Captcha;

$this->title = 'Agenda';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-agenda">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        Agenda
    </p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'agenda-form']); ?>

            <!-- apresentar/carregar lista de aulas aqui -->




            <div class="form-group">
                <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'agenda-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>

</div>
