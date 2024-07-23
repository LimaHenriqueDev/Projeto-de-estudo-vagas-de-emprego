<?php

require __DIR__ .'/vendor/autoload.php';

define('TITLE','Editar Vaga');


use \App\Entity\Vaga;


//validação do Id
if(!isset($_GET['id']) || !is_numeric($_GET['id'])){
    header('location: index.php?status=error');
        exit;
}

//Consulta a Vaga
$obVaga = Vaga::getVaga($_GET['id']);

//validação da Vaga 
if(!$obVaga instanceof Vaga){
    header('location: index.php?status=error');
     exit;

}
//  echo "<pre>"; print_r($obVaga); echo "<pre>"; exit;


//validacao do post
if(isset($_POST['titulo'],$_POST['descricao'],$_POST['ativo'])){

    $obVaga->titulo    = $_POST['titulo'];
    $obVaga->descricao = $_POST['descricao'];
    $obVaga->ativo     = $_POST['ativo'];
   $obVaga->atualizar();

    header('location: index.php?status=success');
    exit;
    echo "<pre>"; print_r($obVaga); echo "<pre>"; exit;
}

include __DIR__ .'/includes/header.php';
include __DIR__ . '/includes/formulario.php';
include __DIR__ .'/includes/footer.php';

