<?php

namespace Com\Daw2\Core;

use Steampixel\Route;

class FrontController
{

    static function main()
    {
        session_start();
        Route::add(
            '/logout',
            function () {
                $controlador = new \Com\Daw2\Controllers\TallerController();
                $controlador->logout();
            },
            'get'
        );

        Route::add(
            '/',
            function () {
                $controlador = new \Com\Daw2\Controllers\ClienteController();
                $controlador->index();
            },
            'get'
        );
        Route::add(
            '/login',
            function () {
                $controlador = new \Com\Daw2\Controllers\ClienteController();
                $controlador->showLogin();
            },
            'get'
        );
        Route::add(
            '/login',
            function () {
                $controlador = new \Com\Daw2\Controllers\ClienteController();
                $controlador->login();
            },
            'post'
        );
        Route::add(
            '/register',
            function () {
                $controlador = new \Com\Daw2\Controllers\ClienteController();
                $controlador->showRegister();
            },
            'get'
        );
        Route::add(
            '/register',
            function () {
                $controlador = new \Com\Daw2\Controllers\ClienteController();
                $controlador->register();
            },
            'post'
        );
        Route::add(
            '/horarios',
            function () {
                $controlador = new \Com\Daw2\Controllers\ClienteController();
                $controlador->showHorarios();
            },
            'get'
        );
        Route::add(
            '/sobreNosotros',
            function () {
                $controlador = new \Com\Daw2\Controllers\ClienteController();
                $controlador->showSobreNosotros();
            },
            'get'
        );


        if (isset($_SESSION['datosUsuario'])) {


            Route::add(
                '/facturasCliente',
                function () {
                    $controlador = new \Com\Daw2\Controllers\FacturasController();
                    $controlador->showFacturasCliente();
                },
                'get'
            );

            Route::add('/reservaCliente',
                function (){
                    $controlador = new \Com\Daw2\Controllers\ReservaClienteController();
                    $controlador->showReservaCliente();
                },
                'get'
            );

            Route::add('/nuevaReserva',
                function (){
                    $controlador = new \Com\Daw2\Controllers\ReservaClienteController();
                    $controlador->showNuevaReserva();
                },
                'get'
            );

            Route::add('/nuevaReserva',
                function (){
                    $controlador = new \Com\Daw2\Controllers\ReservaClienteController();
                    $controlador->nuevaReserva();
                },
                'post'
            );

            Route::add('/reservaCliente/delete/([0-9]+)',
                function ($id_reserva){
                    $controlador = new \Com\Daw2\Controllers\ReservaClienteController();
                    $controlador->deleteReservaCliente($id_reserva);
                },
                'get'
            );
        }

        if (isset($_SESSION['permisos'])) {

            if (isset($_SESSION['permisos']['inicioTaller']) && str_contains($_SESSION['permisos']['inicioTaller'], 'r')) {
                Route::add(
                    '/indexTaller',
                    function () {
                        $controlador = new \Com\Daw2\Controllers\TallerController();
                        $controlador->showIndexTaller();
                    },
                    'get'
                );

                if (str_contains($_SESSION['permisos']['inicioTaller'], 'w') || str_contains($_SESSION['permisos']['inicioTaller'], 'd')) {
                    Route::add(
                        '/indexTaller/cambiar-disponibilidad/([0-9]+)',
                        function ($id_usuario) {
                            $controlador = new \Com\Daw2\Controllers\TallerController();
                            $controlador->cambiarDisponibilidad($id_usuario);
                        },
                        'get'
                    );
                }
            }

            if (isset($_SESSION['permisos']['empleados']) && str_contains($_SESSION['permisos']['empleados'], 'r')) {
                Route::add(
                    '/empleadosTaller',
                    function () {
                        $controlador = new \Com\Daw2\Controllers\EmpleadosController();
                        $controlador->showEmpleados();
                    },
                    'get'
                );

                if (str_contains($_SESSION['permisos']['empleados'], 'w')) {
                    Route::add(
                        '/altaEmpleado',
                        function () {
                            $controlador = new \Com\Daw2\Controllers\EmpleadosController();
                            $controlador->showAltaEmpleado();
                        },
                        'get'
                    );
                    Route::add(
                        '/altaEmpleado',
                        function () {
                            $controlador = new \Com\Daw2\Controllers\EmpleadosController();
                            $controlador->altaEmpleado();
                        },
                        'post'
                    );
                }

                if (str_contains($_SESSION['permisos']['empleados'], 'd')) {
                    Route::add(
                        '/empleadosTaller/delete/([0-9]+)',
                        function ($id_usuario){
                            $controlador = new \Com\Daw2\Controllers\EmpleadosController();
                            $controlador->deleteEmpleado($id_usuario);
                        },
                        'get'
                    );
                    Route::add('/empleadosTaller/baja/([0-9]+)',
                        function ($id_usuario){
                            $controlador = new \Com\Daw2\Controllers\EmpleadosController();
                            $controlador->desactivarUsuario($id_usuario);
                        },
                        'get'
                    );
                }
            }

            if (isset($_SESSION['permisos']['vehiculos']) && str_contains($_SESSION['permisos']['vehiculos'], 'r')) {
                Route::add(
                    '/vehiculos',
                    function () {
                        $controlador = new \Com\Daw2\Controllers\VehiculosController();
                        $controlador->showVehiculos();
                    },
                    'get'
                );
                Route::add('/vehiculos/gestionVehiculo/([0-9]+)',
                    function ($id_vehiculo){
                        $controlador = new \Com\Daw2\Controllers\VehiculosController();
                        $controlador->gestionarVehiculo($id_vehiculo);
                    },
                    'get'
                );

                if (str_contains($_SESSION['permisos']['vehiculos'], 'w') || str_contains($_SESSION['permisos']['vehiculos'], 'd')) {
                    Route::add('/vehiculos/gestionVehiculo/agregar-pieza/([0-9]+)',
                        function ($id_vehiculo){
                            $controlador = new \Com\Daw2\Controllers\VehiculosController();
                            $controlador->agregarPieza($id_vehiculo);
                        },
                        'post'
                    );
                    Route::add(
                        '/vehiculos/gestionVehiculo/eliminar-pieza/([0-9]+)/([0-9]+)',
                        function($idReparacionPieza, $idVehiculo) {
                            $controlador = new \Com\Daw2\Controllers\VehiculosController();
                            $controlador->eliminarPieza($idReparacionPieza, $idVehiculo);
                        },
                        'post'
                    );
                    Route::add('/vehiculos/gestionVehiculo/factura/([0-9]+)',
                        function ($id_vehiculo){
                            $controlador = new \Com\Daw2\Controllers\VehiculosController();
                            $controlador->generarFactura($id_vehiculo);
                        },
                        'post'
                    );
                }
            }

            if (isset($_SESSION['permisos']['reservas']) && str_contains($_SESSION['permisos']['reservas'], 'r')) {
                Route::add(
                    '/reservas',
                    function () {
                        $controlador = new \Com\Daw2\Controllers\ReservasTallerController();
                        $controlador->showReservas();
                    },
                    'get'
                );
                Route::add(
                    '/reservas/gestionar/([0-9]+)',
                    function ($id_reserva) {
                        $controlador = new \Com\Daw2\Controllers\ReservasTallerController();
                        $controlador->gestionarReservas($id_reserva);
                    },
                    'get'
                );

                if (str_contains($_SESSION['permisos']['reservas'], 'w') || str_contains($_SESSION['permisos']['reservas'], 'd')) {
                    Route::add(
                        '/reservas/gestionar/confirmar/([0-9]+)',
                        function ($id_reserva) {
                            $controlador = new \Com\Daw2\Controllers\ReservasTallerController();
                            $controlador->confirmarReserva($id_reserva);
                        },
                        'get'
                    );
                    Route::add(
                        '/reservas/gestionar/rechazar/([0-9]+)',
                        function ($id_reserva) {
                            $controlador = new \Com\Daw2\Controllers\ReservasTallerController();
                            $controlador->rechazarReserva($id_reserva);
                        },
                        'get'
                    );
                    Route::add(
                        '/reservas/gestionar/finalizar/([0-9]+)',
                        function ($id_reserva) {
                            $controlador = new \Com\Daw2\Controllers\ReservasTallerController();
                            $controlador->finalizarReserva($id_reserva);
                        },
                        'get'
                    );
                    Route::add(
                        '/reservas/gestionar/no-asistida/([0-9]+)',
                        function ($id_reserva) {
                            $controlador = new \Com\Daw2\Controllers\ReservasTallerController();
                            $controlador->noAsistidaReserva($id_reserva);
                        },
                        'get'
                    );
                }
            }

            if (isset($_SESSION['permisos']['facturacion']) && str_contains($_SESSION['permisos']['facturacion'], 'r')) {
                Route::add(
                    '/facturacion',
                    function () {
                        $controlador = new \Com\Daw2\Controllers\FacturasController();
                        $controlador->showFacturas();
                    },
                    'get'
                );

                if (str_contains($_SESSION['permisos']['facturacion'], 'w')) {
                    Route::add('/facturacion/pagar/([0-9]+)',
                        function ($id_factura){
                            $controlador = new \Com\Daw2\Controllers\FacturasController();
                            $controlador->marcarComoPagada($id_factura);
                        },
                        'post'
                    );
                }
            }
        }

        Route::pathNotFound(
            function () {
                $tienePermisoTaller = false;
                if(isset($_SESSION['permisos'])) {
                    foreach($_SESSION['permisos'] as $permiso) {
                        if(str_contains($permiso, 'r')) {
                            $tienePermisoTaller = true;
                            break;
                        }
                    }
                }

                if ($tienePermisoTaller) {
                    header('Location: /indexTaller');
                    exit;
                } else if (isset($_SESSION['datosUsuario'])) {
                    header('Location: /');
                    exit;
                } else {
                    header('Location: /login');
                    exit;
                }
            }
        );


        Route::run();
    }
}