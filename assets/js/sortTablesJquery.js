$(document).ready( function () {
    $('#efectoTabla').DataTable({
    	language: {
    	"aLengthMenu": [[10,25,50,100, -1], [10,25,50,100, "Todos"]],
        "iDisplayLength": 6,
        "zeroRecords": "No se han encontradon resultados.",
        "info": "Mostrando _PAGE_ de _PAGES_ entradas",
        "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
        "infoFiltered": "(filtrado de los registros totales de _MAX_)",
        'search':'Buscar:',
        "emptyTable": "No hay información",
        "infoPostFix": "",
        "thousands": ",",
        "lengthMenu": "Mostrar _MENU_ Entradas",
        "loadingRecords": "Cargando...",
        "processing": "Procesando...",
        "paginate": {
            "first": "Primero",
            "last": "Ultimo",
            "next": "Siguiente",
            "previous": "Anterior"
        }
    },
	});
    $('#efectoTabla select').addClass('yourclass');
});



