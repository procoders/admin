<?php
        $id = uniqid();
?>
@if ($value === true)
    @if ($editable === true)
        <td data-search="1" class="editable-column editable editable-click {{$name}}-bool-field" data-type="address" >
            <span id="{{$id}}-link"><a href="javascript: showInlineEditForm('{{$id}}', '/admin/hotels_gifts/1/inline_edit/active');" class="editable-column editable editable-click" ><i class="fa fa-check" style="color: #2b542c;"></i></a></span>
            <span id="{{$id}}-content"></span>
        </td>
    @else
        <td>
            <i class="fa fa-check" style="color: #2b542c;"></i>
        </td>
    @endif
@else
    @if ($editable === true)
        <td data-search="0" class="editable-column editable editable-click {{$name}}-bool-field" data-type="address" data-inline-tpl-path="/admin/hotels_gifts/1/inline_edit/active">
            <span id="{{$id}}-link"><a href="javascript: showInlineEditForm('{{$id}}', '/admin/hotels_gifts/1/inline_edit/active';"><i class="fa fa-check" style="color: #2b542c;"></i></a></span>
            <span id="{{$id}}-content"></span>
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
        $.ajax({
            url: url,
            success: function(response) {
                $('#' + id + '-link').hide();
                $('#' + id + '-content').html(response);
                $('#' + id + '-content').fadeIn(500);
            }
        })
    };

    $(document).ready(function() {



        $('#{{$id}}-link').on('click', function() {
            console.log(123);
/*            var url = $(this).data('data-inline-tpl-path');
            $.ajax({
                url: url,
                success: function(response) {
                    $('#{{$id}}-link').hide();
                    $('#{{$id}}-content').html(response);
                    $('#{{$id}}-content').fadeIn(500);
                }
            })*/
        });
    })

</script>
    <?php
    AssetManager::addStyle('admin::css/bootstrap-editable.css');
    ?>
@endif