<?php

namespace backend\models;

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
 * @property string $Contato1
 * @property string $Contato2
 * @property string $Contato3_Email
 * @property string $EncarregadoEducacao
 * @property string $Sexo
 *
 * @property Pessoa $pessoaIdPessoa
 * @property Horario $horarioIdHorario
 * @property Escalao $escalaoIdEscalao
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
            [['idAluno', 'Pessoa_idPessoa', 'Horario_idHorario', 'Escalao_idEscalao'], 'required'],
            [['idAluno', 'Pessoa_idPessoa', 'Horario_idHorario', 'Escalao_idEscalao', 'Idade'], 'integer'],
            [['DataNascimento'], 'safe'],
            [['Nome', 'Contato1', 'Contato2', 'Contato3_Email', 'EncarregadoEducacao'], 'string', 'max' => 45],
            [['Sexo'], 'string', 'max' => 1]
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
    public function getPessoaIdPessoa()
    {
        return $this->hasOne(Pessoa::className(), ['idPessoa' => 'Pessoa_idPessoa']);
    }

    public function getEmail(){
        return $this->hasMany(Aluno::className(),['']);

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
    public function getEscalaoIdEscalao()
    {
        return $this->hasOne(Escalao::className(), ['idEscalao' => 'Escalao_idEscalao']);
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
