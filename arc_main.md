```
cafeteria-api/
│── src/                     
│   ├── config/               # Configuración de la base de datos
│   ├── empleados/            # Servicio de empleados
│   │   ├── controllers/      # Controladores de la API
│   │   ├── models/           # Modelos de datos
│   │   ├── services/         # Lógica de negocio
│   │   ├── routes/           # Definición de rutas y endpoints
│   │   ├── index.php         # Punto de entrada del servicio
│   ├── sucursales/           
│   ├── productos/            
│   ├── ventas/               
│
│── api-gateway/              
│   ├── middleware/           # Seguridad, logging, etc.
│   ├── routes/               # Enrutamiento hacia los servicios
│   ├── index.php             # Configuración general del API Gateway
│
│── database/                 
│── tests/                    
│── docs/                    
│── .env                      # Variables de entorno (credenciales)
│── README.md                 
│── .gitignore                
```

# Iniciar el servidor

```
php -S localhost:8080 -t soaservices
```

# Instalar JWT JSON Web Token
JSON Web Token es un estándar abierto (RFC 7519) que define un formato compacto y autónomo para la transmisión segura de información entre partes como un objeto JSON. Esta información puede ser verificada y confiable porque está firmada digitalmente.
```
composer require firebase/php-jwt
```
### Estructura
Header, Payload y Signature
- Header: Contiene información sobre cómo se firmó el token y el tipo de token.
- Payload: Contiene las declaraciones (claims) que son la información que se quiere transmitir.
- Signature: Se utiliza para verificar que el emisor del token es quien dice ser y para asegurar que el mensaje no ha sido alterado.

### Generar clave en openssl
openssl rand -base64 128

TJ0k0Maod8aWRyE2cxogvcXHm0rD4tnArm/2GlPYoIz4jThfMMLvML8bgCgz7FBShNZfJ12EVrQVfBJOsyGksyKI4fX8CW2GzB5b+LBv6x6RbCjlD40qzP/nW5xJG3kKx5LULX+GiDQB6m9qsL3bsTzy8Z4D3SI7puEB8K+JiDg=
