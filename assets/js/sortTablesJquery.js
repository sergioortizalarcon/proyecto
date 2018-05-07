$(document).ready( function () {
    $('#efectoTabla').DataTable({
    	"aLengthMenu": [[10,25,50,100, -1], [10,25,50,100, "Todos"]],
        "iDisplayLength": 6,
        "zeroRecords": "No se ha encontrado nada.",
        "info": "Mostrando página _PAGE_ de _PAGES_",
        "infoEmpty": "No hay registros disponibles",
        "infoFiltered": "(filtrado de los registros totales de _MAX_)"
        });
} );