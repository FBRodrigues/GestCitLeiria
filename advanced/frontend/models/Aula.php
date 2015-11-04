<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "aula".
 *
 * @property integer $idAula
 * @property string $nome
 * @property string $horaInicio
 * @property string $horaFim
 * @property string $choveu
 *
 * @property Presenca[] $presencas
 * @property Turma[] $turmas
 */
class Aula extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'aula';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idAula', 'nome', 'horaInicio', 'horaFim', 'choveu'], 'required'],
            [['idAula'], 'integer'],
            [['horaInicio', 'horaFim'], 'safe'],
            [['nome'], 'string', 'max' => 10],
            [['choveu'], 'string', 'max' => 1]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idAula' => 'Id Aula',
            'nome' => 'Nome',
            'horaInicio' => 'Hora Inicio',
            'horaFim' => 'Hora Fim',
            'choveu' => 'Choveu',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPresencas()
    {
        return $this->hasMany(Presenca::className(), ['Aula_idAula' => 'idAula']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTurmas()
    {
        return $this->hasMany(Turma::className(), ['Aula_idAula' => 'idAula']);
    }
}
