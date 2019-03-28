function agregaformP(nombre,id){

    $('#nombreP').val(nombre);
    $('#id_pre').val(id);
}

function actualizaPre(){


	id=$('#id_pre').val();
	nombre=$('#nombreP').val();


	cadena= "pre_id="+id +
	        "&pre_nombre=" + nombre;

	$.ajax({
		type:"POST",
		url:"includes/functions/actualizar_presentacion.php",
		data:cadena,
		success:function(r){
			alert(cadena);
 window.location.reload(); 


			}
		
	});

}