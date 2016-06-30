<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

    <div class="menu_section">
        <h3>Usuario: {{Auth::User()->type}}</h3>
        <ul class="nav side-menu">
            <li><a><i class="fa fa-home"></i> Home <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu" style="display: none">
                    <li><a href="/home">Dashboard</a>
                    </li>
                    
                    <li><a href="/profile">Perfil</a>
                    </li>
                    <li><a href="/empresa">Empresa</a>
                    </li>
                    
                </ul>
            </li>
            <li><a><i class="fa fa-edit"></i> Mantenimiento <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu" style="display: none">
                    </li>
                    <li><a href="/proveedor">Proveedores</a></li>
                    <li><a href="/cliente">Clientes</a></li>
                    <li><a href="/categoria">Categorias</a></li>
                    <li><a href="/clase">Clase Producto</a></li>
                    <li><a href="/marca">Marca</a></li>
                    <li><a href="/producto">Productos</a></li>
                    <li><a href="/usuario">Usuarios</a></li>
                </ul>
            </li>
            <li><a><i class="fa fa-desktop"></i> Ventas <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu" style="display: none">
                    <li><a href="/ventas">Ventas Usuarios</a>
                    </li>
                    <li><a href="/allventas">Todas las Ventas</a>
                    </li>
                </ul>
            </li>
            <li><a><i class="fa fa-table"></i> Inventario <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu" style="display: none">
                    <li><a href="/pe">Parte entrada</a>
                    </li>
                    <li><a href="/kardex">Kardex</a>
                    </li>
                </ul>
            </li>
            <li><a><i class="fa fa-bar-chart-o"></i> Reportes <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu" style="display: none">
                    <li><a href="chartjs.html">Ventas x Usuario</a>
                    </li>
                    <li><a href="chartjs2.html">Ventas todas</a>
                    </li>
                    <li><a href="morisjs.html">Productos más vendidos</a>
                    </li>
                    <li><a href="echarts.html">Grafico Ventas</a>
                    </li>
                    <li><a href="other_charts.html">Grafico vendedores </a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
    <div class="menu_section">
        <h3>Live On</h3>
        <ul class="nav side-menu">
            <li><a><i class="fa fa-bug"></i> Additional Pages <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu" style="display: none">
                    <li><a href="e_commerce.html">E-commerce</a>
                    </li>
                    <li><a href="projects.html">Projects</a>
                    </li>
                    <li><a href="project_detail.html">Project Detail</a>
                    </li>
                    <li><a href="contacts.html">Contacts</a>
                    </li>
                    <li><a href="profile.html">Profile</a>
                    </li>
                </ul>
            </li>
            <li><a><i class="fa fa-windows"></i> Extras <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu" style="display: none">
                    <li><a href="page_404.html">404 Error</a>
                    </li>
                    <li><a href="page_500.html">500 Error</a>
                    </li>
                    <li><a href="plain_page.html">Plain Page</a>
                    </li>
                    <li><a href="login.html">Login Page</a>
                    </li>
                    <li><a href="pricing_tables.html">Pricing Tables</a>
                    </li>

                </ul>
            </li>
            <li><a><i class="fa fa-laptop"></i> Landing Page <span class="label label-success pull-right">Coming Soon</span></a>
            </li>
        </ul>
    </div>

</div>