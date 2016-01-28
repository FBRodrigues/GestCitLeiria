<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "presenca".
 *
 * @property integer $idPresenca
 * @property integer $Aluno_idAluno
 * @property integer $Aula_idAula
 * @property string $Estado
 * @property string $TipoAula
 *
 * @property Aluno $alunoIdAluno
 * @property Aula $aulaIdAula
 */
class Presenca extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'presenca';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Aluno_idAluno', 'Aula_idAula'], 'required'],
            [['Aluno_idAluno', 'Aula_idAula'], 'integer'],
            [['Estado', 'TipoAula'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idPresenca' => 'Id Presenca',
            'Aluno_idAluno' => 'Aluno Id Aluno',
            'Aula_idAula' => 'Aula Id Aula',
            'Estado' => 'Estado',
            'TipoAula' => 'Tipo Aula',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAlunoIdAluno()
    {
        return $this->hasOne(Aluno::className(), ['idAluno' => 'Aluno_idAluno']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAulaIdAula()
    {
        return $this->hasOne(Aula::className(), ['idAula' => 'Aula_idAula']);
    }
}
