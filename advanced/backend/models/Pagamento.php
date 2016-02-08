<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "pagamento".
 *
 * @property integer $idPagamento
 * @property integer $idInscricao
 * @property integer $valor
 * @property integer $nrFatura
 * @property string $dataFatura
 * @property integer $nrAulas
 * @property string $dataMaxPagamento
 * @property string $situacao
 *
 * @property Inscricao $idInscricao0
 */
class Pagamento extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pagamento';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idInscricao', 'dataMaxPagamento', 'situacao'], 'required'],
            [['idInscricao', 'valor', 'nrFatura', 'nrAulas'], 'integer'],
            [['dataFatura', 'dataMaxPagamento'], 'safe'],
            [['situacao'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idPagamento' => 'Id Pagamento',
            'idInscricao' => 'Id Inscricao',
            'valor' => 'Valor',
            'nrFatura' => 'Nr Fatura',
            'dataFatura' => 'Data Fatura',
            'nrAulas' => 'Nr Aulas',
            'dataMaxPagamento' => 'Data Max Pagamento',
            'situacao' => 'Situacao',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdInscricao0()
    {
        return $this->hasOne(Inscricao::className(), ['idInscricao' => 'idInscricao']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function  getAluno(){
        return $this->hasOne(Aluno::className(), ['idAluno' => 'Inscricao.idAluno']);
    }
}
