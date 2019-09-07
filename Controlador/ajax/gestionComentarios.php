<?php	
include_once('../../Modelo/clase-Comentarios.php');

switch ($_GET['accion']){
    
    case 'getComentarios':
        Comentarios::obtenerComentarios();
    break;
    
    case 'getComentario':
        $tour = $_POST['tour'];
        $usuario = $_POST['usuario'];
        Comentarios::obtenerComentario($tour, $usuario);
    break; 

    case 'ComentarioporTour':
        $tourID = $_POST['tourID'];
        Comentarios::obtenerComentarioTour($tourID);
    break;
    
    case 'buscar':
        $search = $_POST['search'];
        Comentarios::searchComentario($search);
    break;

    case 'agregarComentarios':
        $idTour = $_POST['tour'];
        $idUsuario = $_POST['idusuario'];
        $comentario = $_POST['comentario'];

        $salida = Comentarios::addComentarios($idUsuario, $idTour, $comentario);
        echo json_encode(array('resp' => $salida));
    break;

    case 'borrar':
        $idComentario = intval($_POST['idComment']);
        $salida = Comentarios::deleteComentario($idComentario);
        echo json_encode(array("resp" => $salida));
    break; 
    
    case 'comprarTour':
        $idTour = $_POST['idTour'];
        $idUsuario = $_POST['usuario'];
        $idHotel = $_POST['idHotel'];
        $turistas = $_POST['numeroTuristas'];

        Comentarios::comprarTour($idTour, $idUsuario, $idHotel, $turistas);
    break;
}