<?php
namespace App\Db;

class Pagination {
    
    /**
     * Numero maximo de pagians por registro
     * @var integer
     */
    private $limit;

    /**
     * Quantidade total de resultados do banco
     * @var integer
     */
    private $results;

    /**
     * Quantidade de paginas 
     * @var integer
     */
    private $pages;

    /**
     * pagina atual
     * @var integer
     */
    private $currentPage;

    /**
     * contrutor da classe
     * @param mixed $results
     * @param $currentPage = 1
     * @param int $limit
     */
    public function __construct($results,$currentPage = 1, $limit = 10)
    {
        $this->results = $results;
        $this->limit = $limit;
        $this->currentPage = (is_numeric($currentPage) and $currentPage > 0) ? $currentPage : 1;
        $this->calculate();
    }


    /**
     * metodo responsavel por calcular a paginação
     * @return [type]
     */
    private function calculate(){
        //calcula o total de paginas
        $this->results > 0 ? $this->pages = ceil($this->results / $this->limit) : 1;

        //verifica se a pagina nao excede o numero de paginas
        $this->currentPage = $this->currentPage <= $this->pages ? $this->currentPage : $this->pages;
    }


    /**
     *metodo responsavel por retornar a clausula limit do sql
     * 
     * @return string
     */
    public function getLimit(){
        $offset = ($this->limit * ($this->currentPage - 1));
        // Garantir que o offset não seja negativo
        $offset = max(0, $offset);
        return $offset . ',' . $this->limit;
    }

    /**
     * metodo responsavel por retorna as opcoes de paginas disponiveis
     * @return array
     */
    public function getPages(){
        //não retorna paginas
        if($this->pages == 1) return [];
            
       
            //paginas
            $paginas = [];
            for ($i = 1; $i <= $this->pages; $i ++){
                $paginas[] = [
                    'pagina' => $i,
                    'atual' => $i == $this->currentPage
                ];
            }
            return $paginas;
        }
    

}