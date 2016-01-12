<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "aluno".
 *
 * @property integer $idAluno
 * @property integer $Escalao_idEscalao
 * @property string $DataNascimento
 * @property integer $Idade
 * @property string $Contato1
 * @property string $Contato2
 * @property string $Contato3_Email
 * @property string $EncarregadoEducacao
 * @property string $Sexo
 * @property string $Nome
 * @property string $valCate;
 * @property Escalao $escalaoIdEscalao
 * @property Categorizacao[] $categorizacaos
 * @property Marcacao[] $marcacaos
 * @property Pagamento[] $pagamentos
 * @property Presenca[] $presencas
 */
class Aluno extends \yii\db\ActiveRecord
{


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'aluno';
    }

    /**
     * @inheritdoc
     */

    public function rules()
    {
        return [
            [['Escalao_idEscalao'], 'required'],
            [['Escalao_idEscalao', 'Idade'], 'integer'],
            [['DataNascimento'], 'safe'],
            [['Sexo'], 'string', 'max' => 1],
            [['Contato1', 'Contato2', 'Contato3_Email', 'EncarregadoEducacao', 'Nome'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [

            'Valor' => Yii::t('app','Escalao'),
            'idAluno' => 'Id Aluno',
            'Escalao_idEscalao'=> 'Id Escalao',
            'Nome' => 'Nome',
            'DataNascimento' => 'Data Nascimento',
            'Idade' => 'Idade',
            'Contato1' => 'Contato1',
            'Contato2' => 'Contato2',
            'Contato3_Email' => 'Contato3  Email',
            'EncarregadoEducacao' => 'Encarregado Educacao',
            'Sexo' => 'Sexo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEscalaoIdEscalao()
    {
        return $this->hasOne(Escalao::className(), ['idEscalao' => 'Escalao_idEscalao']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategorizacaos()
    {

       return $this->hasMany(Categorizacao::className(), ['Aluno_idAluno' => 'idAluno']);

    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMarcacaos()
    {
        return $this->hasMany(Marcacao::className(), ['Aluno_idAluno' => 'idAluno']);

    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPagamentos()
    {
        return $this->hasMany(Pagamento::className(), ['Aluno_idAluno' => 'idAluno']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPresencas()
    {
        return $this->hasMany(Presenca::className(), ['Aluno_idAluno' => 'idAluno']);
    }
    public function getEscaloes()
    {
        $models = Escalao::find()->asArray()->all();
        return ArrayHelper::map($models, 'idEscalao', 'Valor');
    }

    public function getCategorias(){
        $models = Categorias::find()->asArray()->all();
        return ArrayHelper::map($models,'idAluno','Valor');
    }


 /*   public function getCategorizacaoss(){

        $itemsArray = array();
        $categorizacaos  = (new \yii\db\Query())
            ->select(['Categorias.Valor'])
            ->from(['Categorias'])
            ->join('LEFT JOIN','Categorizacao','Categorizacao.Categorias_idCategorias = Categorias.idCategorias')
            ->where(['Aluno_idAluno'=> '1'])
            ->all();
      //  var_dump($categorizacaos);



      //  var_dump($categorizacaos)

       // var_dump($categorizacaos);
        //foreach($categorizacaos->search()){

        //}
       // if(isset($categorizacaos)){
           // foreach($categorizacaos as $categorizacao){
            //    var_dump($categorizacaos);
            //    $itemArray[$categorizacao] = $categorizacao;
               //var_dump($itemArray[$categorizacao]);
       //         $categorizacaoss= implode(",",$categorizacaos);
           // }
       // }


       // var_dump($categorizacaoss);


    }*/


}
