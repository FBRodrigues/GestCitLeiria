<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "turma".
 *
 * @property integer $idTurma
 * @property integer $Treinador_idTreinador
 * @property integer $Aula_idAula
 *
 * @property Aula $aulaIdAula
 * @property Treinador $treinadorIdTreinador
 */
class Turma extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'turma';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Treinador_idTreinador', 'Aula_idAula'], 'required'],
            [['Treinador_idTreinador', 'Aula_idAula'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idTurma' => 'Id Turma',
            'Treinador_idTreinador' => 'Treinador Id Treinador',
            'Aula_idAula' => 'Aula Id Aula',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAulaIdAula()
    {
        return $this->hasOne(Aula::className(), ['idAula' => 'Aula_idAula']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTreinadorIdTreinador()
    {
        return $this->hasOne(Treinador::className(), ['idTreinador' => 'Treinador_idTreinador']);
    }

    public function procurarTreinadorPorID($idTreinador)
    {
        $treinador = new Treinador();

        $idT = $treinador->findAll(
            ['Id_User' => $idTreinador]
        );

        return $idT;
    }

}
