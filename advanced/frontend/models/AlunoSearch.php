<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Aluno;

/**
 * AlunoSearch represents the model behind the search form about `frontend\models\Aluno`.
 */
class AlunoSearch extends Aluno
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idAluno', 'Pessoa_idPessoa', 'Horario_idHorario', 'Escalao_idEscalao', 'idade'], 'integer'],
            [['nome', 'dataNascimento', 'sexo'], 'safe'],
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
        $query = Aluno::find();

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
            'idAluno' => $this->idAluno,
            'Pessoa_idPessoa' => $this->Pessoa_idPessoa,
            'Horario_idHorario' => $this->Horario_idHorario,
            'Escalao_idEscalao' => $this->Escalao_idEscalao,
            'dataNascimento' => $this->dataNascimento,
            'idade' => $this->idade,
        ]);

        $query->andFilterWhere(['like', 'nome', $this->nome])
            ->andFilterWhere(['like', 'sexo', $this->sexo]);

        return $dataProvider;
    }
}