<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * PresencaSearch represents the model behind the search form about `frontend\models\Presenca`.
 */
class PresencaSearch extends Presenca
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idPresenca', 'Aluno_idAluno', 'Aula_idAula', 'Presente'], 'integer'],
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
        $query = Presenca::find();

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
            'idPresenca' => $this->idPresenca,
            'Aluno_idAluno' => $this->Aluno_idAluno,
            'Aula_idAula' => $this->Aula_idAula,
            'Presente' => $this->Presente,
        ]);

        return $dataProvider;
    }

    public function procurarPresencaPorIDAula($idAula)
    {
        $aula = Aula::findOne($idAula);
        $presenca = Presenca::findOne($aula->aulaIdAula);

        return $presenca;
    }

    public function procuraAlunosPorIDPesenca($idPresenca)
    {
        $presenca = Presenca::findOne($idPresenca);
        $modelAluno = new Aluno();
        $alunos = Aluno::findAll($modelAluno->idAluno==$presenca->idPresenca);

        return $alunos;
    }


}
