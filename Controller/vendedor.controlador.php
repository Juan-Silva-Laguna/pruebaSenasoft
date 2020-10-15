<?php
include_once("../Entity/vendedor.entidad.php");
include_once("../Model/vendedor.modelo.php");


$operacion= $_POST['operacion'];
$VendedorE = new \entidadVendedor\Vendedor();

if ($operacion == 'Agregar') {
    $VendedorE->setProductos($_POST['productos']);
    
    $VendedorM = new \modeloVendedor\Vendedor($VendedorE);
    $mensaje = $VendedorM->agregar();
}
else if ($operacion == 'Mostrar'){
    $VendedorM = new \modeloVendedor\Vendedor($VendedorE);
    $mensaje = $VendedorM->mostrarProductos();
}
else if ($operacion == 'Eliminar'){
    $VendedorE->setId_Vendedor($_POST['id']);
    $VendedorM = new \modeloVendedor\Vendedor($VendedorE);
    $mensaje = $VendedorM->eliminarVendedorEmpresa();
}
else if ($operacion == 'MostrarEditar'){
    $VendedorE->setId_Vendedor($_POST['id']);
    $VendedorM = new \modeloVendedor\Vendedor($VendedorE);
    $mensaje = $VendedorM->mostrarEditarVendedorEmpresa();
}
else if ($operacion == 'Editar'){
    $VendedorE->setId_Vendedor($_POST['id']);
    $VendedorE->setPrimer_nombre($_POST['primer_nombre']);
    $VendedorE->setSegundo_nombre($_POST['segundo_nombre']);
    $VendedorE->setPrimer_apellido($_POST['primer_apellido']);
    $VendedorE->setSegundo_apellido($_POST['segundo_apellido']);
    $VendedorE->setCorreo($_POST['correo']);
    $VendedorE->setCelular($_POST['celular']);
    $VendedorE->setTipo_doc($_POST['tipo_doc']);
    $VendedorE->setNum_doc($_POST['num_doc']);
    $VendedorE->setCod_contrato($_POST['cod_contrato']);
    $VendedorE->setVendedor($_POST['Vendedor']);
    $VendedorE->setPassword($_POST['password']);
    $VendedorE->setEmpresa($_POST['empresa']);
    $VendedorE->setRol($_POST['rol']);
    $VendedorM = new \modeloVendedor\Vendedor($VendedorE);
    $mensaje = $VendedorM->editarVendedorEmpresa();
}
else if ($operacion == 'Buscar'){
    $VendedorE->setVendedor($_POST['Vendedor']);
    $VendedorE->setRol($_POST['rol']);
    $VendedorM = new \modeloVendedor\Vendedor($VendedorE);
    $mensaje = $VendedorM->buscarVendedorEmpresa();
}


unset($VendedorE);
unset($VendedorM);

echo json_encode($mensaje);
?>