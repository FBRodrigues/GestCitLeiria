<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "treinador".
 *
 * @property integer $idTreinador
 * @property string $Nome
 * @property integer $Id_User
 *
 * @property Horario[] $horarios
 * @property User $idUser
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
            [['idTreinador'], 'required'],
            [['idTreinador', 'Id_User'], 'integer'],
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
            'Id_User' => 'Id  User',
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
    public function getIdUser()
    {
        return $this->hasOne(User::className(), ['id' => 'Id_User']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTurmas()
    {
        return $this->hasMany(Turma::className(), ['Treinador_idTreinador' => 'idTreinador']);
    }
}
