<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "categorizacao".
 *
 * @property integer $idCategorizacao
 * @property integer $Aluno_idAluno
 * @property integer $Categorias_idCategorias
 *
 * @property Aluno $alunoIdAluno
 * @property Categorias $categoriasIdCategorias
 */
class Categorizacao extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'categorizacao';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Aluno_idAluno', 'Categorias_idCategorias'], 'required'],
            [['Aluno_idAluno', 'Categorias_idCategorias'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idCategorizacao' => 'Id Categorizacao',
            'Aluno_idAluno' => 'Aluno Id Aluno',
            'Categorias_idCategorias' => 'Categorias Id Categorias',
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
    public function getCategoriasIdCategorias()
    {
        return $this->hasOne(Categorias::className(), ['idCategorias' => 'Categorias_idCategorias']);
    }
}
