<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "escalao".
 *
 * @property integer $idEscalao
 * @property string $Valor
 *
 * @property Aluno[] $alunos
 */
class Escalao extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'escalao';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Valor'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idEscalao' => 'Id Escalao',
            'Valor' => 'Valor',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAlunos()
    {
        return $this->hasMany(Aluno::className(), ['Escalao_idEscalao' => 'idEscalao']);
    }
}
