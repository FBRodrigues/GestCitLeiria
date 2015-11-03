<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\AgendaForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\HtmlPurifier;

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

            <?php foreach($aulas as $value){
                //echo $value['idAula'].'<br>';
                echo '<br>'.$value['nome'].'<br>';
                echo $value['horaInicio'].'<br>';
                echo $value['horaFim'].'<br>';
                echo $value['choveu'].'<br>';
                echo '---';
                //var_dump($value);

            }


            ?>


            <div class="form-group">
                <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'agenda-button']) ?>

            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>

    <div class="agenda">
        <h2><?= Html::encode($model->title) ?></h2>
        <?= HtmlPurifier::process($model->text) ?>
    </div>

</div>
