<?php
require_once __DIR__ . '/../../config/database.php';
class Ventas
{

    /**
     * Obtiene el total de ventas (cantidad y monto total).
     */
    public static function obtenerTotalVentas()
    {
        try {
            global $conn;
            $query = "SELECT COUNT(*) AS total_cantidad, SUM(total_venta) AS total_pesos FROM Ventas";
            $result = $conn->query($query);
            if ($result) {
                return $result->fetch_assoc();
            } else {
                throw new Exception($conn->error);
            }
        } catch (Exception $e) {
            echo [
                'error' => 'Error: ' . $e->getMessage()
            ];
        }
    }

    /**
     * Obtiene el empleado con más ventas.
     */
    public static function obtenerEmpleadoMasVentas()
    {
        try {
            global $conn;
            $query = "SELECT e.empleado_id, e.nombre, e.apellido, COUNT(*) AS total_ventas, SUM(v.total_venta) AS monto_total
                     FROM Empleados e
                     INNER JOIN Ventas v ON e.empleado_id = v.empleado_id
                     GROUP BY e.empleado_id
                     ORDER BY total_ventas DESC
                     LIMIT 1";
            $result = $conn->query($query);

            if ($result) {
                return $result->fetch_assoc();
            } else {
                throw new Exception($conn->error);
            }
        } catch (Exception $e) {
            echo [
                'error' => 'Error: ' . $e->getMessage()
            ];
        }
    }

    /**
     * Obtener el producto más vendido.
     */
    public static function obtenerProductoMasVendido()
    {
        try {
            global $conn;
            $query = "SELECT p.producto_id, p.nombre_producto, SUM(v.cantidad_vendida) AS total_vendido, 
                     SUM(v.total_venta) AS monto_total
                     FROM Productos p
                     INNER JOIN Ventas v ON p.producto_id = v.producto_id
                     GROUP BY p.producto_id
                     ORDER BY total_vendido DESC
                     LIMIT 1";
            $result = $conn->query($query);

            if ($result) {
                return $result->fetch_assoc();
            } else {
                throw new Exception($conn->error);
            }
        } catch(Exception $e) {
            return [
                'error' => $e->getMessage()
            ];
        }
    }

    /**
     * Obtener la sucursal con más ventas.
     */
    public static function obtenerSucursalMasVentas() {
        try {
            global $conn;
            $query = "SELECT s.sucursal_id, s.nombre, COUNT(v.venta_id) AS total_ventas, 
                     SUM(v.total_venta) AS monto_total
                     FROM Sucursales s
                     INNER JOIN Empleados e ON s.sucursal_id = e.sucursal_id
                     INNER JOIN Ventas v ON e.empleado_id = v.empleado_id
                     GROUP BY s.sucursal_id
                     ORDER BY total_ventas DESC
                     LIMIT 1";
            $result = $conn->query($query);

            if ($result) {
                return $result->fetch_assoc();
            } else {
                throw new Exception($conn->error);
            }
        } catch(Exception $e) {
            return ['error' => 'Error: ' . $e->getMessage()];
        }
    }

    /**
     * Obtener lista de todas ventas.
     */
    public static function obtenerListaVentas() {
        try {
            global $conn;
            $query = "SELECT v.venta_id, p.nombre_producto, v.cantidad_vendida, v.total_venta, 
                     v.numero_mesa, CONCAT(e.nombre, ' ', e.apellido) AS empleado
                     FROM Ventas v
                     INNER JOIN Productos p ON v.producto_id = p.producto_id
                     INNER JOIN Empleados e ON v.empleado_id = e.empleado_id
                     ORDER BY v.venta_id";
            $result = $conn->query($query);

            if ($result) {
                return $result->fetch_all(MYSQLI_ASSOC);
            } else {
                throw new Exception($conn->error);
            }
        } catch(Exception $e) {
            return ['error' => 'Error: ' . $e->getMessage()];
        }
    }

}