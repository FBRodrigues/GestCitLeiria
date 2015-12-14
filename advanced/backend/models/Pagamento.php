<?php

namespace backend\models;


use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "pagamento".
 *
 * @property integer $idPagamento
 * @property integer $Aluno_idAluno
 * @property integer $valor
 * @property string $referencia
 * @property string $data
 * @property string $periodo
 * @property integer $nAulas
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
            [['Aluno_idAluno', 'valor', 'nAulas'], 'integer'],
            [['data', 'periodo'], 'safe'],
            [['referencia'], 'string', 'max' => 1000]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idPagamento' => 'ID Pagamento',
            'Aluno_idAluno' => 'Aluno Id Aluno',
            'valor' => 'Valor',
            'referencia' => 'Referencia',
            'data' => 'Data',
            'periodo' => 'Periodo',
            'nAulas' => 'N Aulas',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAlunoIdAluno()
    {
        return $this->hasOne(Aluno::className(), ['idAluno' => 'Aluno_idAluno']);
    }

    public function getAlunos(){
        $models= Aluno::find()->asArray()->all();
        return ArrayHelper::map($models,'idAluno','Nome');
    }
}
