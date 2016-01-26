<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "inscricao".
 *
 * @property integer $idInscricao
 * @property integer $idAluno
 * @property string $dataInicio
 * @property string $dataFim
 * @property integer $nrAulas
 * @property string $tipo
 *
 * @property Aluno $idAluno0
 * @property Pagamento[] $pagamentos
 */
class Inscricao extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'inscricao';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idAluno', 'dataInicio', 'dataFim', 'nrAulas', 'tipo'], 'required'],
            [['idAluno', 'nrAulas'], 'integer'],
            [['dataInicio', 'dataFim'], 'safe'],
            [['tipo'], 'string', 'max' => 11]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idInscricao' => 'Id Inscricao',
            'idAluno' => 'Id Aluno',
            'dataInicio' => 'Data Inicio',
            'dataFim' => 'Data Fim',
            'nrAulas' => 'Nr Aulas',
            'tipo' => 'Tipo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdAluno0()
    {
        return $this->hasOne(Aluno::className(), ['idAluno' => 'idAluno']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPagamentos()
    {
        return $this->hasMany(Pagamento::className(), ['idInscricao' => 'idInscricao']);
    }
}
