<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "pagamento".
 *
 * @property integer $idPagamento
 * @property integer $idInscricao
 * @property integer $valor
 * @property integer $nrFatura
 * @property string $dataFatura
 *
 * @property Inscricao $idInscricao0
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
            [['idInscricao', 'valor', 'nrFatura', 'dataFatura'], 'required'],
            [['idInscricao', 'valor', 'nrFatura'], 'integer'],
            [['dataFatura'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idPagamento' => 'Id Pagamento',
            'idInscricao' => 'Id Inscricao',
            'valor' => 'Valor',
            'nrFatura' => 'Nr Fatura',
            'dataFatura' => 'Data Fatura',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdInscricao0()
{
    return $this->hasOne(Inscricao::className(), ['idInscricao' => 'idInscricao']);
}

    public function getInscricoes()
    {
        $models = Inscricao::find()->asArray()->all();
        return ArrayHelper::map($models, 'idInscricao', 'idInscricao');
    }
}
