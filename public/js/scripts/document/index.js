
$('#table').DataTable( {
    "paging": false,
    language : {
        "sProcessing":     "Procesando...",
        "sLengthMenu":     "Mostrar _MENU_ registros",
        "sZeroRecords":    "No se encontraron resultados",
        "sEmptyTable":     "Ningún dato disponible en esta tabla =(",
        "sInfo":           "Mostrando del _START_ al _END_ de un total de _TOTAL_ documentos",
        "sInfoEmpty":      "Mostrando del 0 al 0 de un total de 0 registros",
        "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix":    "",
        "sSearch":         "Buscar:",
        "sUrl":            "",
        "sInfoThousands":  ",",
        "sLoadingRecords": "Cargando...",
        "oPaginate": {
            "sFirst":    "Primero",
            "sLast":     "Último",
            "sNext":     "Siguiente",
            "sPrevious": "Anterior"
        },
        "oAria": {
            "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
        },
        "buttons": {
            "copy": "Copiar",
            "colvis": "Visibilidad"
        }
    }
});
$('li.li').removeClass('active');
$('li#document').addClass('active');
$('li#documentList').addClass('active');
$('.filterSelect').select2();
$("[data-mask]").inputmask();
$('a#homeTab').trigger('click');
$('#filterByStage').on('ifToggled',function () {
    var stages = $('select#stagesFilter');
    var dateEnd = $('input#dateEndFilter');
    var dateStart = $('input#dateStartFilter');
    stages.attr("disabled", !this.checked);
    dateEnd.attr("disabled", this.checked);
    dateStart.attr("disabled", this.checked);
    if (this.checked) {
        stages.removeAttr("value");
    }else{
        dateEnd.attr("value", "");
        dateStart.attr("value", "");
    }
});
$('#filterByDate').on('ifToggled',function () {
    var stages = $('select#stagesFilter');
    var dateEnd = $('input#dateEndFilter');
    var dateStart = $('input#dateStartFilter');
    stages.attr("disabled", this.checked);
    dateEnd.attr("disabled", !this.checked);
    dateStart.attr("disabled", !this.checked);
    if (!this.checked) {
        stages.removeAttr("value");
    }else{
        dateEnd.attr("value", "");
        dateStart.attr("value", "");
    }
});
