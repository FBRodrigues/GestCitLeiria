<?php

/* @var $this yii\web\View */
use yii\bootstrap\Alert;

$this->title = 'My Yii Application';
?>
<div class="site-index">


  <!--  </*?php

     foreach($datasSel as $value){
         if(date('Y-m-d')== date('Y-m-d',strtotime($value->DataNascimento))){
        //   echo '<script type="text/javascript">alert("O Associado do Clube '. $value->Nome . ' faz anos!");</script>';

             Alert::begin([
                 'options' => [
                     'class' => 'alert-warning',
                 ],
             ]);

             echo 'Say hello...';

             Alert::end();





             echo '<script type="text/javascript">';
             echo  'alert("O Associado do Clube '. $value->Nome .' faz Anos!")';
            echo' ';
             echo '</script>';
         }
    }

    ?>-->

    <div class="jumbotron">
        <!-- <h1>Centro Internacional Ténis de Leiria</h1> -->

        <?php echo \yii\helpers\Html::img('@web/img/citl.jpg', ['class' => 'center-block img-responsive']); ?>

    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">

            </div>
            <div class="col-lg-4">

            </div>
        </div>

    </div>
</div>



