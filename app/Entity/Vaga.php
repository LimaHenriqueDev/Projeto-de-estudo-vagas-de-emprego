<?php

namespace App\Entity;

use \App\Db\Database ;
use PDO;

class Vaga {
 
      /**
     * ID da vaga
     * @var string
     */
    public $id;
    /**
     * titulo da vaga
     * @var string
     */
    public $titulo;

    /**
     * descricao da vaga(pode conter html)
     * @var string
     */
    public $descricao;

    /**
     * define se a vaga ativa
     * @var string(s/n)
     */
    public $ativo;

    /**
     * data da vaga
     * @var string
     */
    public $data;

    /**
     * criar uma vaga no banco
     * @return bolean
     */
    public function cadastrar(){
            //definir a data
            $this->data = date('Y-m-d H:i:s');
            //inserir a vaga no banco
            $obDatabase = new Database('vagas');
            $obDatabase->insert([
                'titulo' => $this->titulo,
                'descricao' => $this->descricao,
                'ativo' => $this->ativo,
                'data' => $this->data
            ]);
        
            return true;
    echo "<pre>"; print_r($this); echo "<pre>"; exit;

    }


    /**
     * Responsavel por atualizar a vaga no banco
     * @return boolean
     */
    public function atualizar(){
        return (new Database('vagas'))->update('id = '.$this->id, [
            'titulo' => $this->titulo,
            'descricao' => $this->descricao,
            'ativo' => $this->ativo,
            'data' => $this->data
        ]);
    }

    /**
     * Responsavel por exluir a vaga do BD
     * @return boolean
     */
    public function excluir(){
        return (new Database('vagas'))->delete('id ='.$this->id);
    }

    /**
     * Metodo responsavel por obter as vagas do BD
     * @param string $where
     * @param  string $order= null
     * @param string  $limit
     * 
     * @return array
     */
     public static function getVagas($where = null, $order= null, $limit = null){
            return (new Database('vagas'))->select($where,$order,$limit)->fetchAll(PDO::FETCH_CLASS,self::class);
            }


     
     /**
      * Responsavel por buscar uma vaga com base no seu ID
      * @param integer $id
      * 
      * @return VAGA
      */
     public static function getVaga($id){
        return (new Database('vagas'))->select(' id = '.$id)
                                    ->fetchObject(self::class);
     }  

        }

