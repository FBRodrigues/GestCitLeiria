<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \backend\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Lista de Sócios';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-contact">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>


    </p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>


                <?= $form->field($model, 'name') ?>

                <!--<7*?= $form->field($model, 'email') ?>-->

                <?= $form->field($model, 'subject') ?>

                <?= $form->field($model, 'body')->textArea(['rows' => 6]) ?>

        <?=Html::beginForm('action','post')?>
    <div class="form-group">

                    <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
    </div>

        <?= Html::endForm();?>

            <div class="Emails">
             <div class="col-lg-push-5">
                <!-- </*?=$form->field($model,'Selection')?>-->
             </div>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>

</div>
