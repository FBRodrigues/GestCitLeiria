<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "categorias".
 *
 * @property integer $idCategorias
 * @property string $Valor
 *
 * @property Categorizacao[] $categorizacaos
 */
class Categorias extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'categorias';
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
            'idCategorias' => 'Id Categorias',
            'Valor' => 'Valor',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategorizacaos()
    {
        return $this->hasMany(Categorizacao::className(), ['Categorias_idCategorias' => 'idCategorias']);
    }
}
