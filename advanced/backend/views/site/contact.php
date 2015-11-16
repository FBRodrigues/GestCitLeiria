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

  <?=Html::beginForm(['site/contact'],'post' );?>
  <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>

                <?= $form->field($model, 'name')?>
                <?= $form->field($model, 'select')->textarea(['rows'=>1]) ?>
                <?= $form->field($model,'subject')?>
                <?= $form->field($model, 'body')->textArea(['rows' => 6]) ?>

    <div class="form-group">
         <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
    </div>
            <?=Html::endForm();?>
            <?php ActiveForm::end(); ?>
        </div>
    </div>

    <?php $selection1 = Yii::$app->request->post('selection')?>
    <div class="Emails">

    </div>
</div>
