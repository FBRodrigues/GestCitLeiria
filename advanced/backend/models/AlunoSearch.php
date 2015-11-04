<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Aluno;

/**
 * AlunoSearch represents the model behind the search form about `backend\models\Aluno`.
 */
class AlunoSearch extends Aluno
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idAluno', 'Pessoa_idPessoa', 'Horario_idHorario', 'Escalao_idEscalao', 'Idade'], 'integer'],
            [['Nome', 'DataNascimento', 'Contato1', 'Contato2', 'Contato3/Email', 'EncarregadoEducacao', 'Sexo'], 'safe'],
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
            'DataNascimento' => $this->DataNascimento,
            'Idade' => $this->Idade,
        ]);

        $query->andFilterWhere(['like', 'Nome', $this->Nome])
            ->andFilterWhere(['like', 'Contato1', $this->Contato1])
            ->andFilterWhere(['like', 'Contato2', $this->Contato2])
            ->andFilterWhere(['like', 'Contato3/Email', $this->Contato3/Email])
            ->andFilterWhere(['like', 'EncarregadoEducacao', $this->EncarregadoEducacao])
            ->andFilterWhere(['like', 'Sexo', $this->Sexo]);

        return $dataProvider;
    }
}