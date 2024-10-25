<?php
require_once __DIR__ . '/includes/functions.php';

if (isset($_GET['accion']) && $_GET['accion'] === 'eliminar' && isset($_GET['id'])) {
    $count = eliminarJugador($_GET['id']);
    $mensaje = $count > 0 ? "Jugador eliminado con éxito." : "No se pudo eliminar el jugador.";
}

$jugadores = obtenerJugadores();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Jugadores</title>
    <link rel="stylesheet" href="public/css/styles.css">
</head>
<body>
<div class="container">
    <h1>Gestión de Jugadores</h1>
    <br><br>
    <?php if (isset($mensaje)): ?>
        <div class="<?php echo $count > 0 ? 'success' : 'error'; ?>">
            <?php echo $mensaje; ?>
        </div>
    <?php endif; ?>
    <a href="agregar_jugador.php" class="button">Agregar Nuevo Jugador</a>
    <br><br>
    <h2>Lista de Jugadores</h2>
    <table>
        <tr>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Descripción</th>
            <th>País</th>
            <th>Posición</th>
            <th>Fecha de Nacimiento</th>
            <th>Titular</th>
            <th>Suplente</th>
            <th>Acciones</th>
        </tr>
        <?php foreach ($jugadores as $jugador): ?>
        <tr>
            <td><?php echo htmlspecialchars($jugador['nombre']); ?></td>
            <td><?php echo htmlspecialchars($jugador['apellido']); ?></td>
            <td><?php echo htmlspecialchars($jugador['descripcion']); ?></td>
            <td><?php echo htmlspecialchars($jugador['pais']); ?></td>
            <td><?php echo htmlspecialchars($jugador['posicion']); ?></td>
            <td><?php echo date('Y-m-d', $jugador['fecha_nacimiento']->toDateTime()->getTimestamp()); ?></td>
            <td><?php echo $jugador['titular'] ? 'Sí' : 'No'; ?></td>
            <td><?php echo $jugador['suplente'] ? 'Sí' : 'No'; ?></td>
            <td class="actions">
                <a href="editar_jugador.php?id=<?php echo $jugador['_id']; ?>" class="button">Editar</a>
                <a href="index.php?accion=eliminar&id=<?php echo $jugador['_id']; ?>" class="button" onclick="return confirm('¿Estás seguro de que quieres eliminar este jugador?');">Eliminar</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>
</body>
</html>