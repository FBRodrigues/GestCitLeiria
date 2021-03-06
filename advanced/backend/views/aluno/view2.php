<?php


use yii\helpers\Html;
use yii\grid\GridView;

use yii\widgets\ActiveForm;


/**
 * Created by PhpStorm.
 * User: Pedro Camponês
 * Date: 13/12/2015
 * Time: 15:50
 */

?>

<div class="aluno-view">


    <?=Html::beginForm(['aluno/index'],'post' )?>
    <?php $form = ActiveForm::begin(); ?>
    <?php
            $dataProviderEsc = \backend\models\Escalao::find()->all();
            $esca = [];
            foreach($dataProviderEsc as $es){
                $esca[$es->idEscalao]= $es->Valor;
            }


    ?>
    <?php
    $dataProviderCat = \backend\models\Categorias::find()->all();
    $categorias = [];
    foreach($dataProviderCat as $value){
        $categorias[$value->idCategorias] = $value->Valor;
    }
    ?>
    <?= $form->field($model,'Escaloes')->checkboxList($esca,['selection'=>'checked'])?>
    <?= $form->field($model, 'Sexo')->dropDownList(['M'=>'Masculino','F'=>'Feminino'],['prompt'=>'Selecione uma opção'])->label('Sexo') ?>
    <?= $form->field($model, 'categorias')->checkboxList($categorias,['selection1'=>'checked','separator'=>'<br>'])->label('Categorias') ?>


    <?=Html::submitButton('Pesquisa Avançada',['class' => 'btn btn-info','name'=>'pes']);?>
    <?=Html::resetButton('Limpar Pesquisa', ['class' => 'btn btn-default']);?>

    </div>
    <?=Html::endForm();?>
    <?php ActiveForm::end(); ?>


</div>
