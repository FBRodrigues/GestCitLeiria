<?php

use yii\helpers\Html;
use yii\grid\GridView;


/* @var $this yii\web\View */
/* @var $searchModel backend\models\AlunoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider  */

$this->title = 'Alunos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="aluno-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php  //echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Aluno', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class'=>'yii\grid\CheckboxColumn'],
             //['class' => 'yii\grid\SerialColumn'],


            'idAluno',
            //'Pessoa_idPessoa',
            //'Horario_idHorario',
            'Escalao_idEscalao',
            'Nome',
            // 'DataNascimento',
             'Idade',
             'Contato1',
             'Contato2',
             'Contato3_Email:email',
            // 'EncarregadoEducacao',
             'Sexo',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <p>

       <?= Html::a('Enviar Email', ['site/contact'],array(['class' => 'btn btn-primary']) );
       ?>
    </p>



    <?php
    function getEmail($email){
        $connection = new \yii\db\Connection([
        'dsn' =>'mysql:host=127.0.0.1;dbname=mydb',
        'username'=>'root',
        'password'=>'',

    ]);
    $connection->open();
    $command= $connection->createCommand('SELECT Contato3_Email FROM aluno');
    $command->execute();
    $email = $command->queryAll();
    }

    ?>

    <script type="text/javascript">
        $(document).ready(function(){
        $("#email").click(function(){
            var keys = $("#w1").yiiGridView("getSelectedRows");
        });
    </script>

</div>
