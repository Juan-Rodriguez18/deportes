<?php
require_once __DIR__ . '/../config/database.php';

function sanitizeInput($input) {
    return htmlspecialchars(strip_tags(trim($input)));
}

function crearJugador($nombre, $apellido, $descripcion, $pais, $posicion, $fechaNacimiento, $titular, $suplente) {
    global $jugadoresCollection;
    $resultado = $jugadoresCollection->insertOne([
        'nombre' => sanitizeInput($nombre),
        'apellido' => sanitizeInput($apellido),
        'descripcion' => sanitizeInput($descripcion),
        'pais' => sanitizeInput($pais),
        'posicion' => sanitizeInput($posicion),
        'fecha_nacimiento' => new MongoDB\BSON\UTCDateTime(strtotime($fechaNacimiento) * 1000),
        'titular' => $titular,
        'suplente' => $suplente
    ]);
    return $resultado->getInsertedId();
}

function obtenerJugadores() {
    global $jugadoresCollection;
    return $jugadoresCollection->find();
}

function obtenerJugadorPorId($id) {
    global $jugadoresCollection;
    return $jugadoresCollection->findOne(['_id' => new MongoDB\BSON\ObjectId($id)]);
}

function actualizarJugador($id, $nombre, $apellido, $descripcion, $pais, $posicion, $fechaNacimiento, $titular, $suplente) {
    global $jugadoresCollection;
    $resultado = $jugadoresCollection->updateOne(
        ['_id' => new MongoDB\BSON\ObjectId($id)],
        ['$set' => [
            'nombre' => sanitizeInput($nombre),
            'apellido' => sanitizeInput($apellido),
            'descripcion' => sanitizeInput($descripcion),
            'pais' => sanitizeInput($pais),
            'posicion' => sanitizeInput($posicion),
            'fecha_nacimiento' => new MongoDB\BSON\UTCDateTime(strtotime($fechaNacimiento) * 1000),
            'titular' => $titular,
            'suplente' => $suplente
        ]]
    );
    return $resultado->getModifiedCount();
}

function eliminarJugador($id) {
    global $jugadoresCollection;
    $resultado = $jugadoresCollection->deleteOne(['_id' => new MongoDB\BSON\ObjectId($id)]);
    return $resultado->getDeletedCount();
}
?>