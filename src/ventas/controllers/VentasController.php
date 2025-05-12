<?php

require_once __DIR__ . '/../services/VentasService.php';
require_once __DIR__ . '/../../../handler/XmlHandler.php';

class VentasController
{

    public static function obtenerTotalVentas()
    {
        $totalVentas = VentasService::obtenerTotalVentas();
        if (isset($totalVentas['error'])) {
            http_response_code(400);
            header('Content-Type: application/xml');
            echo "<error>{$totalVentas['error']}</error>";
            return;
        }
        header('Content-Type: application/xml');
        echo XmlHandler::generarXml($totalVentas, 'total_ventas');
    }

    public static function obtenerEmpleadoMasVentas()
    {
        $empleados = VentasService::obtenerEmpleadoMasVentas();
        if (isset($empleados['error'])) {
            http_response_code(400);
            header('Content-Type: application/xml');
            echo "<error>{$empleados['error']}</error>";
            return;
        }
        header('Content-Type: application/xml');
        echo XmlHandler::generarXml($empleados, 'empleado',);
    }

    public static function obtenerProductoMasVendido()
    {
        $productos = VentasService::obtenerProductoMasVendido();
        if (isset($productos['error'])) {
            http_response_code(400);
            header('Content-Type: application/xml');
            echo "<error>{$productos['error']}</error>";
            return;
        }
        header('Content-Type: application/xml');
        echo XmlHandler::generarXml($productos, 'producto',);
    }

    public static function obtenerSucursalMasVentas()
    {
        $sucursales = VentasService::obtenerSucursalMasVentas();
        if (isset($sucursales['error'])) {
            http_response_code(400);
            header('Content-Type: application/xml');
            echo "<error>{$sucursales['error']}</error>";
            return;
        }
        header('Content-Type: application/xml');
        echo XmlHandler::generarXml($sucursales, 'sucursal',);
    }

    public static function obtenerListaVentas(){
        $ventas = VentasService::obtenerListaVentas();
        if(isset($ventas['error'])){
            http_response_code(400);
            header('Content-Type: application/xml');
            echo "<error>{$ventas['error']}</error>";
            return;
        }
        header('Content-Type: application/xml');
        echo XmlHandler::generarXml($ventas, 'ventas', 'venta');
    }

}