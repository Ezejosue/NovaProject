<?php  
class sitepack 
{

    public static function menu (){
    print('<aside class="menu-sidebar2">
    <div id="logo_pizza_nova" class="logo">  
        <a align="center" href="#">
            <img src="../resources/images/logo.png" alt="Pizza Nova"/>
        </a>
    </div>
    <div class="menu-sidebar2__content js-scrollbar1">
        <div class="account2">
            <div class="image img-cir img-120">
                <img src="../resources/images/icon/avatar-big-01.jpg" alt="John Doe" />
            </div>
            <h4 class="name">john doe</h4>
        </div>
        
        <nav class="navbar-sidebar2">
            <ul class="list-unstyled navbar__list">
                <li>
                    <a href="index.php">
                        <i class="fas fa-tachometer-alt"></i>Vista General
                    </a>
                </li>
                <li>
                    <a href="perfil.php">
                        <i class="fas fa-user-circle"></i>Perfil</a>

                </li>
                <li>
                    <a href="categorias.php">
                        <i class="fas fa-list"></i>Categorías</a>
                </li>
                        <li>
                            <a href="productos.php">
                                <i class="fas fa-shopping-basket"></i>Productos</a>
                        </li>
                        <li>
                            <a href="usuarios.php">
                                <i class="fas fa-users"></i>Usuarios</a>
                        </li>
                        <li>
                            <a href="empleados.php">
                                <i class="fas fa-id-card"></i>Empleados</a>
                        </li>
                    </li>
                    <li>
                        <a href="reportes.php">
                            <i class="fas fa-chart-bar"></i>Reportes</a>
                    </li>
                    <li>
                        <a href="login.php">
                             <i class="fas fa-power-off"></i>Cerrar sesion</a>
                    </li>
            </ul>
        </nav>
    </div>
</aside>');
    }
}
?>