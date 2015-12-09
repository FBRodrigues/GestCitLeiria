<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Categorizacao;

/**
 * CategorizacaoSearch represents the model behind the search form about `backend\models\Categorizacao`.
 */
class CategorizacaoSearch extends Categorizacao
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idCategorizacao', 'Aluno_idAluno', 'Categorias_idCategorias'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Categorizacao::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'idCategorizacao' => $this->idCategorizacao,
            'Aluno_idAluno' => $this->Aluno_idAluno,
            'Categorias_idCategorias' => $this->Categorias_idCategorias,
        ]);

        return $dataProvider;
    }
}
