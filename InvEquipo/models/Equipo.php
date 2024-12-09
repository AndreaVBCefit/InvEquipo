<?php
// Implementando la logica de CRUD
include_once 'config/Database.php';

class Equipo {
    private $conn;
    private $table = 'equipos';

    public $id;
    public $nombre_equipo;
    public $tipo;
    public $marca;
    public $serial;
    public $ubicacion;
    public $estado;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Método para crear un nuevo equipo
    public function create() {
        $query = "INSERT INTO " . $this->table . " SET nombre_equipo=:nombre_equipo, tipo=:tipo, marca=:marca, serial=:serial, ubicacion=:ubicacion, estado=:estado";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':nombre_equipo', $this->nombre_equipo);
        $stmt->bindParam(':tipo', $this->tipo);
        $stmt->bindParam(':marca', $this->marca);
        $stmt->bindParam(':serial', $this->serial);
        $stmt->bindParam(':ubicacion', $this->ubicacion);
        $stmt->bindParam(':estado', $this->estado);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Método para leer todos los equipos
    public function read() {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Método para leer un equipo específico por ID
    public function readOne() {
        $query = "SELECT * FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $this->id);
        $stmt->execute();
        return $stmt;
    }

    // Método para actualizar un equipo
    public function update() {
        $query = "UPDATE " . $this->table . " SET nombre_equipo=:nombre_equipo, tipo=:tipo, marca=:marca, serial=:serial, ubicacion=:ubicacion, estado=:estado WHERE id=:id";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':nombre_equipo', $this->nombre_equipo);
        $stmt->bindParam(':tipo', $this->tipo);
        $stmt->bindParam(':marca', $this->marca);
        $stmt->bindParam(':serial', $this->serial);
        $stmt->bindParam(':ubicacion', $this->ubicacion);
        $stmt->bindParam(':estado', $this->estado);
        $stmt->bindParam(':id', $this->id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Método para eliminar un equipo
    public function delete() {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $this->id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
?>
