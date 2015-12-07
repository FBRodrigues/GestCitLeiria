<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "aluno".
 *
 * @property integer $idAluno
 * @property integer $Pessoa_idPessoa
 * @property integer $Horario_idHorario
 * @property integer $Escalao_idEscalao
 * @property string $Nome
 * @property string $DataNascimento
 * @property integer $Idade
 * @property string $Sexo
 *
 * @property Escalao $EscalaoIdEscalao
 * @property Horario $HorarioIdHorario
 * @property Pessoa $PessoaIdPessoa
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
            [['idAluno', 'Pessoa_idPessoa', 'Horario_idHorario', 'Escalao_idEscalao', 'NomeAluno', 'DataNascimento', 'Idade', 'Sexo', 'Contato1'], 'required'],
            [['idAluno', 'Pessoa_idPessoa', 'Horario_idHorario', 'Escalao_idEscalao', 'Idade'], 'integer'],
            [['DataNascimento'], 'safe'],
            [['NomeAluno'], 'string', 'max' => 20],
            [['Sexo'], 'string', 'max' => 1],
            [['Contato1'], 'string', 'max' => 45],

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idAluno' => 'Id Aluno',
            'Pessoa_idPessoa' => 'Pessoa Id Pessoa',
            'Horario_idHorario' => 'Horario Id Horario',
            'Escalao_idEscalao' => 'Escalao Id Escalao',
            'NomeAluno' => 'NomeAluno',
            'DataNascimento' => 'Data Nascimento',
            'Idade' => 'Idade',
            'Sexo' => 'Sexo',
            'Contato1' => 'Contato1',

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
    public function getHorarioIdHorario()
    {
        return $this->hasOne(Horario::className(), ['idHorario' => 'Horario_idHorario']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPessoaIdPessoa()
    {
        return $this->hasOne(Pessoa::className(), ['idPessoa' => 'Pessoa_idPessoa']);
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
}
