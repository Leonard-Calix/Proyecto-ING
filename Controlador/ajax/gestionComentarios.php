<?php	
include_once('../../Modelo/clase-Comentarios.php');

switch ($_GET['accion']){
    
    case 'getComentarios':
        Comentarios::obtenerComentarios();
    break;

    case 'buscar':
        $search = $_POST['search'];
        Comentarios::searchComentario($search);
    break;

    case 'borrar':
        $idComentario = intval($_POST['idComment']);
        $salida = Comentarios::deleteComentario($idComentario);
        echo json_encode(array("resp" => $salida));
    break;    
}