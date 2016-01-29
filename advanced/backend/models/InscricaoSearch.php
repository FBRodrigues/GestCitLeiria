<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Inscricao;

/**
 * InscricaoSearch represents the model behind the search form about `backend\models\Inscricao`.
 */
class InscricaoSearch extends Inscricao
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idInscricao', 'idAluno', 'nrAulas'], 'integer'],
            [['dataInicio', 'dataFim', 'tipo'], 'safe'],
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
        $query = Inscricao::find();

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
            'idInscricao' => $this->idInscricao,
            'aluno.Nome' => $this->idAluno,
            'dataInicio' => $this->dataInicio,
            'dataFim' => $this->dataFim,
            'nrAulas' => $this->nrAulas,
        ]);

        $query->andFilterWhere(['like', 'tipo', $this->tipo])
        ->andFilterWhere(['like', 'aluno.Nome', $this-> idAluno]);

        return $dataProvider;
    }
}
