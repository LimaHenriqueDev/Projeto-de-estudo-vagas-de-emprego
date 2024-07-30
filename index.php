 <?php

require __DIR__ .'/vendor/autoload.php';

use \App\Entity\Vaga;
use \App\Db\Pagination;
//Busca
$busca = filter_input(INPUT_GET,'busca', FILTER_SANITIZE_SPECIAL_CHARS);
//Filtro de status
$filtroStatus = filter_input(INPUT_GET,'filtroStatus', FILTER_SANITIZE_SPECIAL_CHARS);
$filtroStatus = in_array($filtroStatus,['s','n']) ? $filtroStatus : '';
//condiçoes SQL

$condicoes = [
strlen($busca) ? 'titulo LIKE "%'. str_replace(' ','%', $busca). '%"' : null,
strlen($filtroStatus) ? 'ativo = "'.$filtroStatus.'"' : null

];
//REMOVE POSIÇÒES VAZIAS
$condicoes = array_filter($condicoes);
//clausula where
$where = implode(' AND ', $condicoes);


$qtdVagas = Vaga::getQtdVagas($where);


//paginação
$obPagination = new Pagination($qtdVagas, $_GET['pagina'] ?? 1 , 5 );

//Obtem as vagas
$vagas = Vaga::getVagas($where,null,$obPagination->getLimit());


include __DIR__ .'/includes/header.php';
include __DIR__ . '/includes/listagem.php';
include __DIR__ .'/includes/footer.php';

