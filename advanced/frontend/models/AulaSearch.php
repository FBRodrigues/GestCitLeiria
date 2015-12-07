<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * AulaSearch represents the model behind the search form about `frontend\models\Aula`.
 */
class AulaSearch extends Aula
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idAula'], 'integer'],
            [['Estado'], 'string'],
            [['Nome', 'HoraInicio', 'HoraFim'], 'safe'],
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
        $query = Aula::find();

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
            'idAula' => $this->idAula,
            'Nome' => $this->Nome,
            'HoraInicio' => $this->HoraInicio,
            'HoraFim' => $this->HoraFim,
            'Estado' => $this->Estado]);

        $query->andFilterWhere(['like', 'Nome', $this->Nome]);

        $query->addOrderBy(['HoraInicio' => SORT_DESC]);

        return $dataProvider;
    }
}
