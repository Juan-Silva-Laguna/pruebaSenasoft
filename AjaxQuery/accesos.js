$(document).ready(function(){
    $(document).on('click', '#btn_iniciar', function (event) {
        event.preventDefault();
        const datos = {
            user: $('#usuario').val(),
            password: $('#clave').val(),
            operacion: 'Ingresar'
        };
        console.log(datos);
        $.post('Controller/user.controlador.php', datos, function (respuesta) {
            let res = JSON.parse(respuesta);
            switch (res) {
                case 'Administrador maestro':
                    $(location).attr('href','View/AdministradorGeneral/index.php');
                    break;
                case 'Administrador empresa':
                    $(location).attr('href','View/Gerente/index.php');
                break;
                case 'Administrador bodega':
                    $(location).attr('href','View/AdministradorBodega/index.php');
                    break;
                case 'Empleado':
                    $(location).attr('href','View/Vendedor/index.php');
                break;
                case 'Proveedor':
                    $(location).attr('href','View/Proveedor/index.php');
                    break;
                default:
                    alertify.error(res);
                break;
            }
        })
    });

    $(document).on('click', '#salir', function (event) {
        event.preventDefault();
        $.post('../../Controller/user.controlador.php', {operacion: 'Salir'});
        $(location).attr('href','../../login.php');
    });

});