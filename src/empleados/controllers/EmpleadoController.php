<?php
require_once __DIR__ . '/../services/EmpleadoService.php';
require_once __DIR__ . '/../../../handler/XmlHandler.php';

class EmpleadoController {
    public static function index() {
        $empleados = EmpleadoService::obtenerTodos();
        header('Content-Type: application/xml');
        
        echo XmlHandler::generarXml($empleados, 'empleados', 'empleado');

    }

    public static function show ($id) {
        $empleado = EmpleadoService::obtenerPorId($id);
        header('Content-Type: application/xml');

        if (!$empleado) {
            header("HTTP/1.1 404 Not Found");
            echo "<error>Empleado no encontrado</error>";
            return;
        }

        echo XmlHandler::generarXml($empleado, 'empleado');
    }
    
    /**
     * Ordenar empleados por puesto
     * @param string $param Nombre del puesto, puede ser Mesero, Cajero o Cocinero
     */
    public static function ordenarPorPuestos($param) {
        $empleados = EmpleadoService::ordenarPorPuestos($param);
        header('Content-Type: application/xml');

        // Si no encontro el puesto, devuelve un error 404
        if (!$empleados) {
            header("HTTP/1.1 404 Not Found");
            echo "<error>Puesto no encontrado</error>";
            return;
        }

        echo XmlHandler::generarXml($empleados, 'empleados', 'empleado');
    }

    public static function create() {
        $data = file_get_contents('php://input');
        $xml = simplexml_load_string($data);

        $RFC = (string)$xml->RFC;
        $nombre = (string)$xml->nombre;
        $apellido = (string)$xml->apellido;
        $direccion = (string)$xml->direccion;
        $fecha_contratacion = (string)$xml->fecha_contratacion;
        $telefono = (string)$xml->telefono;
        $sueldo = (float)$xml->sueldo;
        $puesto_id = (int)$xml->puesto_id;
        $sucursal_id = (int)$xml->sucursal_id;

        if (EmpleadoService::crearEmpleado($RFC, $nombre, $apellido, $direccion, $fecha_contratacion, $telefono, $sueldo, $puesto_id, $sucursal_id)) {
            header("HTTP/1.1 201 Created");
            echo "<message>Empleado creado exitosamente</message>";
        } else {
            header("HTTP/1.1 500 Internal Server Error");
            echo "<error>Error al crear el empleado</error>";
        }
    }

    public static function update() {
        $data = file_get_contents("php://input");
        $xml = simplexml_load_string($data);
 
        $id = (int)$xml->id;
        $RFC = (string)$xml->RFC;
        $nombre = (string)$xml->nombre;
        $apellido = (string)$xml->apellido;
        $direccion = (string)$xml->direccion;
        $fecha_contratacion = (string)$xml->fecha_contratacion;
        $telefono = (string)$xml->telefono;
        $sueldo = (float)$xml->sueldo;
        $puesto_id = (int)$xml->puesto_id;
        $sucursal_id = (int)$xml->sucursal_id;
 
        // Aquí puedes llamar al servicio para actualizar el empleado
        if (EmpleadoService::actualizarEmpleado($id, $RFC, $nombre, $apellido, $direccion, $fecha_contratacion, $telefono, $sueldo, $puesto_id, $sucursal_id)){
            header("HTTP/1.1 200 OK");
            echo "<message>Empleado actualizado exitosamente</message>";
        } else {
            header("HTTP/1.1 500 Internal Server Error");
            echo "<error>Error al actualizar el empleado</error>";
        }
    }

public static function delete() {
        $data = file_get_contents("php://input");
        $xml = simplexml_load_string($data);
 
        $id = (int)$xml->id;

        // Verifica si el empleado existe
        $empleado = EmpleadoService::obtenerPorId($id);
        if (!$empleado) {
            header("HTTP/1.1 404 Not Found");
            echo "<error>Empleado no encontrado</error>";
            return;
        } else {
            if(EmpleadoService::eliminarEmpleado($id)){
                header("HTTP/1.1 200 OK");
                echo "<message>Empleado eliminado exitosamente</message>";
            }
        }
    }




}
?>