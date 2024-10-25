<?php
require_once __DIR__ . '/includes/functions.php';

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$jugador = obtenerJugadorPorId($_GET['id']);

if (!$jugador) {
    header("Location: index.php?mensaje=Jugador no encontrado");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $count = actualizarJugador($_GET['id'], $_POST['nombre'], $_POST['apellido'], $_POST['descripcion'], $_POST['pais'], $_POST['posicion'], $_POST['fecha_nacimiento'], isset($_POST['titular']), isset($_POST['suplente']));
    if ($count > 0) {
        header("Location: index.php?mensaje=Jugador actualizado con éxito");
        exit;
    } else {
        $error = "No se pudo actualizar el jugador.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Jugador</title>
    <link rel="stylesheet" href="public/css/styles.css">
</head>
<body>
<div class="container">
    <h1>Editar Jugador</h1>
    <?php if (isset($error)): ?>
        <div class="error"><?php echo $error; ?></div>
    <?php endif; ?>
    <form method="POST">
        <label>Nombre: <input type="text" name="nombre" value="<?php echo htmlspecialchars($jugador['nombre']); ?>" required></label>
        <label>Apellido: <input type="text" name="apellido" value="<?php echo htmlspecialchars($jugador['apellido']); ?>" required></label>
        <label>Descripción: <textarea name="descripcion" required><?php echo htmlspecialchars($jugador['descripcion']); ?></textarea></label>
        <label>País: <input type="text" name="pais" value="<?php echo htmlspecialchars($jugador['pais']); ?>" required></label>
        <label>Posición: <input type="text" name="posicion" value="<?php echo htmlspecialchars($jugador['posicion']); ?>" required></label>
        <label>Fecha de Nacimiento: <input type="date" name="fecha_nacimiento" value="<?php echo date('Y-m-d', $jugador['fecha_nacimiento']->toDateTime()->getTimestamp()); ?>" required></label>
        <label>Titular: <input type="checkbox" name="titular" value="1" <?php echo $jugador['titular'] ? 'checked' : ''; ?>></label>
        <label>Suplente: <input type="checkbox" name="suplente" value="1" <?php echo $jugador['suplente'] ? 'checked' : ''; ?>></label>
        <input type="submit" value="Actualizar Jugador">
    </form>
    <a href="index.php" class="button">Volver a la lista de jugadores</a>
</div>
</body>
</html>