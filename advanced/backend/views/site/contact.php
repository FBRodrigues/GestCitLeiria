<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \backend\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;


$this->title = 'Envio de Email';
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
                <?= $form->field($model,'assunto')?>
                <?= $form->field($model, 'emails_selecionados')->textarea(['rows'=>2])?>
                <?= $form->field($model, 'mensagem')->textArea(['rows' => 6]) ?>

    <div class="form-group">
         <?= Html::submitButton('Enviar', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
    </div>
            <?=Html::endForm();?>
            <?php ActiveForm::end(); ?>
        </div>
    </div>


</div>

<div class="Emails">


    <!--<script>
        function echoRemover(){
            alert("<//?php remover(); ?>");
        }
    </script>-->
  <!--  <//?php
   /* function remover() {
       // $form = ActiveForm::begin(['id' => 'contact-form']);
        //foreach($emails as $value){

        //}

        echo "botão removido com sucesso!";

    }*/
    ?>-->
  <!-- </*?php
    foreach($emails as $value){
        echo '<br>'. $value . '    '.  Html::a('Remover', ['delete','valor'=>$value], [
        'class' => 'btn btn-danger',
        'data' => ['confirm' => 'Are you sure you want to delete this item?',],]);'</br>' ;



    }*/
    ?>-->

</div>
