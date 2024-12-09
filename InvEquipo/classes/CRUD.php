<?php
class CRUD {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Método para crear un nuevo registro
    public function create($nombre_equipo, $tipo, $marca, $serial, $ubicacion, $estado) {
        try {
            $query = "INSERT INTO equipos (nombre_equipo, tipo, marca, serial, ubicacion, estado) 
                      VALUES (:nombre_equipo, :tipo, :marca, :serial, :ubicacion, :estado)";
            $stmt = $this->conn->prepare($query);

            // Enlazar parámetros
            $stmt->bindParam(':nombre_equipo', $nombre_equipo);
            $stmt->bindParam(':tipo', $tipo);
            $stmt->bindParam(':marca', $marca);
            $stmt->bindParam(':serial', $serial);
            $stmt->bindParam(':ubicacion', $ubicacion);
            $stmt->bindParam(':estado', $estado);

            // Ejecutar la consulta
            if ($stmt->execute()) {
                return true;
            } else {
                throw new Exception("Error al insertar el equipo.");
            }
        } catch (Exception $e) {
            return "Error: " . $e->getMessage();
        }
    }

    // Método para leer todos los registros
    public function read() {
        try {
            $query = "SELECT * FROM equipos";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return "Error: " . $e->getMessage();
        }
    }

    // Método para leer un solo registro por ID
    public function readById($id) {
        try {
            $query = "SELECT * FROM equipos WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return "Error: " . $e->getMessage();
        }
    }

    // Método para actualizar un registro
    public function update($id, $nombre_equipo, $tipo, $marca, $serial, $ubicacion, $estado) {
        try {
            $query = "UPDATE equipos 
                      SET nombre_equipo = :nombre_equipo, tipo = :tipo, marca = :marca, 
                          serial = :serial, ubicacion = :ubicacion, estado = :estado 
                      WHERE id = :id";
            $stmt = $this->conn->prepare($query);

            // Enlazar parámetros
            $stmt->bindParam(':nombre_equipo', $nombre_equipo);
            $stmt->bindParam(':tipo', $tipo);
            $stmt->bindParam(':marca', $marca);
            $stmt->bindParam(':serial', $serial);
            $stmt->bindParam(':ubicacion', $ubicacion);
            $stmt->bindParam(':estado', $estado);
            $stmt->bindParam(':id', $id);

            // Ejecutar la consulta
            if ($stmt->execute()) {
                return true;
            } else {
                throw new Exception("Error al actualizar el equipo.");
            }
        } catch (Exception $e) {
            return "Error: " . $e->getMessage();
        }
    }

    // Método para eliminar un registro
    public function delete($id) {
        try {
            $query = "DELETE FROM equipos WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', $id);
            
            // Ejecutar la consulta
            if ($stmt->execute()) {
                return true;
            } else {
                throw new Exception("Error al eliminar el equipo.");
            }
        } catch (Exception $e) {
            return "Error: " . $e->getMessage();
        }
    }
}
?>
