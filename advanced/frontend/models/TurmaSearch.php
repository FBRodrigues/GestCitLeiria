<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Turma;

/**
 * TurmaSearch represents the model behind the search form about `frontend\models\Turma`.
 */
class TurmaSearch extends Turma
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idTurma', 'Treinador_idTreinador', 'Aula_idAula'], 'integer'],
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
        $query = Turma::find();

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
            'idTurma' => $this->idTurma,
            'Treinador_idTreinador' => $this->Treinador_idTreinador,
            'Aula_idAula' => $this->Aula_idAula,
        ]);

        return $dataProvider;
    }
}
