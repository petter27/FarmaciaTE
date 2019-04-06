function edit_emp(_id) {
	$("#current_emp").val(_id);
	$('#modal_emp_name').val($('#emp_name' + _id).text());
	$('#modal_emp_lname').val($('#emp_lname' + _id).text());
	$('#modal_emp_fecha').val($('#emp_fecha' + _id).text());

	$('#modal_emp_usr option').filter(function () {
		return ($(this).text() == $('#emp_usr' + _id).text()); //To select Blue
	}).prop('selected', true);

}

function agregaformP(nombre, id) {

	$('#nombreP').val(nombre);
	$('#id_pre').val(id);
}


function agregaformC(nombre, id) {

	$('#cat_nombre').val(nombre);
	$('#cat_id').val(id);
}

//mostrar datos modal actualizar medicamento
function agregaformM(nombre, stock, categoria, presentacion, precio_compra, precio_venta, fechaV, id) {

	$('#nombreM').val(nombre);
	$('#stockM').val(stock);
	$('#categoriaM').val(categoria);
	$('#presentacionM').val(presentacion);
	$('#precioCompraM').val(precio_compra);
	$('#precioVentaM').val(precio_venta);
	$('#fechaV').val(fechaV);
	$('#med_id').val(id);
}

function actualizaPre() {

	id = $('#id_pre').val();
	nombre = $('#nombreP').val();


	cadena = "pre_id=" + id +
		"&pre_nombre=" + nombre;

	$.ajax({
		type: "POST",
		url: "includes/functions/actualizar_presentacion.php",
		data: cadena,
		success: function (r) {
			var url = window.location.href.split('?')[0];
			url += "?msgp=Actualizada";
			window.location.href = url;
		}

	});

}

function actualizaCat() {

	id = $('#cat_id').val();
	nombre = $('#cat_nombre').val();


	cadena = "cat_id=" + id +
		"&cat_nombre=" + nombre;

	$.ajax({
		type: "POST",
		url: "includes/functions/actualizar_categoria.php",
		data: cadena,
		success: function (r) {
			var url = window.location.href.split('?')[0];
			url += "?msg=Actualizada";
			window.location.href = url;
		}

	});

}

function actualizaMedicamento() {

	id = $('#med_id').val();
	nombre = $('#nombreM').val();
	stock = $('#stockM').val();
	cat = $('#categoriaM').val();
	presentacion = $('#presentacionM').val();
	p_compra = $('#precioCompraM').val();
	p_venta = $('#precioVentaM').val();
	fecha = $('#fechaV').val();


	cadena = "med_id=" + id +
		"&med_nombre=" + nombre;
	"&med_stock=" + stock;
	"&cat_id=" + cat;
	"&pre_id=" + presentacion;
	"&med_precioC=" + p_compra;
	"&med_precioV=" + p_venta;
	"&med_fechaV=" + fecha;


}

function actualizaUsuario() {

	id = $('#med_id').val();
	nombre = $('#nombreM').val();
	stock = $('#stockM').val();
	cat = $('#categoriaM').val();
	presentacion = $('#pre_id').val();
	p_compra = $('#precioCompraM').val();
	p_venta = $('#med_precioV').val();
	fecha = $('#med_fechaV').val();


	cadena = "med_id=" + id +
		"med_nombre=" + nombre;
	"med_stock=" + stock;
	"pre_id=" + presentacion;
	"med_precioC=" + p_compra;
	"med_precioV=" + p_venta;
	"&med_fechaV=" + fecha;


	$.ajax({
		type: "POST",
		url: "includes/functions/actualizar_medicamento.php",
		data: cadena,
		success: function (r) {
			window.location.reload();

		}

	});

}