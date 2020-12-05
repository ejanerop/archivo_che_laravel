
$('.filterSelect').select2();
$("[data-mask]").inputmask();
$('#filterByStage').on('ifChecked',function () {
    var stages = $('select#stages');
    var dateEnd = $('input#dateEnd');
    var dateStart = $('input#dateStart');
    stages.attr("disabled", false);
    dateEnd.attr("disabled", true);
    dateStart.attr("disabled", true);
    $('#filterByDate').iCheck('uncheck');
    stages.removeAttr("value");
    dateEnd.attr("value", "");
    dateStart.attr("value", "");
});
$('#filterByStage').on('ifUnchecked',function () {
    var stages = $('select#stages');
    var dateEnd = $('input#dateEnd');
    var dateStart = $('input#dateStart');
    stages.attr("disabled", true);
    stages.removeAttr("value");
});

$('#filterByDate').on('ifChecked',function () {
    var stages = $('select#stages');
    var dateEnd = $('input#dateEnd');
    var dateStart = $('input#dateStart');
    dateEnd.attr("disabled", false);
    dateStart.attr("disabled", false);
    $('#filterByStage').iCheck('uncheck');
    stages.removeAttr("value");
});

$('#filterByDate').on('ifUnchecked',function () {
    var stages = $('select#stages');
    var dateEnd = $('input#dateEnd');
    var dateStart = $('input#dateStart');
    dateEnd.attr("disabled", true);
    dateStart.attr("disabled", true);
    if (!this.checked) {
        stages.removeAttr("value");
    }else{
        dateEnd.attr("value", "");
        dateStart.attr("value", "");
    }
});
