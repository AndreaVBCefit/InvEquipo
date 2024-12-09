<?php
include_once 'config/Database.php';
include_once 'models/Equipo.php';

$database = new Database();
$db = $database->getConnection();

if (isset($_GET['id'])) {
    $equipo = new Equipo($db);
    $equipo->id = $_GET['id'];

    if ($equipo->delete()) {
        echo "<script>alert('Equipo eliminado exitosamente'); window.location.href='index.php';</script>";
    } else {
        echo "<script>alert('Error al eliminar el equipo'); window.location.href='index.php';</script>";
    }
} else {
    header("Location: index.php");
}
?>
