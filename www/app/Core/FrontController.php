<?php

namespace Com\Daw2\Core;

use Steampixel\Route;

class FrontController
{

    static function main()
    {
        session_start();

        //Rutas que están disponibles para todos
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
            '/indexTaller',
            function () {
                $controlador = new \Com\Daw2\Controllers\TallerController();
                $controlador->showIndexTaller();
            },
            'get'
        );

           Route::add(
            '/empleadosTaller',
            function () {
                $controlador = new \Com\Daw2\Controllers\TallerController();
                $controlador->showEmpleadosTaller();
            },
            'get'
        );

        Route::add(
            '/logout',
            function () {
                $controlador = new \Com\Daw2\Controllers\TallerController();
                $controlador->logout();
            },
            'get'
        );

           Route::add(
            '/vehiculos',
            function () {
                $controlador = new \Com\Daw2\Controllers\TallerController();
                $controlador->showVehiculos();
            },
            'get'
        );

        Route::add(
            '/reservas',
            function () {
                $controlador = new \Com\Daw2\Controllers\TallerController();
                $controlador->showReservas();
            },
            'get'
        );

        Route::add(
            '/register',
            function () {
                $controlador = new \Com\Daw2\Controllers\ClienteController();
                $controlador->showRegister();
            },
            'get'
        );



        Route::run();
    }
