	<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

    <div class="menu_section">
        <h3>Usuario: {{Auth::User()->type}}</h3>
        <ul class="nav side-menu">
            <li><a><i class="fa fa-home"></i> Home <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu" style="display: none">
                    <li><a href="/home">Dashboard</a></li>
                </ul>
            </li>

            <li><a><i class="fa fa-desktop"></i> Ventas <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu" style="display: none">
                    <li><a href="/ventas">Ventas hoy</a>
                    </li>
                    <li><a href="/allventas">Todas las Ventas</a>
                    </li>
                </ul>
            </li>

        </ul>
    </div>
    

</div>