var showInlineEditForm = function(id, url, field) {
    $('.editable-link').show();
    $('.editable-content').html('');
    $('.editable-content').hide();
    $('#' + id + '-link').hide();
    $('#' + id + '-content').fadeIn(500);
    $('#' + id + '-content').html('<div class="editableform-loading"></div>');
    $.ajax({
        url: url,
        success: function(response) {
            $('#' + id + '-content').html($(response));
            var form = $('#' + id + '-content').find('form');
            form.data('element-id', id);
            form.data('field-code', field);
            $('.inline-edit-undo').on('click', function() {
                $('#' + id + '-link').show();
                $('#' + id + '-content').html('');
                $(window).resize();
            });
            $(window).resize();
        }
    })
};

var inlineFormSubmit = function(event, id) {
    event.preventDefault();
    var form = $('#' + id);
    var parsleyForm = form.parsley();
    var params = form.serializeArray();
    var frmParams = {};
    var contentId = form.data('element-id');
    var field = form.data('field-code');
    $(params).each(function(key, value) {
        frmParams[value.name] = value.value;
    });
    frmParams.field = field;

    if (parsleyForm.validate()) {
        $('#' + contentId + '-content').html('<div class="editableform-loading"></div>');

        $.ajax({
            type: "POST",
            url: form.attr('action'),
            contentType: 'application/json; charset=utf-8',
            dataType: 'json',
            data: JSON.stringify(frmParams),
            success: function (data) {
                if (data.error == false) {
                    $('#' + contentId + '-link').html();

                    if (data.value != 'undefined') {
                        var tmp = $(data.value);
                        if (tmp.length > 0) {
                            $('#' + contentId + '-link').parent('td').html(tmp.html());
                        }
                    }

                    $('#' + contentId + '-content').html('');
                    $('#' + contentId + '-content').hide();
                    $('#' + contentId + '-link').show();
                } else {
                    $('#' + contentId + '-link').show();
                    $('#' + contentId + '-content').html('<span style="color: red; margin-left: 10px;">Error</span>');
                }
                $(window).resize();
            },
            failure: function (errMsg) {
                $('#' + contentId + '-link').show();
                $('#' + contentId + '-content').html('<span style="color: red; margin-left: 10px;">Error</span>');
                $(window).resize();
            }
        });
    }

    return false;
};