//
//session_start();
//if (!isset($_SESSION['usuario']) || empty($_SESSION['usuario'])) {
//
//    Route::add('/login',
//        function (){
//            $controlador = new \Com\Daw2\Controllers\UsuarioController();
//            $controlador->showLogin();
//        },
//        'get'
//    );
//
//
//    Route::add('/login',
//        function (){
//            $controlador = new \Com\Daw2\Controllers\UsuarioController();
//            $controlador->login();
//        },
//        'post'
//    );
//
//    Route::pathNotFound(
//        function () {
//            $controller = new \Com\Daw2\Controllers\UsuarioController();
//            $controller->showLogin();
//        },
//        'get'
//    );
//
//    Route::pathNotFound(
//        function () {
//            $controller = new \Com\Daw2\Controllers\UsuarioController();
//            $controller->login();
//        },
//        'post'
//    );
//
//}else{
//    Route::add(
//        '/usuarios-sistema',
//        function (){
//            $controlador = new \Com\Daw2\Controllers\UsuarioController();
//            $controlador->showUsuarios();
//        }
//    );
//    Route::add(
//        '/usuarios-sistema/edit/([0-9]+)',
//        function ($id_usuario){
//            $controlador = new \Com\Daw2\Controllers\UsuarioController();
//            $controlador->showUsuarioEdit($id_usuario);
//        },
//        'get'
//    );
//
//    Route::add(
//        '/usuarios-sistema/edit/([0-9]+)',
//        function ($id_usuario){
//            $controlador = new \Com\Daw2\Controllers\UsuarioController();
//            $controlador->editUsuario($id_usuario);
//        },
//        'post'
//    );
//
//    Route::add(
//        '/usuarios-sistema/delete/([0-9]+)',
//        function ($id_usuario){
//            $controlador = new \Com\Daw2\Controllers\UsuarioController();
//            $controlador->deleteUsuario($id_usuario);
//        },
//        'get'
//    );
//
//
//
//    Route::add('/usuarios-sistema/add',
//        function (){
//            $controlador = new \Com\Daw2\Controllers\UsuarioController();
//            $controlador->showAltaUsuario();
//        },
//        'get'
//    );
//
//    Route::add('/usuarios-sistema/add',
//        function (){
//            $controlador = new \Com\Daw2\Controllers\UsuarioController();
//            $controlador->altaUsuarios();
//        },
//        'post'
//    );
//
//    Route::add('/usuarios-sistema/baja/([0-9]+)',
//        function ($id_usuario){
//            $controlador = new \Com\Daw2\Controllers\UsuarioController();
//            $controlador->estadoUsuario($id_usuario);
//        },
//        'get'
//    );
//
//
//    Route::add('/logout',
//        function (){
//            $controlador = new \Com\Daw2\Controllers\UsuarioController();
//            $controlador->logout();
//        },
//        'get'
//    );
//
//
//
//
//    //Demos
//    Route::add(
//        '/demos/usuarios-sistema',
//        function () {
//            $controlador = new \Com\Daw2\Controllers\InicioController();
//            $controlador->demoUsuariosSistema();
//        },
//        'get'
//    );
//
//
//
//
//
//
//    Route::add(
//        '/demos/usuarios-sistema/add',
//        function () {
//            $controlador = new \Com\Daw2\Controllers\InicioController();
//            $controlador->demoUsuariosSistemaAdd();
//        },
//        'get'
//    );
//
//    Route::add(
//        '/demos/login',
//        function () {
//            $controlador = new \Com\Daw2\Controllers\InicioController();
//            $controlador->demoLogin();
//        },
//        'get'
//    );
//
//
//    # Gestion de categorías
//    Route::add(
//        '/categorias',
//        function () {
//            $controlador = new \Com\Daw2\Controllers\CategoriaController();
//            $controlador->mostrarTodos();
//        },
//        'get'
//    );
//
//    Route::add(
//        '/categorias/view/([0-9]+)',
//        function ($id) {
//            $controlador = new \Com\Daw2\Controllers\CategoriaController();
//            $controlador->view((int)$id);
//        },
//        'get'
//    );
//
//    Route::add(
//        '/categorias/delete/([0-9]+)',
//        function ($id) {
//            $controlador = new \Com\Daw2\Controllers\CategoriaController();
//            $controlador->delete($id);
//        },
//        'get'
//    );
//
//    Route::add(
//        '/categorias/edit/([0-9]+)',
//        function ($id) {
//            $controlador = new \Com\Daw2\Controllers\CategoriaController();
//            $controlador->mostrarEdit((int)$id);
//        },
//        'get'
//    );
//
//    Route::add(
//        '/categorias/edit/([0-9]+)',
//        function ($id) {
//            $controlador = new \Com\Daw2\Controllers\CategoriaController();
//            $controlador->edit($id);
//        },
//        'post'
//    );
//
//    Route::add(
//        '/categorias/add',
//        function () {
//            $controlador = new \Com\Daw2\Controllers\CategoriaController();
//            $controlador->mostrarAdd();
//        },
//        'get'
//    );
//
//    Route::add(
//        '/categorias/add',
//        function () {
//            $controlador = new \Com\Daw2\Controllers\CategoriaController();
//            $controlador->add();
//        },
//        'post'
//    );
//
//    //Produtos
//    Route::add(
//        '/productos',
//        function () {
//            $controlador = new \Com\Daw2\Controllers\ProductoController();
//            $controlador->mostrarTodos();
//        },
//        'get'
//    );
//    Route::add(
//        '/productos/view/([A-Za-z0-9]+)',
//        function ($codigo) {
//            $controlador = new \Com\Daw2\Controllers\ProductoController();
//            $controlador->view($codigo);
//        },
//        'get'
//    );
//
//    Route::add(
//        '/productos/delete/([A-Za-z0-9]+)',
//        function ($codigo) {
//            $controlador = new \Com\Daw2\Controllers\ProductoController();
//            $controlador->delete($codigo);
//        },
//        'get'
//    );
//
//    Route::add(
//        '/productos/edit/([A-Za-z0-9]+)',
//        function ($codigo) {
//            $controlador = new \Com\Daw2\Controllers\ProductoController();
//            $controlador->mostrarEdit($codigo);
//        },
//        'get'
//    );
//
//    Route::add(
//        '/productos/edit/([A-Za-z0-9]+)',
//        function ($codigo) {
//            $controlador = new \Com\Daw2\Controllers\ProductoController();
//            $controlador->processEdit($codigo);
//        },
//        'post'
//    );
//
//    Route::add(
//        '/productos/add',
//        function () {
//            $controlador = new \Com\Daw2\Controllers\ProductoController();
//            $controlador->mostrarAdd();
//        },
//        'get'
//    );
//
//    Route::add(
//        '/productos/add',
//        function () {
//            $controlador = new \Com\Daw2\Controllers\ProductoController();
//            $controlador->processAdd();
//        },
//        'post'
//    );
//
//    //Proveedores
//    Route::add(
//        '/proveedores',
//        function () {
//            $controlador = new \Com\Daw2\Controllers\ProveedorController();
//            $controlador->mostrarTodos();
//        },
//        'get'
//    );
//
//    Route::add(
//        '/proveedores/view/([A-Za-z0-9]+)',
//        function ($cif) {
//            $controlador = new \Com\Daw2\Controllers\ProveedorController();
//            $controlador->view($cif);
//        },
//        'get'
//    );
//
//    Route::add(
//        '/proveedores/delete/([A-Za-z0-9]+)',
//        function ($cif) {
//            $controlador = new \Com\Daw2\Controllers\ProveedorController();
//            $controlador->delete($cif);
//        },
//        'get'
//    );
//
//
//    Route::add(
//        '/proveedores/edit/([A-Za-z0-9]+)',
//        function ($cif) {
//            $controlador = new \Com\Daw2\Controllers\ProveedorController();
//            $controlador->mostrarEdit($cif);
//        },
//        'get'
//    );
//
//    Route::add(
//        '/proveedores/edit/([A-Za-z0-9]+)',
//        function ($cif) {
//            $controlador = new \Com\Daw2\Controllers\ProveedorController();
//            $controlador->edit($cif);
//        },
//        'post'
//    );
//
//    Route::add(
//        '/proveedores/add',
//        function () {
//            $controlador = new \Com\Daw2\Controllers\ProveedorController();
//            $controlador->mostrarAdd();
//        },
//        'get'
//    );
//
//    Route::add(
//        '/proveedores/add',
//        function () {
//            $controlador = new \Com\Daw2\Controllers\ProveedorController();
//            $controlador->add();
//        },
//        'post'
//    );
//
//
//    Route::pathNotFound(
//        function () {
//            $controller = new \Com\Daw2\Controllers\ErroresController();
//            $controller->error404();
//        }
//    );
//    Route::methodNotAllowed(
//        function () {
//            $controller = new \Com\Daw2\Controllers\ErroresController();
//            $controller->error405();
//        }
//    );
//
//
//}



}