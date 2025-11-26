<!-- ASIDE -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="#" class="brand-link">
        <i class="fas fa-car-alt brand-image img-circle elevation-3" style="opacity: 0.8"></i>
        <span class="brand-text font-weight-light">Galician Motors</span>
    </a>

    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column">
                
                <li class="nav-item">
                    <a href="/indexTaller" class="nav-link <?php echo isset($seccion) && $seccion === '/indexTaller' ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-chart-line"></i>
                        <p>Inicio</p>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a href="/empleadosTaller" class="nav-link <?php echo isset($seccion) && $seccion === '/empleadosTaller' ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-users-cog"></i>
                        <p>Empleados</p>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a href="/vehiculos" class="nav-link <?php echo isset($seccion) && $seccion === '/vehiculos' ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-car-side"></i>
                        <p>Vehhiculos</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="/reservas" class="nav-link <?php echo isset($seccion) && $seccion === '/reservas' ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-tools"></i>
                        <p>Reservas</p>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a href="/facturacion" class="nav-link <?php echo isset($seccion) && $seccion === '/facturacion' ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-cash-register"></i>
                        <p>Facturacion</p>
                    </a>
                </li>
                
                <li class="nav-header">OPCIONES</li>
                
                <li class="nav-item">
                    <a href="/logout" class="nav-link">
                        <i class="nav-icon fas fa-sign-out-alt text-danger"></i>
                        <p>Cerrar Sesion</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>