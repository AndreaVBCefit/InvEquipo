<?php
include_once 'config/Database.php';
include_once 'models/Equipo.php';

$database = new Database();
$db = $database->getConnection();

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit();
}

$equipo = new Equipo($db);
$equipo->id = $_GET['id'];
$stmt = $equipo->readOne();
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $equipo->nombre_equipo = $_POST['nombre_equipo'];
    $equipo->tipo = $_POST['tipo'];
    $equipo->marca = $_POST['marca'];
    $equipo->serial = $_POST['serial'];
    $equipo->ubicacion = $_POST['ubicacion'];
    $equipo->estado = $_POST['estado'];

    if ($equipo->update()) {
        echo "<script>alert('Equipo actualizado exitosamente'); window.location.href='index.php';</script>";
    } else {
        echo "<script>alert('Error al actualizar el equipo');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Equipo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Editar Equipo</h2>
        <form method="POST">
            <input type="hidden" name="id" value="<?= $row['id'] ?>">
            <div class="mb-3">
                <label for="nombre_equipo" class="form-label">Nombre del Equipo</label>
                <input type="text" class="form-control" id="nombre_equipo" name="nombre_equipo" value="<?= $row['nombre_equipo'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="tipo" class="form-label">Tipo</label>
                <input type="text" class="form-control" id="tipo" name="tipo" value="<?= $row['tipo'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="marca" class="form-label">Marca</label>
                <input type="text" class="form-control" id="marca" name="marca" value="<?= $row['marca'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="serial" class="form-label">Serial</label>
                <input type="text" class="form-control" id="serial" name="serial" value="<?= $row['serial'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="ubicacion" class="form-label">Ubicación</label>
                <input type="text" class="form-control" id="ubicacion" name="ubicacion" value="<?= $row['ubicacion'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="estado" class="form-label">Estado</label>
                <select class="form-select" id="estado" name="estado" required>
                    <option value="Disponible" <?= $row['estado'] === 'Disponible' ? 'selected' : '' ?>>Disponible</option>
                    <option value="En uso" <?= $row['estado'] === 'En uso' ? 'selected' : '' ?>>En uso</option>
                    <option value="En reparación" <?= $row['estado'] === 'En reparación' ? 'selected' : '' ?>>En reparación</option>
                    <option value="Dado de baja" <?= $row['estado'] === 'Dado de baja' ? 'selected' : '' ?>>Dado de baja</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Actualizar</button>
            <a href="index.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</body>
</html>
