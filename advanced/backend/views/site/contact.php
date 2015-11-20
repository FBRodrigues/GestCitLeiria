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
            <!-- por os nomes do modelos-->
            <?php
            //pode ser necessario
           // for($i =0, $c = count($emailsSel); $i <= $c; $i++){
           //     $model->select = $emailsSel[$i++]->Contato3_Email;
           // }
            ?>

                <?= $form->field($model, 'select')->textarea(['rows' => 6])?>
                <?= $form->field($model,'subject')?>
                <?= $form->field($model, 'body')->textArea(['rows' => 6]) ?>

    <div class="form-group">
         <?= Html::submitButton('Enviar', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
    </div>
            <?=Html::endForm();?>
            <?php ActiveForm::end(); ?>
        </div>
    </div>


</div>

<div class="Emails">
    <?php
    foreach($emails as $value){
        echo '<br> '. $value .  '   <button class="btn btn-primary" onclick="remover()" type="button" >Remover</button> </br>';

    }

    ?>
</div>
