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
 * @property string $nome
 * @property string $dataNascimento
 * @property integer $idade
 * @property string $sexo
 *
 * @property Escalao $escalaoIdEscalao
 * @property Horario $horarioIdHorario
 * @property Pessoa $pessoaIdPessoa
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
            [['idAluno', 'Pessoa_idPessoa', 'Horario_idHorario', 'Escalao_idEscalao', 'nome', 'dataNascimento', 'idade', 'sexo'], 'required'],
            [['idAluno', 'Pessoa_idPessoa', 'Horario_idHorario', 'Escalao_idEscalao', 'idade'], 'integer'],
            [['dataNascimento'], 'safe'],
            [['nome'], 'string', 'max' => 20],
            [['sexo'], 'string', 'max' => 1]
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
            'nome' => 'Nome',
            'dataNascimento' => 'Data Nascimento',
            'idade' => 'Idade',
            'sexo' => 'Sexo',
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
