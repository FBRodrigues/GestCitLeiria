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
            [['idAluno', 'Escalao_idEscalao', 'Idade'], 'integer'],
            [['Nome', 'DataNascimento', 'Sexo'], 'safe'],

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
    public function search($params, $id)
    {
        $pesquisa = 'SELECT au.*, al.*, p.Estado as Presenca FROM aluno al, presenca p, aula au WHERE al.idAluno = p.Aluno_idAluno AND p.Aluno_idAluno = au.idAula AND au.idAula ='.$id;

        $query = Aluno::findBySql($pesquisa);



        $alunosDataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);




        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $alunosDataProvider;
        }

        $query->andFilterWhere([
            'idAluno' => $this->idAluno,
            'Escalao_idEscalao' => $this->Escalao_idEscalao,
            'Nome' => $this->Nome,
            'DataNascimento' => $this->DataNascimento,
            'Idade' => $this->Idade,
            'Contato1' => $this->Contato1,
            'Contato2' => $this->Contato2,
            'Contato3_Email' => $this->Contato3_Email,
            'EncarregadoEducacao' => $this->EncarregadoEducacao,
            'Sexo' => $this->Sexo,

        ]);

        $query->andFilterWhere(['like', 'Nome', $this->Nome])
            ->andFilterWhere(['like', 'Sexo', $this->Sexo]);

        return $alunosDataProvider;
    }
}
