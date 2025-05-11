<?php
require_once __DIR__ . '/../models/Empleado.php';

# En esta clase se definen los métodos que se utilizarán para interactuar con la base de datos
// Solo de mandan a llamar los métodos de la clase Empleado

class EmpleadoService {
    public static function obtenerTodos() {
        return Empleado::obtenerTodos();
    }

    public static function obtenerPorId($id) {
        return Empleado::obtenerPorId($id);
    }

    public static function ordenarPorPuestos($param) {
        return Empleado::ordernarPorPuestos($param);
    }

    public static function crearEmpleado($RFC, $nombre, $apellido, $direccion, $fecha_contratacion, $telefono, $sueldo, $puesto_id, $sucursal_id) {
        return Empleado::crearEmpleado($RFC, $nombre, $apellido, $direccion, $fecha_contratacion, $telefono, $sueldo, $puesto_id, $sucursal_id);
    }

    public static function actualizarEmpleado($id, $RFC, $nombre, $apellido, $direccion, $fecha_contratacion, $telefono, $sueldo, $puesto_id, $sucursal_id) {
        return Empleado::actualizarEmpleado($id, $RFC, $nombre, $apellido, $direccion, $fecha_contratacion, $telefono, $sueldo, $puesto_id, $sucursal_id);
    }

    public static function eliminarEmpleado($id) {
        return Empleado::eliminarEmpleado($id);
    }
}
?>