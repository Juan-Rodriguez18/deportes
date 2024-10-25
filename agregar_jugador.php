<?php
require_once __DIR__ . '/includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = crearJugador($_POST['nombre'], $_POST['apellido'], $_POST['descripcion'], $_POST['pais'], $_POST['posicion'], $_POST['fecha_nacimiento'], $_POST['titular'], $_POST['suplente']);
    if ($id) {
        header("Location: index.php?mensaje=Jugador creado con éxito");
        exit;
    } else {
        $error = "No se pudo crear el jugador.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Nuevo Jugador</title>
    <link rel="stylesheet" href="public/css/styles.css">
</head>
<body>
<div class="container">
    <h1>Agregar Nuevo Jugador</h1>
    <?php if (isset($error)): ?>
        <div class="error"><?php echo $error; ?></div>
    <?php endif; ?>
    <form method="POST">
        <label>Nombre: <input type="text" name="nombre" required></label>
        <label>Apellido: <input type="text" name="apellido" required></label>
        <label>Descripción: <textarea name="descripcion" required></textarea></label>
        <label>País: <input type="text" name="pais" required></label>
        <label>Posición: <input type="text" name="posicion" required></label>
        <label>Fecha de Nacimiento: <input type="date" name="fecha_nacimiento" required></label>
        <label>Titular: <input type="checkbox" name="titular" value="1"></label>
        <label>Suplente: <input type="checkbox" name="suplente" value="1"></label>
        <input type="submit" value="Crear Jugador">
    </form>
    <a href="index.php" class="button">Volver a la lista de jugadores</a>
</div>
</body>
</html>