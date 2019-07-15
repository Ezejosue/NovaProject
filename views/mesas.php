<!-- SIDEBAR-->
<?php
    require_once('../core/helpers/dashboard.php');
    Dashboard::headerTemplate('Ordenes');
?>
<!-- Contenido-->
<div class="main-content">
    <div class="container-fluid ">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-sm-12 col-md-10 recent-report2">
                <h3 class="title-3 text-center">Seleccione una mesa</h3>
                <br>
                <form action="post" id="data-mesas">
                
                <br>
                </form>
            </div>
            <div class="col-md-1"></div>
        </div>
    </div>
</div>

    <?php
Dashboard::footerTemplate('mesas.js', '');
?>
    </body>

    </html>