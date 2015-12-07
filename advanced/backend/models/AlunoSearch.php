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
    public $valor;
    public function rules()
    {
        return [
            [['idAluno', 'Escalao_idEscalao', 'Idade'], 'integer'],
            [['Nome', 'DataNascimento', 'Contato1', 'Contato2', 'Contato3_Email', 'EncarregadoEducacao', 'Sexo','valor'], 'safe'],
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

        $dataProvider->pagination->pageSize = 1000;
        $dataProvider->setSort([
            'attributes' => [
                'idAluno',
                'valor' => [
                    'asc' => ['Escalao.valor' => SORT_ASC],
                    'desc' => ['Escalao.valor' => SORT_DESC],
                    'label' => 'Escalao',
                    'default' => SORT_DESC
                ],
                'Escalao_idEscalao',
                'DataNascimento',
                'Idade',
                'Nome',
                'Contato1',
                'Contato2',
                'Contato3_Email',
                'EncarregadoEducacao',
                'Sexo'

            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            $query->joinWith(['escalaoIdEscalao']);
            return $dataProvider;
        }

        $this->addCondition($query,'valor');

        $query->andFilterWhere([
            'idAluno' => $this->idAluno,
            'Escalao_idEscalao' => $this->Escalao_idEscalao,
        'DataNascimento' => $this->DataNascimento,
            'Idade' => $this->Idade,
        ]);

        $query->andFilterWhere(['like', 'Nome', $this->Nome])
            ->andFilterWhere(['like', 'Contato1', $this->Contato1])
            ->andFilterWhere(['like', 'Contato2', $this->Contato2])
            ->andFilterWhere(['like', 'Contato3_Email', $this->Contato3_Email])
            ->andFilterWhere(['like', 'EncarregadoEducacao', $this->EncarregadoEducacao])
            ->andFilterWhere(['like', 'Sexo', $this->Sexo]);
        $query->joinWith(['escalaoIdEscalao' => function ($q) {
            $q->where('Escalao.valor LIKE "%' . $this->valor . '%"');
        }]);
        return $dataProvider;
    }

    protected function addCondition($query, $attribute, $partialMatch = false)
    {
        if (($pos = strrpos($attribute, '.')) !== false) {
            $modelAttribute = substr($attribute, $pos + 1);
        } else {
            $modelAttribute = $attribute;
        }

        $value = $this->$modelAttribute;
        if (trim($value) === '') {
            return;
        }

        /*
         * The following line is additionally added for right aliasing
         * of columns so filtering happen correctly in the self join
         */
        $attribute = "Escalao.$attribute";

        if ($partialMatch) {
            $query->andWhere(['like', $attribute, $value]);
        } else {
            $query->andWhere([$attribute => $value]);
        }
    }
}
