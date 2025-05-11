<?php
require_once __DIR__ . '/../../config/database.php';

class Empleado {
    public static function obtenerTodos() {
        global $conn;
        $sql = "SELECT * FROM Empleados";
        $result = $conn->query($sql);
        //el método fetch_all devuelve un array de todas las filas
        //en el caso de que no haya filas devuelve un array vacío
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public static function obtenerPorId($id) {
        global $conn;
        $sql = "SELECT * FROM Empleados WHERE empleado_id = ?";
        //El método bind_param vincula los parámetros a la consulta
        //La i indica un parámetro entero
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        /*El método fetch_assoc devuelve un array asociativo que contiene la fila*/
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    # Ordenar por puesto, hay dos formas por id_puesto o por nombre_puesto
    public static function ordernarPorPuestos($param) {
        global $conn;

        $puestosValidos = ['Mesero', 'Cajero', 'Cocinero'];

        // Validar si el parámetro es numérico o string
        if (is_numeric($param)) {
            $sql = "SELECT * FROM Empleados WHERE puesto_id = ? ORDER BY nombre";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $param);
            $stmt->execute();
        } elseif (is_string($param) && in_array($param, $puestosValidos)) { // Si el parámetro es un nombre de puesto válido, tomar param como si fuera un nombre
            $sql = "SELECT * FROM Empleados WHERE puesto_id = (SELECT puesto_id FROM puestos WHERE nombre_puesto = ?) ORDER BY nombre";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $param);
            $stmt->execute();
        }

        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public static function crearEmpleado($RFC, $nombre, $apellido, $direccion, $fecha_contratacion, $telefono, $sueldo, $puesto_id, $sucursal_id) {
        global $conn;
        $sql = "INSERT INTO Empleados (RFC, nombre, apellido, direccion, fecha_contratacion, telefono, sueldo, puesto_id, sucursal_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssdii", $RFC, $nombre, $apellido, $direccion, $fecha_contratacion, $telefono, $sueldo, $puesto_id, $sucursal_id);
        return $stmt->execute();
    }

    public static function actualizarEmpleado($id, $RFC, $nombre, $apellido, $direccion, $fecha_contratacion, $telefono, $sueldo, $puesto_id, $sucursal_id) {
        global $conn;
        $sql = "UPDATE Empleados SET RFC = ?, nombre = ?, apellido = ?, direccion = ?, fecha_contratacion = ?, telefono = ?, sueldo = ?, puesto_id = ?, sucursal_id = ? WHERE empleado_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssdiii", $RFC, $nombre, $apellido, $direccion, $fecha_contratacion, $telefono, $sueldo, $puesto_id, $sucursal_id, $id);
        return $stmt->execute();
    }

    public static function eliminarEmpleado($id) {
        global $conn;
        $sql = "DELETE FROM Empleados WHERE empleado_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
?>
