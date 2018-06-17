 $(document).ready(function(){
        $(".basic-multiple").select2({
            placeholder: 'Hacer click para elegir profesiones...',
            //maximumSelectionLength:7, <-- total elementos seleccionables
            closeOnSelect: false 
        });

        $("#idFecha").datepicker({
        changeMonth: true,
        changeYear: true,
        regional: "es",
        yearRange: '1918:2018',
        showAnim: 'clip',
        });
    });