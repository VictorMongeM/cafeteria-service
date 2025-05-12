<?php

class XmlHandler {
    public static function generarXml($data, $rootElement, $childElement = null){
        # Se añade el encabezado XML
        $xml = new SimpleXMLElement("<$rootElement/>");

        /**
         * Este fragmento de código convierte un array asociativo o un array multidimensional en un objeto XML.
         *
         * @param array $data El array de datos que se convertirá en XML. Puede ser un array asociativo o un array multidimensional.
         * @param SimpleXMLElement $xml El objeto SimpleXMLElement al que se agregarán los datos.
         * @param string|null $childElement (Opcional) El nombre del elemento hijo que se usará para los elementos del array.
         * @return string El XML
         * Comportamiento:
         * - Si $data es un array multidimensional (es decir, un array de arrays), se itera sobre cada elemento del array.
         *   - Para cada elemento, se crea un nodo hijo en el XML con el nombre especificado en $childElement o 'item' por defecto.
         *   - Luego, se agregan los datos del array interno como nodos hijos del nodo recién creado.
         * - Si $data es un array asociativo, se agregan directamente los datos como nodos hijos del objeto XML.
         */
        if(is_array($data) && isset($data[0]) && is_array($data[0])){ // 
            foreach ($data as $item) {
                $child = $xml->addChild($childElement);
                foreach ($item as $key => $value) {
                    $child ->addChild($key, htmlspecialchars($value));
                }
            }
        } else {
            foreach ($data as $key => $value) {
                $xml->addChild($key, htmlspecialchars($value));
            }
        }

        return $xml->asXML();

    }
}

?>