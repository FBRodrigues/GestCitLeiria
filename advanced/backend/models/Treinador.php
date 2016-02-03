<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "treinador".
 *
 * @property integer $idTreinador
 * @property string $Nome
 * @property integer $contato
 * @property string $email
 *
 * @property Horario[] $horarios
 * @property Turma[] $turmas
 */
class Treinador extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'treinador';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idTreinador', 'contato', 'email'], 'required'],
            [['idTreinador', 'contato'], 'integer'],
            [['email'], 'string'],
            [['Nome'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idTreinador' => 'Id Treinador',
            'Nome' => 'Nome',
            'contato' => 'Contato',
            'email' => 'Email',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHorarios()
    {
        return $this->hasMany(Horario::className(), ['Treinador_idTreinador' => 'idTreinador']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTurmas()
    {
        return $this->hasMany(Turma::className(), ['Treinador_idTreinador' => 'idTreinador']);
    }
}
