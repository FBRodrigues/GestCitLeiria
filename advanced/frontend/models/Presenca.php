<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "presenca".
 *
 * @property integer $idPresenca
 * @property integer $Aluno_idAluno
 * @property integer $Aula_idAula
 * @property integer $Presente
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
            [['idPresenca', 'Aluno_idAluno', 'Aula_idAula'], 'required'],
            [['idPresenca', 'Aluno_idAluno', 'Aula_idAula'], 'integer'],
            [['Estado'], 'string']
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


    public function getNomes()
    {
        $models = Aluno::find()->asArray()->all();
        return ArrayHelper::map($models, 'idAluno', 'NomeAluno');
    }



   /* public function atualizar()
    {
        $model = Aluno::findOne(idAluno);
        $model->Presente = 'Presente';
        $model->save();

    }*/
}
