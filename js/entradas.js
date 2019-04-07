//llenar productos según categoría
var medicamentos = {}; //lista de medicamentos obtenidos según categoría
var carrito = []; //medicametos en el carrito
total = 0; //total a pagar del carrito

//Obtiene los medicamentos según la categoría seleccionada
function get_medicamentos() {
  idCat = $('#ddl_cat option:selected').val();
  if (idCat > 0) {

    $.ajax({
      url: 'includes/functions/CRUD_entradas.php',
      type: 'POST',
      data: "getmeds=yes&idcat=" + idCat,
      success: function (res) {
        //alert(res);
        medicamentos = JSON.parse(res);
        var ddl_med = $('#ddl_med');
        ddl_med.empty();
        ddl_med.append('<option selected disabled>Seleccione un medicamento</option>');
        $.each(medicamentos, function (key, value) {
          ddl_med.append('<option value=' + key + '>' + value.med + '</option>');
        });
      },
      error: function (res) {
        var ddl_med = $('#ddl_med');
        ddl_med.empty();
        ddl_med.append('<option selected disabled>Seleccione un medicamento</option>');
        alert("se produjo un error");
      }
    });
  }
}

//agregar el medicamento a la tabla y a la variable carrito
function agg_med() {
  id_cat = $('#ddl_cat option:selected').val();
  cat = $('#ddl_cat option:selected').text();

  id_med = $('#ddl_med option:selected').val();
  med = $('#ddl_med option:selected').text();

  cant = $('#txtCant').val();

  med_precio = get_precio(id_med);
  subtotal = med_precio * cant;

  if (med != '' && cant > 0 && validarR(med) == false) {
    boton = '<td align="center">' +
      '<button class="btn btn-danger btn-circle btn-sm" onclick="eliminar(' + id_med + ')">' +
      '<i class="fas fa-trash"></i></button></td>';
    carrito.push({ id: id_med, med: med, cant: cant, precio: med_precio, subtotal: subtotal });
    $('#lista').append('<tr id="item' + id_med + '"> <td>' + med + '</td> <td>' + cat + '</td> <td>' + cant + '</td> <td>$' + med_precio + '</td> <td>$' + subtotal + '</td>' + boton + '</tr>');
    total += subtotal;
    $('#lblTotal').text('Total: $' + parseFloat(total).toFixed(2));
    $('#txtCant').val('');
  } else alert('Llene los campos correctamente y no repita productos, o no hay suficientes productos');
}

//devuelve el precio según el ID del medicamento
function get_precio(_id) {
  return parseFloat(medicamentos[_id].precio);
}

//valida que no se agregue medicamentos repetidos
function validarR(_med) {
  let encontrado = false;
  carrito.forEach(function (med) {
    if (med.med == _med) {
      encontrado = true;
    }
    console.log(med.med);
  });
  return encontrado;
}

//elimina del carrito y recalcula el total
function eliminar(_id) {
  jQuery('#item' + _id).remove();
  carrito.forEach(function (med, index) {
    if (med.id == _id) {
      total -= med.precio * med.cant;
      carrito.splice(index, 1);
    }
    $('#lblTotal').text('Total: $' + parseFloat(total).toFixed(2));
  });
}

//función que hace el post y agrega entrada
function finalizar() {
  if (carrito.length > 0) {
    carrito.push({ total: total });
    //alert(JSON.stringify(carrito));
    $.ajax({
      url: 'includes/functions/CRUD_entradas.php',
      type: "POST",
      data: 'agg_entrada=' + JSON.stringify(carrito),
      success: function (res) {
        //alert(res);
        if (res == "EXITO") {
          alert("Inventario actualizado");
          setTimeout('window.location.reload()', 1000);
        }
      }
    });

  } else alert('Ingrese almenos un medicamento');
}