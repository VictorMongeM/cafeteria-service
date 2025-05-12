<?php
require_once __DIR__ . '/../models/Ventas.php';

class VentasService
{
    public static function obtenerTotalVentas(){
        return Ventas::obtenerTotalVentas();
    }

    public static function obtenerEmpleadoMasVentas(){
        return Ventas::obtenerEmpleadoMasVentas();
    }

    public static function obtenerProductoMasVendido(){
        return Ventas::obtenerProductoMasVendido();
    }

    public static function obtenerSucursalMasVentas(){
        return Ventas::obtenerSucursalMasVentas();
    }

    public static function obtenerListaVentas(){
        return Ventas::obtenerListaVentas();
    }

}