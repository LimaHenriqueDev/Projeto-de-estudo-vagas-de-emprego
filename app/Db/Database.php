<?php
namespace App\Db;

use \PDO;
use PDOException;

class Database {
    const HOST = 'localhost';
    const NAME = 'wdev_vagas';
    const USER = 'root';
    const PASS = 'password';
    const PORT = 33062;
    

    /**
     * nome da tabela a ser manipulada
     * @var string
     */
    private $table;

    /**
     * instancia de conexão com o BD
     * @var PDO
     */
    private $connection;

    /**
     * define a tabela e instacia a conexão
     * @param string $table
     */
    public function __construct($table = null)
    {
        $this->table = $table;
        $this->setConnection();
    }

    /**
     * metodo responsavbel por criar uma conexao com BD
     */
    private function setConnection(){
        try {
            $this->connection = new PDO('mysql:host='.self::HOST.';port='.self::PORT.';dbname='. self::NAME, self::USER, self::PASS);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die('Error'. $e->getMessage());
        }
    }


    /**
     * metodo responsavel por execurtar queries dentro do BD
     * @param mixed $query
     * @param array $params
     * 
     * @return PDOStatement
     */
    public function execute($query, $params = []) {
        try {
            $statement = $this->connection->prepare($query);
            //O array $params contém os valores que substituirão os placeholders na consulta preparadas
            $statement->execute($params);
            return $statement;
        }  catch (PDOException $e) {
            die('Error'. $e->getMessage());
        }
    }


    /**
     *
     * 
     * metodo responsavel por inserir no banco
     *  @param array $values [field => value]
     * @return integer ID inserido
     */
    public function insert($values){
        //dados da query
        $fields = array_keys($values);
        $binds = array_pad([],count($fields),'?');
       
        //monta a query
        $query = 'INSERT INTO '.$this->table.' ('.implode(',',$fields).') VALUES ('.implode(',',$binds).')';

        //executa o insert 
        $this->execute($query,array_values($values));
        //retorna o id inserido
        return $this->connection->lastInsertId();
    }


    /**
     * @param  string $where =null
     * @param  string $order= null
     * @param  string null $limit
     * @param  string null $fields
     * 
     * 
     * @return PDOStatement
     */
    public function select($where = null, $order = null, $limit = null, $fields = '*') {
        $where = strlen($where) ? 'WHERE '.$where : '';
        $order = strlen($order) ? 'ORDER BY '.$order : '';
        $limit = strlen($limit) ? 'LIMIT '.$limit : '';
        //Monta a query
        $query = 'SELECT '.$fields.' FROM '.$this->table.' '.$where.' '.$order.' '.$limit;
        return $this->execute($query);
    }

    /**
     * Responsavel por atualizar a vaga no banco
     * @param string $where
     * @param array $values [ field => value]
     * 
     * @return boolean
     */
    public function update($where, $values){
        //Dados da query
        $fields = array_keys($values);

        //Monta a query
        $query = 'UPDATE '.$this->table.' SET '.implode('=?,',$fields).'=? WHERE '.$where;

            //executa a query
        $this->execute($query,array_values($values));
        
        //retorna sucesso
        return true;
     
    }


    /**
     * Responsavel por excluir dados do BD
     * @param string $where
     * 
     * @return boolean
     */
    public function delete($where){
        //Monta query
        $query = 'DELETE FROM '.$this->table.' WHERE '.$where;
//  echo "<pre>"; print_r($query); echo "<pre>"; exit;
        
        //executa query
        $this->execute($query);

        //retorn sucesso
        return true; 
    
    }


}