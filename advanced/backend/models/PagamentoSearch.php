<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Pagamento;

/**
 * PagamentoSearch represents the model behind the search form about `backend\models\Pagamento`.
 */
class PagamentoSearch extends Pagamento
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idPagamento', 'Aluno_idAluno', 'valor', 'nAulas'], 'integer'],
            [['referencia', 'data', 'periodo'], 'safe'],
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
        $query = Pagamento::find();

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
            'idPagamento' => $this->idPagamento,
            'Aluno_idAluno' => $this->Aluno_idAluno,
            'valor' => $this->valor,
            'data' => $this->data,
            'periodo' => $this->periodo,
            'nAulas' => $this->nAulas,
        ]);

        $query->andFilterWhere(['like', 'referencia', $this->referencia]);

        return $dataProvider;
    }
}
