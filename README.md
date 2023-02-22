
# Sistema de RRHH

Sistema de gestión para Recursos humanos de Constructora CONSTRUMAQ SRL.

## Stack
- PHP 8
- Mysql 5.7
## Frameworks
- Laravel 9
- VueJs  

## Detalle
El sistema trata sobre la gestión de personal, sueldos, bonos y
descuentos que puedan acarrear durante el periodo de trabajo 
dentro de un proyecto.
El sistema tambien registra los créditos otorgados por la empresa
al personal para su descuento en cada liquidación.
El mismo genera ABM de los siguientes módulos:

- Personal (workers)
- Usuarios (users)
- Descuentos (discounts)
- Liquidación (liquidations)
- Detalle (Details)
- Préstamos (loans)
- Cuotas (maturities)
- Asistencia (attendances)


## Referencia de la API

#### Login

```http
  GET /login
```

| Parametro | Tipo     | Descripción                |
| :-------- | :------- | :------------------------- |
| `user`    | `string` | **Required**               |
| `password`| `string` | **Required**               |


