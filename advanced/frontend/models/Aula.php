<?php

namespace frontend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "aula".
 *
 * @property integer $idAula
 * @property string $nome
 * @property string $horaInicio
 * @property string $horaFim
 * @property string $choveu
 * @property Presenca $presenca
 *
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
            [['idAula', 'nome', 'horaInicio', 'horaFim', 'choveu'], 'required'],
            [['idAula'], 'integer'],
            [['horaInicio', 'horaFim'], 'safe'],
            [['nome'], 'string', 'max' => 10],
            [['choveu'], 'string', 'max' => 1]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idAula' => 'Id Aula',
            'Nome' => 'Nome',
            'HoraInicio' => 'Hora Inicio',
            'HoraFim' => 'Hora Fim',
            'Choveu' => 'Choveu',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPresencas()
    {
        return $this->hasMany(Presenca::className(), ['Aula_idAula' => 'idAula']);
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

    //getAlunos por idAula
    public function getAlunosInscritos($idAula) {
        $presencaMM = new Presenca();
        $listaPresencas = $presencaMM->findAll([
            'Aula_idAula' => $idAula,
        ]);

        $array = [];
        foreach($listaPresencas as $presenca){
            $array[$presenca->Aluno_idAluno] = $presenca->alunoIdAluno->Nome;
            // $v[] = $presenca->Aluno_idAluno;
        }

        //var_dump($alunosIncritos);

        $alunosIncritos = $array;

        return $alunosIncritos;

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
