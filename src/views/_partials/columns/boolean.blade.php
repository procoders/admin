<?php
        $id = uniqid();
?>
@if ($value === true)
    @if ($editable === true)
        <td data-search="1" class="editable-column editable editable-click {{$name}}-bool-field" data-type="address" data-inline-tpl-path="/admin/{{$modelName}}s/{{$attributes['id']}}/inline_edit/{{$name}}">
            <span id="{{$id}}-link" class="editable-link"><a href="javascript: showInlineEditForm('{{$id}}', '/admin/{{$modelName}}s/{{$attributes['id']}}/inline_edit/{{$name}}');" class="editable-column editable editable-click" ><i class="fa fa-check" style="color: #2b542c;"></i></a></span>
            <span id="{{$id}}-content" class="editable-content"></span>
        </td>
    @else
        <td>
            <i class="fa fa-check" style="color: #2b542c;"></i>
        </td>
    @endif
@else
    @if ($editable === true)
        <td data-search="0" class="editable-column editable editable-click {{$name}}-bool-field" data-type="address" data-inline-tpl-path="/admin/{{$modelName}}s/{{$attributes['id']}}/inline_edit/{{$name}}">
            <span id="{{$id}}-link" class="editable-link"><a href="javascript: showInlineEditForm('{{$id}}', '/admin/{{$modelName}}s/{{$attributes['id']}}/inline_edit/{{$name}}');"><i class="fa fa-check" style="color: #2b542c;"></i></a></span>
            <span id="{{$id}}-content" class="editable-content"></span>
        </td>
    @else
        <td data-search="0">
            <i class="fa fa-check" style="color: #2b542c;"></i>
        </td>
    @endif
@endif

@if ($value === true)
<script>

    var showInlineEditForm = function(id, url) {
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
                $('.inline-edit-undo').on('click', function() {
                    $('#' + id + '-link').show();
                    $('#' + id + '-content').html('');
                })
            }
        })
    };

    var inlineFormSubmit = function(event, id) {
        event.preventDefault();
        var form = $('#' + id);
        var params = form.serializeArray();
        var frmParams = {};
        var contentId = form.data('element-id');
        $(params).each(function(key, value) {
           frmParams[value.name] = value.value;
        });

        $('#' + contentId + '-content').html('<div class="editableform-loading"></div>');

        $.ajax({
            type: "POST",
            url: form.attr('action'),
            data: frmParams,
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            success: function(data){
                if (data.errors == false) {

                }
                $('#' + contentId + '-link').show();
                $('#' + contentId + '-content').html('<span style="color: red; margin-left: 10px;">Error</span>');
            },
            failure: function(errMsg) {
                $('#' + contentId + '-link').show();
                $('#' + contentId + '-content').html('<span style="color: red; margin-left: 10px;">Error</span>');
            }
        });
/*
        $.post(form.attr('action'), frmParams, function(response) {
            $('#' + contentId + '-content').hide();
            $('#' + contentId + '-link').show();
            $('#' + contentId + '-link').html('');
        }, 'json');*/
        return false;
    };

</script>
    <?php
    AssetManager::addStyle('admin::css/bootstrap-editable.css');
    ?>
@endif