<?php

namespace frontend\models;

use backend\models\Turma;
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
    public $nrPresentes;

    public function rules()
    {
        return [
            [['idAula', 'DiaSemana'], 'integer'],
            [['Estado'], 'string'],
            [['Nome', 'HoraInicio', 'HoraFim', 'Data'], 'safe'],
            [['nrPresentes'], 'safe'],
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

        $idUser = Yii::$app->user->getId();
        $tipoUtilizador = Yii::$app->user->identity->TipoUtilizador;
        if($tipoUtilizador == 'T'){
            //COISAS DO TREINADOR
            $utilizadorLogado = Treinador::find()->where(['Id_User' => $idUser])->one();
//            $aulas_turma = Turma::find()->where(['Treinador_idTreinador' => $utilizadorLogado->idTreinador])->all();
            $query = Aula::find();
//                ->from(['aula', 'turma'])
//                ->where(['Treinador_idTreinador' => $utilizadorLogado->idTreinador]);
            $subQuery1 = Turma::find();
            $query->leftJoin(['turmas' => $subQuery1], 'turmas.Aula_idAula = idAula')
                ->where(['Treinador_idTreinador' => $utilizadorLogado->idTreinador]);

            $subQuery2 = Presenca::find()->select('Aula_idAula, COUNT(Estado)=1 as nr_presentes');
            $query->leftJoin(['presentes' => $subQuery2], 'presentes.Aula_idAula = idAula');
        }else if($tipoUtilizador == 'A'){
            //COISAS DO ALUNO
            $utilizadorLogado = Aluno::find()->where(['Id_User' => $idUser])->one();
//            $aulas_turma = Presenca::find()->where(['Aluno_idAluno' => $utilizadorLogado->idAluno])->all();
            $query = Aula::find();
//                ->from(['aula'])
//                ->innerJoin(['presenca'])
//                ->on(['idAula' => 'Aula_idAula'])
//                ->where(['Aluno_idAluno' => $utilizadorLogado->idAluno]);
            $subQuery = Presenca::find();
            $query->leftJoin(['aulas' => $subQuery], 'aulas.Aula_idAula = idAula')->where(['Aluno_idAluno' => $utilizadorLogado->idAluno]);

        }

        //$query = Aula::find();

//        $idUser = Yii::$app->user->getId();
//        $tipoUtilizador = Yii::$app->user->identity->TipoUtilizador;
//        $utilizadorLogado = Aluno::find()->where(['Id_User' => $idUser])->one();

//        $subQuery = Presenca::find()->select('Aula_idAula, COUNT(Estado)=1 as nr_presentes');
//        $query->leftJoin(['presentes' => $subQuery], 'presentes.Aula_idAula = idAula');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        //$dataProvider->sort->$this->attributes['HoraInicio'] = ['desc' => ['HoraInicio' => SORT_DESC]];

//        $dataProvider->setSort([
//            'attributes' => [
//                'nrPresentes' => [
//                    'asc' => ['presentes.nr_presentes' => SORT_ASC],
//                    'desc' => ['presentes.nr_presentes' => SORT_DESC],
//                    'label' => 'Nr Name'
//                ]
//            ]
//        ]);

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

        $query->andFilterWhere(['like', 'Nome', $this->Nome])
            ->andFilterWhere(['like', 'presentes.nr_presentes', $this->nrPresentes])
        ;

        if($tipoUtilizador == 'T'){
            $query->andWhere(['presentes.nr_presentes' => $this->nrPresentes]);
        }

        $query->addOrderBy(['Data' => SORT_DESC]);
        //$query->sort->$this->attributes['HoraInicio'] = ['desc' => ['HoraInicio' => SORT_DESC]];

        return $dataProvider;
    }
}
