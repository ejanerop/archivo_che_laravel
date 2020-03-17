
$('.filterSelect').select2();
$("[data-mask]").inputmask();
$('#filterByStage').on('ifToggled',function () {
    var stages = $('select#stages');
    var dateEnd = $('input#dateEnd');
    var dateStart = $('input#dateStart');
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
    var stages = $('select#stages');
    var dateEnd = $('input#dateEnd');
    var dateStart = $('input#dateStart');
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
