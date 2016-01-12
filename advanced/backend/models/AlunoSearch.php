<?php

namespace backend\models;


use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Aluno;
use yii\web\Session;

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
            [['idAluno',  'Idade'], 'integer'],
            [['DataNascimento','Escalao_idEscalao',
                'Contato1', 'Contato2', 'Contato3_Email', 'EncarregadoEducacao', 'Sexo', 'Nome'], 'safe'],
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
        $value1 = $session['Sexo'];
        $value2 = $session['Escaloes'];
        //$value3 = $session['Categorizacaos'];

        if($value1=='' && $value2=='' //&& $value3 == ''
            ){
            $query = Aluno::find();
         }elseif($value1!='' && $value2=='' //&& $value3 == ''
            ) {
            $query = Aluno::find()->where(['Sexo' => $value1]);

        }elseif($value1 =='' && $value2 != '' //&& $value3 == ''
            ){

            $query=Aluno::find()->where(['Escalao_idEscalao'=>$value2]);


      //  }elseif($value1 =='' && $value2 == '' && $value3 != '' ){
           // $query =Aluno::find()->where(['Categorizacaos'=>$value3]);
        } elseif($value1 !='' && $value2 !='' //&& $value3 != null
        ){


            $query= Aluno::find();
            $query->orWhere(['Sexo'=>$value1])
                  ->orWhere(['Escalao_idEscalao'=>$value2]);
         //         ->orWhere(['Categorizacaos'=>$value3]);

        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,

        ]);

        $dataProvider->pagination->pageSize = 1000;

        $query->joinWith(['escalaoIdEscalao']);
       // $query->joinWith(['categorizacaos']);


        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }


        $query->andFilterWhere([
            'idAluno' => $this->idAluno,
            'DataNascimento' => $this->DataNascimento,
            'Idade' => $this->Idade
        ]);

        $query->andFilterWhere(['like', 'Nome', $this->Nome])
            ->andFilterWhere(['like', 'Contato1', $this->Contato1])
            ->andFilterWhere(['like', 'Contato2', $this->Contato2])
            ->andFilterWhere(['like', 'Contato3_Email', $this->Contato3_Email])
            ->andFilterWhere(['like', 'EncarregadoEducacao', $this->EncarregadoEducacao])
            ->andFilterWhere(['like', 'Sexo', $this->Sexo])
            ->andFilterWhere(['like', 'escalao.Valor', $this-> Escalao_idEscalao])
        //    ->andFilterWhere(['like','categorizacaos',$this->Categorizacaos])
        ;



        return $dataProvider;
    }
}
