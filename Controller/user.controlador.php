<?php
include_once("../Entity/user.entidad.php");
include_once("../Model/user.modelo.php");


$operacion= $_POST['operacion'];
$UserE = new \entidadUser\User();

if ($operacion == 'Registrar') {
    $UserE->setPrimer_nombre($_POST['primer_nombre']);
    $UserE->setSegundo_nombre($_POST['segundo_nombre']);
    $UserE->setPrimer_apellido($_POST['primer_apellido']);
    $UserE->setSegundo_apellido($_POST['segundo_apellido']);
    $UserE->setCorreo($_POST['correo']);
    $UserE->setCelular($_POST['celular']);
    $UserE->setTipo_doc($_POST['tipo_doc']);
    $UserE->setNum_doc($_POST['num_doc']);
    $UserE->setCod_contrato($_POST['cod_contrato']);
    $UserE->setUser($_POST['user']);
    $UserE->setPassword($_POST['password']);
    $UserE->setEmpresa($_POST['empresa']);
    $UserE->setRol($_POST['rol']);

    $UserM = new \modeloUser\User($UserE);
    $mensaje = $UserM->registrarUserEmpresa();
}
else if ($operacion == 'Mostrar'){
    $UserM = new \modeloUser\User($UserE);
    $mensaje = $UserM->mostrarUserEmpresa();
}
else if ($operacion == 'Eliminar'){
    $UserE->setId_user($_POST['id']);
    $UserM = new \modeloUser\User($UserE);
    $mensaje = $UserM->eliminarUserEmpresa();
}
else if ($operacion == 'MostrarEditar'){
    $UserE->setId_user($_POST['id']);
    $UserM = new \modeloUser\User($UserE);
    $mensaje = $UserM->mostrarEditarUserEmpresa();
}
else if ($operacion == 'Editar'){
    $UserE->setId_user($_POST['id']);
    $UserE->setPrimer_nombre($_POST['primer_nombre']);
    $UserE->setSegundo_nombre($_POST['segundo_nombre']);
    $UserE->setPrimer_apellido($_POST['primer_apellido']);
    $UserE->setSegundo_apellido($_POST['segundo_apellido']);
    $UserE->setCorreo($_POST['correo']);
    $UserE->setCelular($_POST['celular']);
    $UserE->setTipo_doc($_POST['tipo_doc']);
    $UserE->setNum_doc($_POST['num_doc']);
    $UserE->setCod_contrato($_POST['cod_contrato']);
    $UserE->setUser($_POST['user']);
    $UserE->setPassword($_POST['password']);
    $UserE->setEmpresa($_POST['empresa']);
    $UserE->setRol($_POST['rol']);
    $UserM = new \modeloUser\User($UserE);
    $mensaje = $UserM->editarUserEmpresa();
}
else if ($operacion == 'Buscar'){
    $UserE->setUser($_POST['user']);
    $UserE->setRol($_POST['rol']);
    $UserM = new \modeloUser\User($UserE);
    $mensaje = $UserM->buscarUserEmpresa();
}
else if ($operacion == 'Ingresar'){
    $UserE->setUser($_POST['user']);
    $UserE->setPassword($_POST['password']);
    $UserM = new \modeloUser\User($UserE);
    $mensaje = $UserM->loginUser();
}
else if ($operacion == 'Salir'){
    $UserM = new \modeloUser\User($UserE);
    $UserM->closeUser();
}

unset($UserE);
unset($UserM);

echo json_encode($mensaje);
?>