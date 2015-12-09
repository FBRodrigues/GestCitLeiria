<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "pagamento".
 *
 * @property integer $idPagamento
 * @property integer $Aluno_idAluno
 *
 * @property Aluno $alunoIdAluno
 */
class Pagamento extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pagamento';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Aluno_idAluno'], 'required'],
            [['Aluno_idAluno'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idPagamento' => 'Id Pagamento',
            'Aluno_idAluno' => 'Aluno Id Aluno',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAlunoIdAluno()
    {
        return $this->hasOne(Aluno::className(), ['idAluno' => 'Aluno_idAluno']);
    }
}
