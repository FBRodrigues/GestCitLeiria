<?php

namespace backend\models;

use frontend\models\Treinador;
use Yii;

/**
 * This is the model class for table "aula".
 *
 * @property integer $idAula
 * @property string $HoraInicio
 * @property string $HoraFim
 * @property string $Nome
 * @property string $Estado
 * @property integer $DiaSemana
 * @property string $Data
 *
 * @property Horario[] $horarios
 * @property Presenca[] $presencas
 * @property Turma[] $turmas
 */
class Aula extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'aula';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['HoraInicio', 'HoraFim', 'Data'], 'safe'],
            //[['DiaSemana'], 'required'],
            [['DiaSemana'], 'integer'],
            [['Nome', 'Estado'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idAula' => 'Id Aula',
            'HoraInicio' => 'Hora Inicio',
            'HoraFim' => 'Hora Fim',
            'Nome' => 'Nome',
            'Estado' => 'Estado',
            'DiaSemana' => 'Dia Semana',
            'Data' => 'Data',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPresencas()
    {
        $presencas = $this->hasMany(Presenca::className(), ['Aula_idAula' => 'idAula']);
        if($presencas == null){
            return 0;
        } else {
            return $presencas;
        }

    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTurmas()
    {
        return $this->hasMany(Turma::className(), ['Aula_idAula' => 'idAula']);
    }

    public function getAlunos()
    {
        return $this->hasMany(Aluno::className(), ['idAluno' => 'Aluno_idAluno'])->via('presencas');
    }

    public function getTreinador(){
        return $this->hasOne(Treinador::className(), ['idTreinador' => 'Treinador_idTreinador'])->via('turmas');
    }

    /*
    public function getNomesTreinadores(){
        $treinadoresMM = new Treinador();
        $listaTreinadores = $treinadoresMM->findAll([

        ]);
    }
    */

    //getAlunos por idAula
    public function getAlunosInscritos($idAula) {
        $presencaMM = new Presenca();
        $listaPresencas = $presencaMM->findAll([
            'Aula_idAula' => $idAula,
        ]);

        $alunosInscritos = [];
        foreach($listaPresencas as $presenca){
            $alunosInscritos[$presenca->idPresenca] = ['idAluno' => $presenca->alunoIdAluno->idAluno, 'nomeAluno' => $presenca->alunoIdAluno->Nome, 'contatoAluno' => $presenca->alunoIdAluno->Contato1];
            //$alunosInscritos[$presenca->Aluno_idAluno] = [$presenca->alunoIdAluno->NomeAluno, $presenca->alunoIdAluno->Contato1];
            // $v[] = $presenca->Aluno_idAluno;
        }

        //var_dump($alunosIncritos);

        //$alunosIncritos = $array;

        return $alunosInscritos;

        /*
        return [
            1 => 'Manuel',
            2 => 'Cristiano',
            3 => 'Jose',
        ];
        */
    }

    public function getAlunosPresentes() {
        $presenca = new Presenca();
        $alunosPresentes = $presenca->findAll([
            'Aula_idAula' => Yii::$app->getRequest()->getQueryParam('idAula'),
            'Presente' => 1
        ]);

        $array = [];
        foreach($alunosPresentes as $presenca){
            //$array[$presenca->Aluno_idAluno] = $presenca->alunoIdAluno->Nome;
            $array[] = $presenca->Aluno_idAluno;
        }

        $alunosPresentes = $array;

        //var_dump($alunosPresentes);

        return $alunosPresentes;

        //return [0, 2];
    }


}
