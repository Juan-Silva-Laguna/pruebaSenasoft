$(document).ready(function(){
    mostrarTabla();

    $('#btn_registrar').on('click',function (e) {
        e.preventDefault();
        let datos = {};
        if ($('#btn_registrar').val() == 'Registrar') {
            datos = {
                primer_nombre: $('#primer_nombre').val(),
                segundo_nombre: $('#segundo_nombre').val(),
                primer_apellido: $('#primer_apellido').val(),
                segundo_apellido: $('#segundo_apellido').val(),
                correo: $('#correo').val(),
                celular: $('#celular').val(),
                tipo_doc: $('#tipo_doc').val(),
                num_doc: $('#num_doc').val(),
                cod_contrato: $('#cod_contrato').val(),
                user: $('#user').val(),
                password: $('#password').val(),
                empresa: $('#empresa').val(),
                rol: $('#rol').val(),
                operacion: 'Registrar'
            };
        }
        else if ($('#btn_registrar').val() == 'Actualizar') {
            datos = {
                id: $('#id').val(),
                primer_nombre: $('#primer_nombre').val(),
                segundo_nombre: $('#segundo_nombre').val(),
                primer_apellido: $('#primer_apellido').val(),
                segundo_apellido: $('#segundo_apellido').val(),
                correo: $('#correo').val(),
                celular: $('#celular').val(),
                tipo_doc: $('#tipo_doc').val(),
                num_doc: $('#num_doc').val(),
                cod_contrato: $('#cod_contrato').val(),
                user: $('#user').val(),
                password: $('#password').val(),
                empresa: $('#empresa').val(),
                rol: $('#rol').val(),
                operacion: 'Editar'
            };
        }
        $.post('../../Controller/user.controlador.php', datos, function (respuesta) {
            
           if (respuesta == '1') {
                alertify.success(`Se registro un nuvo gerente con su empresa`);
                
            }
            else if (respuesta == '2') {
                alertify.success(`Se Actualizaron los datos!`);
                
            }
            else{
                alertify.error(`Error de registro`);
            }
            
            mostrarTabla();
            $('#modalNuevo').modal('hide'); 
            limpiar();
         })
         
    });

    $('.close').on('click', function () {
        limpiar();
    });

    $('#btn_buscar').on('click', function () {
        let datos = {
            rol: $('#criterio').val(),
            user: $('#texto').val(),
            operacion: 'Buscar'
        };
        console.log(datos);
        $.post('../../Controller/user.controlador.php', datos, function (respuesta) {
            console.log(respuesta);
            var table = null;                 
            $.each(JSON.parse(respuesta), function(index, val) {
                table += `
                    <tr>
                        <td>
                            <button type="button" class="btn btn-warning btn-sm editar" value="${val.id_persona}-${val.id_usuario}-${val.id_empresa}"  data-toggle="modal" data-target="#modalNuevo">
                                <i class="icon-pencil"></i>
                            </button> &nbsp;
                            <button type="button" class="btn btn-danger btn-sm eliminar" value="${val.id_persona}">
                                <i class="icon-trash"></i>
                            </button>
                        </td>
                        <td>${val.primer_nombre} ${val.primer_apellido}</td>
                        <td>${val.num_celular}</td>
                        <td>${val.correo}</td>
                        <td>${val.num_documento}</td>
                        <td>${val.usuario}</td>
                        <td>${val.rol_usuario}</td>
                        <td>${val.codigo_contrato}</td>   
                        <td>${val.nombre_empresa} </td>
                    </tr>                
                `;
            });
            
            $('#tableUserBody').html(table);
        })
    });

    function mostrarTabla(){        
        let operacion = 'Mostrar';   
        $.post('../../Controller/user.controlador.php', {operacion}, function (respuesta) {
            var table = null;                 
            $.each(JSON.parse(respuesta), function(index, val) {
                table += `
                    <tr>
                        <td>
                            <button type="button" class="btn btn-warning btn-sm editar" value="${val.id_persona}-${val.id_usuario}-${val.id_empresa}"  data-toggle="modal" data-target="#modalNuevo">
                                <i class="icon-pencil"></i>
                            </button> &nbsp;
                            <button type="button" class="btn btn-danger btn-sm eliminar" value="${val.id_persona}">
                                <i class="icon-trash"></i>
                            </button>
                        </td>
                        <td>${val.primer_nombre} ${val.primer_apellido}</td>
                        <td>${val.num_celular}</td>
                        <td>${val.correo}</td>
                        <td>${val.num_documento}</td>
                        <td>${val.usuario}</td>
                        <td>${val.rol_usuario}</td>
                        <td>${val.codigo_contrato}</td>   
                        <td>${val.nombre_empresa} </td>
                    </tr>                
                `;
            });
            
            $('#tableUserBody').html(table);
        })
    }

    $(document).on('click','.editar', function (e) {
        const datos = {
            id: $(this).val(),
            operacion: 'MostrarEditar'
        };
                     
        $.post('../../Controller/user.controlador.php',datos, function (respuesta) {
            $.each(JSON.parse(respuesta), function(index, val) {
                $('#primer_nombre').val(val.primer_nombre);
                $('#segundo_nombre').val(val.segundo_nombre);
                $('#primer_apellido').val(val.primer_apellido);
                $('#segundo_apellido').val(val.segundo_apellido);
                $('#correo').val(val.correo);
                $('#celular').val(val.num_celular);
                $('#tipo_doc').val(val.tipo_documento);
                $('#num_doc').val(val.num_documento);
                $('#cod_contrato').val(val.codigo_contrato);
                $('#user').val(val.usuario);
                $('#password').val(val.password);
                $('#empresa').val(val.nombre_empresa);
                $('#id').val(val.id_persona+"-"+val.id_usuario+"-"+val.id_empresa);
                $('#btn_registrar').val('Actualizar');
            });
        
        });
            
      
    });

    $(document).on('click', '.eliminar', function (event) {
        const datos = {
            id: $(this).val(),
            operacion: 'Eliminar'
        };
        alertify.confirm("Esta seguro de realizar los cambios", function (e) {            
            if (e) {                
                $.post('../../Controller/user.controlador.php',datos, function (respuesta) {

                    if (respuesta == '1') {
                        alertify.success('Se elimino el gerente junto con su empresa!');
                    }else{
                        alertify.error('Error a el eliminar los datos');
                    }
                    mostrarTabla();
                   
                })
            }else {
                alertify.error('Hubo un error al actualizar los datos');
            }
        });
        event.preventDefault();
    });
      

    function limpiar() {
        $('#primer_nombre').val('');
        $('#segundo_nombre').val('');
        $('#primer_apellido').val('');
        $('#segundo_apellido').val('');
        $('#correo').val('');
        $('#celular').val('');
        $('#tipo_doc').val('');
        $('#num_doc').val('');
        $('#cod_contrato').val('');
        $('#user').val('');
        $('#password').val('');
        $('#empresa').val('');
        $('#id').val('');
        $('#btn_registrar').val('Registrar');
    }

    

});