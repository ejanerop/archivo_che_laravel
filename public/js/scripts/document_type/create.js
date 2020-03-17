
$('li.li').removeClass('active');
$('li#document_type').addClass('active');
$('li#typeCreate').addClass('active');
$('#doctype').validate({
    rules: {
        document_type: {
            required: true,
            maxlength: 191
        }
    },
    messages: {
        document_type: {
            required: "Debe llenar este campo",
            maxlength: "El tipo de documento no puede exceder los 191 caracteres"
        }
    }
});
