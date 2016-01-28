<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "treinador".
 *
 * @property integer $idTreinador
 * @property string $Nome
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
            [['idTreinador'], 'required'],
            [['idTreinador'], 'integer'],
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
