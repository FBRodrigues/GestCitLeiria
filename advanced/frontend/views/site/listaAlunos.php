<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ListaAlunosForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
//use yii\captcha\Captcha;

$this->title = 'ListaAlunos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-listaAlunos">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        Agenda
    </p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'listaAlunos-form']); ?>

            <!-- checkbutton para a chuva -->


            <!-- apresentar/carregar lista de alunos aqui -->

            <!--foreach($alunos as $value){
                //echo $value['aluno']['id'] ;
                //var_dump($value);

            //}

            <!-- checkbutton por cada linha(aluno) -->


            <div class="form-group">
                <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'listaAlunos-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>

</div>
