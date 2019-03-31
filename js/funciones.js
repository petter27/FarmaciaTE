function agregaformP(nombre,id){

    $('#nombreP').val(nombre);
    $('#id_pre').val(id);
}


function agregaformC(nombre,id){

    $('#cat_nombre').val(nombre);
    $('#cat_id').val(id);
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
 		window.location.reload(); 
			}
		
	});

}

function actualizaCat(){

	id=$('#cat_id').val();
	nombre=$('#cat_nombre').val();


	cadena= "cat_id="+id +
	        "&cat_nombre=" + nombre;

	$.ajax({
		type:"POST",
		url:"includes/functions/actualizar_categoria.php",
		data:cadena,
		success:function(r){
 		window.location.reload(); 


			}
		
	});

}