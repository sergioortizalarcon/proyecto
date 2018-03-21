$(document).ready( function () {
    $('#efectoTabla').DataTable({
    	"aLengthMenu": [[5, 10, 25, -1], [5, 10, 25, "Todos"]],
        "iDisplayLength": 5
            });
} );