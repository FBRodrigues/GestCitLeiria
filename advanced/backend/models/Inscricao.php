<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;

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
            [['idAluno', 'dataInicio', 'dataFim', 'tipo'], 'required'],
            [['idAluno', 'nrAulas'], 'integer'],
            [['dataInicio', 'dataFim'], 'safe'],
            ['dataInicio','validateDates'],
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
    public function validateDates(){
        if(strtotime($this->dataFim) <= strtotime($this->dataInicio)){
            $this->addError('start_date','Please give correct Start and End dates');
            $this->addError('end_date','Please give correct Start and End dates');
        }
    }
    public function getIdAluno0()
    {
        return $this->hasOne(Aluno::className(), ['idAluno' => 'idAluno']);
    }

    public function getAlunos()
    {
        $models = Aluno::find()->asArray()->all();
        return ArrayHelper::map($models, 'idAluno', 'Nome');
    }

    public function getAulasEfectuadas()
    {
        return $this->hasMany(Presenca::className(), ['Aluno_idAluno' => 'idAluno'])->where('Estado=1')->count('Estado');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPagamentos()
    {
        return $this->hasMany(Pagamento::className(), ['idInscricao' => 'idInscricao']);
    }
}
