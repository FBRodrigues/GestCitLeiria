<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Aula;

/**
 * AulaSearch represents the model behind the search form about `backend\models\Aula`.
 */
class AulaSearch extends Aula
{
    /**
     * @inheritdoc
     */
    public $treinador;

    public function rules()
    {
        return [
            [['idAula', 'DiaSemana'], 'integer'],
            [['HoraInicio', 'HoraFim', 'Nome', 'Estado', 'Data'], 'safe'],
            [['treinador'], 'safe'],
        ];
    }

    /*public function attributes()
    {
        // add related fields to searchable attributes
        return array_merge(parent::attributes(), ['turmas.Treinador_idTreinador']);
    }*/

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
        $treinador = new Treinador();

        $query = Aula::find();

        /*
        $query = Aula::find()->select(['idAula', 'Aula.Nome', 'Data', 'HoraInicio', 'HoraFim', 'DiaSemana', 'Estado', 'Treinador.Nome AS NomeTreinador'])
            ->joinWith('treinadores')
            ->distinct()
        ; */

        $query->joinWith('treinador');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['treinador'] = [
            'asc' => ['Treinador.Nome' => SORT_ASC],
            'desc' => ['Treinador.Nome' => SORT_DESC]
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'idAula' => $this->idAula,
            'HoraInicio' => $this->HoraInicio,
            'HoraFim' => $this->HoraFim,
            'DiaSemana' => $this->DiaSemana,
            'Data' => $this->Data,
        ]);

        $query->andFilterWhere(['like', 'Aula.Nome', $this->Nome])
            ->andFilterWhere(['like', 'Estado', $this->Estado])
            ->andFilterWhere(['like', 'Treinador.Nome', $this->treinador])
        ;

        return $dataProvider;
    }
}
