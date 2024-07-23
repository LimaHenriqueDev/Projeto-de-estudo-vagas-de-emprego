<?php

require __DIR__ .'/vendor/autoload.php';

use \App\Entity\Vaga;

//Busca
$busca = filter_input(INPUT_GET,'busca', FILTER_SANITIZE_SPECIAL_CHARS);

//condiçoes SQL

$condicoes = [
strlen($busca) ? 'titulo LIKE "%'. str_replace(' ','%', $busca). '%"' : null
];


$where = implode(' AND ',$condicoes);

// print_r($where);

//Obtem as vagas
$vagas = Vaga::getVagas($where);


include __DIR__ .'/includes/header.php';
include __DIR__ . '/includes/listagem.php';
include __DIR__ .'/includes/footer.php';

