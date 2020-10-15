<?php
session_start();
    if ($_SESSION['rol'] != 'Empleado') {
        header('Location: ../../login.php');
    }
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Sistema Ventas">
    <meta name="author" content="Incanatoit.com">
    <meta name="keyword" content="Sistema ventas Laravel Vue Js, Sistema compras Laravel Vue Js">
    <link rel="shortcut icon" href="../../Assets/Images/logo.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css">
    <title>Sistema Ventas </title>
    <!-- Icons -->
    <link href="../../Assets/Css/font-awesome.min.css" rel="stylesheet">
    <link href="../../Assets/Css/simple-line-icons.min.css" rel="stylesheet">
    <!-- Main styles for this application -->
    <link href="../../Assets/Css/style.css" rel="stylesheet">
    <!-- include the style -->
    <link rel="stylesheet" href="../../Assets/Css/alertify.min.css" />
    <!-- include a theme -->
    <link rel="stylesheet" href="../../Assets/Css/default.min.css" />
</head>

<body class="app sidebar-minimized brand-minimized">
    <header class="app-header navbar">
        <button class="navbar-toggler mobile-sidebar-toggler d-lg-none mr-auto" type="button">
          <!-- <span class="navbar-toggler-icon"></span> -->
        </button>
        <a class="navbar-brand" href="#">
            <img src="../../Assets/Images/logo.png" width="160px" alt="">
        </a>
        <ul class="nav navbar-nav d-md-down-none">
            <li class="nav-item px-3">
                <!-- <a class="nav-link" href="#"> Sistema de Ventas Contable </a> -->
            </li>
            <li class="nav-item px-3">
                <a class="nav-link" href="#">  </a>
            </li>
        </ul>
        <ul class="nav navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                    <span class="d-md-down-none"><?php echo $_SESSION['usuario'];?> </span>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <div class="dropdown-header text-center"style="background:#4dbd74; color:#fff;">
                        <strong>Cuenta</strong>
                    </div>
                    <a class="dropdown-item" href="#" id="salir"><i class="fa fa-lock"></i> Cerrar sesión</a>
                </div>
            </li>
            <li class="nav-item d-md-down-none"></li>
        </ul>
    </header>

    <div class="app-body">

        <!-- Contenido Principal -->
        <main class="main"><br>
            <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> Ventas En Mi Sucursal
                        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modalNuevo">
                            <i class="icon-plus"></i>&nbsp;Ver Factura
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="form-group row" >
                            <div class="col-md-6">
                                <div class="input-group">
                                    <select class="form-control col-md-3" id="criterio">
                                      <option value="usuario.usuario">Usuario</option>
                                      <option value="empresa.nombre_empresa">Empresa</option>
                                      <option value="usuario.codigo_contrato">Codigo Contrato</option>
                                      <option value="persona.num_documento">Numero Documento</option>
                                    </select>
                                    <input type="text" id="texto" class="form-control" placeholder="Texto a buscar">
                                    <button type="submit" class="btn btn-primary" id="btn_buscar"><i class="fa fa-search"></i> Buscar</button>
                                </div>
                            </div>
                        </div>
                        <table class="table table-bordered table-striped table-sm" id="userTable">
                            <thead>
                                <tr>
                                    <th>Codigo Producto</th>
                                    <th>Nombre Producto</th>
                                    <th>Unidad</th>
                                    <th>Precio</th>
                                    <th>Cantidad Entrada</th>
                                    <th>Cantidad Salida</th>
                                    <th>Opcion</th>
                                </tr>
                            </thead>
                            <tbody id="tableUserBody">
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- Fin ejemplo de tabla Listado -->
            </div>
            <!--Inicio del modal agregar/actualizar-->
            <div class="modal fade" id="modalNuevo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Facturación del Dia <?php echo date("d-m-Y");?></h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form enctype="multipart/form-data" class="form-horizontal">
                                <div class="form-group text-center">
                                    <img src="../../Assets/Images/logo.png" width="160px" alt="">
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label class="form-control-label" for="text-input">Tipo de documento</label>
                                        <select id="tipo_doc" class="form-control">
                                            <option value="Cédula de ciudadanía">Cédula de ciudadanía</option>
                                            <option value="Cédula de extranjería">Cédula de extranjería</option>
                                            <option value="Pasaporte">Pasaporte</option>
                                        </select>
                                        <br>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-control-label" for="text-input">Numero de documento de cliente </label>
                                        <input type="text" id="segundo_nombre" class="form-control" placeholder="Numero de documento de cliente " required>
                                        <br>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="form-control-label" for="text-input">Nombre</label>
                                        <input type="text" id="nombre" class="form-control" placeholder="Nombre de cliente" required>
                                        <br>
                                    </div>
                                    <div class="col-md-12">
                                        <table class="table table-bordered table-striped table-sm">
                                            <thead>
                                                <tr>	
                                                    <th>Cantidad</th>
                                                    <th>U/m</th>
                                                    <th>Nombre</th>
                                                    <th>Precio</th>
                                                    <th>Monto</th>
                                                </tr>
                                            </thead>
                                            <tbody id="cuerpoTabla">
                                            </tbody>
                                        </table>
                                        <button type="button" class="btn btn-success" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">+</span>
                                        </button>
                                    </div>
                                    
                                    <input type="hidden" id="rol" value="Administrador empresa">
                                    <input type="hidden" id="id">
                                    <div class="col-md-12 text-center"><br>
                                        <input type="submit" class="btn btn-primary" id="btn_registrar" value="Guardar e Imprimir">
                                    </div>
                                </div>    
                            </form>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!--Fin del modal-->
            <div class="modal fade" id="modalAgregar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" style="width: 200px;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document" style="width: 400px;">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Ventas</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form enctype="multipart/form-data" class="form-horizontal">
                                <input type="hidden" id="id_producto">
                                <input type="hidden" id="precio_unidad">
                                <input type="hidden" id="id_producto">
                                <div class="form-group row">
                                    <div class="col-md-12"><br>
                                        <label class="form-control-label" for="text-input">Cuantos articulos de <b id="texto_prod"></b> llevara el cliente?</label>
                                         <br>
                                        <input type="hidden" id="info">
                                        <input type="number" id="cant" class="form-control" require>
                                        <br>
                                        <input type="submit" class="btn btn-primary" id="btn_agregar" value="Agregar">
                                    </div>
                                </div>    
                            </form>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
        </main>
        <!-- /Fin del contenido principal -->
    </div>
    <script src="../../Assets/Js/jquery.min.js"></script>
    <script src="../../AjaxQuery/vendedor.js"></script>
    <script src="../../AjaxQuery/accesos.js"></script>
    <footer class="app-footer">
        <span><a href="#">Sistema Ventas Contable</a> &copy; 2020</span>
        <span class="ml-auto">Desarrollado por <a href="#">Centro de la Industria, la Empresa y los Servicios.</a></span>
    </footer>
    <!-- include the script -->
    <script src="../../Assets/Js/alertify.min.js"></script>
    <!-- Bootstrap and necessary plugins -->
    <script src="../../Assets/Js/popper.min.js"></script>
    <script src="../../Assets/Js/bootstrap.min.js"></script>
    <script src="../../Assets/Js/pace.min.js"></script>
    <!-- Plugins and scripts required by all views -->
    <script src="../../Assets/Js/Chart.min.js"></script>
    <!-- GenesisUI main scripts -->
    <script src="../../Assets/Js/template.js"></script>
</body>
</html>