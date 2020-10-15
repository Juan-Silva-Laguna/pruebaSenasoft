$(document).ready(function(){
    mostrarTabla();

    $('#btn_registrar').on('click',function (e) {
        e.preventDefault();
        let datos = {
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
        
        $.post('../../Controller/vendedor.controlador.php', datos, function (respuesta) {
            
           if (respuesta == '1') {
                alertify.success(`Se registro un nuvo gerente con su empresa`);
                
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
        $.post('../../Controller/vendedor.controlador.php', datos, function (respuesta) {
            console.log(respuesta);
            var table = null;                 
            $.each(JSON.parse(respuesta), function(index, val) {
                table += `
                    <tr>
                        <td>${val.codigo_producto}</td>
                        <td>${val.nombre_producto}</td>
                        <td>${val.cantidad} ${val.unidad_medida}</td>
                        <td>${val.precio_unidad}</td>
                        <td>${val.cantidad_inicial}</td>
                        <td>${val.cantidad_entrada}</td>
                        <td>
                            <button type="button" class="btn btn-success btn-sm agregar" value="${val.id_producto}-${val.cantidad} ${val.unidad_medida}-${val.nombre_producto}"  data-toggle="modal" data-target="#modalAgregar">
                                Vender
                            </button> 
                        </td>
                    </tr>               
                `;
            });
            
            $('#tableUserBody').html(table);
        })
    });

    function mostrarTabla(){        
        let operacion = 'Mostrar';   
        $.post('../../Controller/vendedor.controlador.php', {operacion}, function (respuesta) {
            var table = null;               
            $.each(JSON.parse(respuesta), function(index, val) {
                table += `
                    <tr>
                        <td>${val.codigo_producto}</td>
                        <td>${val.nombre_producto}</td>
                        <td>${val.cantidad} ${val.unidad_medida}</td>
                        <td>${val.precio_unidad}</td>
                        <td>${val.cantidad_inicial}</td>
                        <td>${val.cantidad_entrada}</td>
                        <td>
                            <button type="button" class="btn btn-success btn-sm agregar" value="${val.id_producto}-${val.cantidad} ${val.unidad_medida}-${val.nombre_producto}"  data-toggle="modal" data-target="#modalAgregar">
                                Vender
                            </button> 
                        </td>
                    </tr>                
                `;
            });
            
            $('#tableUserBody').html(table);
        })
        .fail(function(){
            alertify.error('No hay datos en la tabla');
        })
    }

    $(document).on('click','.agregar', function (e) {
        let elemento = $(this).val();
        let arreglo = elemento.split('-');
        
        $('#info').val($(this).val());          
        $('#texto_prod').html(arreglo[2]);
        e.preventDefault();
    });
    
    $(document).on('click','#modalNuevo', function (e) {
        let elemento = $(this).val();
        let arreglo = elemento.split('-');
        
        $('#info').val($(this).val());          
        $('#texto_prod').html(arreglo[2]);
        e.preventDefault();
    });    
    
    $(document).on('click','#btn_agregar', function (e) {
        let cant = $('#cant').val();
        
        const datos={
            productos: $('#info').val()+"-"+cant,
            operacion: 'Agregar'
        };
        console.log(datos);
        $.post('../../Controller/vendedor.controlador.php', datos, function (respuesta) {
            alertify.message(respuesta);
            $('#modalAgregar').modal('hide'); 
            $('#cant').val(''); 
            $('#info').val(''); 
        })
        e.preventDefault();
    })

});