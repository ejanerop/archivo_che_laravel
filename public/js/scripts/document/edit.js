
$('select#subtopics').select2();
$('select#access_level').select2();
$('select#document_type').select2();
$('select#date_type').select2();
$('select#author').select2();
$('li.li').removeClass('active');
$('li#document').addClass('active');
$('li#documentCreate').addClass('active');

$("[data-mask]").inputmask();

$('#hasFacsim').on('ifToggled',function () {
    $('input#facsim').attr("disabled", !this.checked);
});


function toggleDate() {
    var dayStart = $('input#dayStart');
    var dayEnd = $('input#dayEnd');
    var monthStart = $('select#monthStart');
    var monthEnd = $('select#monthEnd');
    var yearStart = $('input#yearStart');
    var yearEnd = $('input#yearEnd');
    var optSelected = $('.optDate:selected');
    var date_end = $('div#date_end');

    if (optSelected.attr('id') == 'full_date') {
        dayStart.attr("disabled", false);
        monthStart.attr("disabled", false);
        date_end.addClass('hidden');
    }else if (optSelected.attr('id') == 'month_year') {
        dayStart.val("");
        dayStart.attr("disabled", true);
        monthStart.attr("disabled", false);
        yearStart.attr("disabled", false);
        date_end.addClass('hidden');
    }else if (optSelected.attr('id') == 'year') {
        dayStart.val("");
        dayStart.attr("disabled", true);
        monthStart.attr("disabled", true);
        yearStart.attr("disabled", false);
        date_end.addClass('hidden');
    }else if (optSelected.attr('id') == 'lapse') {
        date_end.removeClass('hidden');
        dayStart.attr("disabled", false);
        monthStart.attr("disabled", false);
        dayEnd.attr("disabled", false);
        monthEnd.attr("disabled", false);

    }else{
        date_end.removeClass('hidden');
        dayStart.attr("disabled", true);
        monthStart.attr("disabled", true);
        dayEnd.attr("disabled", true);
        monthEnd.attr("disabled", true);

    }
}

function modifyResource() {
    var inputResources = $('input#resource');
    var descResources = $('textarea#resource_description');
    var optSelected = $('.opt:selected');
    var hasFacsim = $('#hasFacsim');
    var facsim = $('input#facsim');
    var type = $('input#type');
    if(optSelected.hasClass('Texto')){
        hasFacsim.iCheck('enable');
        hasFacsim.iCheck('uncheck');
        inputResources.attr("accept", "application/pdf");
        type.attr('value', 'text');
    }else{
        inputResources.attr("disabled", false);
        descResources.attr("disabled", false);
        hasFacsim.iCheck('disable');
        facsim.attr('disabled', 'disabled');
        if(optSelected.hasClass('Imagen')){
            inputResources.removeAttr('accepts');
            inputResources.attr("accept", "image/*");
            type.attr('value', 'image');
        }else if (optSelected.hasClass('Audio')) {
            inputResources.removeAttr('accepts');
            inputResources.attr("accept", "audio/*");
            type.attr('value', 'audio');
        }else {
            inputResources.removeAttr('accepts');
            inputResources.attr("accept", "video/*");
            type.attr('value', 'video');
        }
    }
}

modifyResource();
toggleDate();

$('#docCreate').validate({
    rules: {
        name:{
            required: true,
            minlength: 3,
            maxlength: 255
        },
        description: {
            maxlength: 255
        },
        date: {
            required: true
        }
    },
    messages: {}
});

function toggleTab(tab) {
    var tab1 = $('#li1');
    var tab2 = $('#li2');
    var tab3 = $('#li3');
    switch (tab) {
        case 1:
        tab1.addClass('active');
        tab2.removeClass('active');
        tab3.removeClass('active');
        break;
        case 2:
        tab1.removeClass('active');
        tab2.addClass('active');
        tab3.removeClass('active');
        break;
        case 3:
        tab1.removeClass('active');
        tab2.removeClass('active');
        tab3.addClass('active');
        break;
    }

}


