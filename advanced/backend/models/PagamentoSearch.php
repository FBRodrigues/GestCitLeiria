<?php

namespace backend\models;

use frontend\models\Aluno;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Pagamento;
use yii\helpers\Json;
use yii\web\Session;

/**
 * PagamentoSearch represents the model behind the search form about `backend\models\Pagamento`.
 */
class PagamentoSearch extends Pagamento
{
    /**
     * @inheritdoc
     */
    public $nomeA;


    public function rules()
    {
        return [
            [['idPagamento', 'idInscricao', 'valor', 'nrFatura', 'nrAulas'], 'integer'],
            [['dataFatura', 'dataMaxPagamento','situacao'], 'safe'],
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
        $session = new Session();
        $session->open();
        $value1 = $session -> get ('id');
        var_dump($value1);

            $query = Pagamento::find()->where(['idInscricao'=> $value1]);






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
            'idInscricao' => $this->idInscricao,
            'valor' => $this->valor,
            'nrFatura' => $this->nrFatura,
            'dataFatura' => $this->dataFatura,
            'nrAulas' => $this->nrAulas,
            'dataMaxPagamento' => $this->dataMaxPagamento,
            'situacao' => $this->situacao,
        ]);

        //$query->andFilterWhere(['like', 'nomeA.NomeAluno', $this->nomeA]);

        return $dataProvider;
    }
}
