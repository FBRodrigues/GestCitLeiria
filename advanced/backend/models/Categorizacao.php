<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;

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

    public function getAlunos()
    {
        $models = Aluno::find()->asArray()->limit(1000)->all();
        return ArrayHelper::map($models, 'idAluno', 'Nome');
    }

    public function getCategorias()
    {
        $models = Categorias::find()->asArray()->all();
        return ArrayHelper::map($models, 'idCategorias', 'Valor');
    }
    public function getEscaloes(){
        $models = Escalao::find()->asArray()->all();
        return ArrayHelper::map($models, 'idEscalao', 'Valor');
    }
    public function getSexo(){
        $model = Aluno::find()->asArray()->all();
        return ArrayHelper::map($model,'idAluno','Sexo');
    }
}
