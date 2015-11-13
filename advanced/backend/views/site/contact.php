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


    <?=Html::beginForm(['site/contact'],'post' );?>
  <div class="row">
        <div class="col-lg-5">



            <?php $selection = Yii::$app->request->post('selection')?>
            <?php $action = Yii::$app->request->post('action')?>
            <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>

                <?= $form->field($model, 'name')?>
                <?= $form->field($model, 'select') ?>
                <?= $form->field($model,'subject')?>
                <?= $form->field($model, 'body')->textArea(['rows' => 6]) ?>



    <div class="form-group">
         <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
    </div>


            <div class="Emails">
             <div class="col-lg-push-5">
                <!-- </*?=$form->field($model,'Selection')?>-->
             </div>
            </div>
            <?=Html::endForm();?>
            <?php ActiveForm::end(); ?>
        </div>
    </div>

</div>
