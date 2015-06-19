<?php
        $id = uniqid();
?>
@if ($value === true)
    @if ($editable === true)
        <td data-search="1" class="editable-column editable editable-click {{$name}}-bool-field" data-inline-tpl-path="/admin/{{$modelName}}s/{{$attributes['id']}}/inline_edit/{{$name}}">
            <span id="{{$id}}-link" class="editable-link">
                <a href="javascript: showInlineEditForm('{{$id}}', '/admin/{{$modelName}}s/{{$attributes['id']}}/inline_edit/{{$name}}', '{{$name}}');">
                    <i class="fa fa-check" style="color: #2b542c;"></i>
                </a>
            </span>
            <span id="{{$id}}-content" class="editable-content"></span>
        </td>
    @else
        <td>
            <i class="fa fa-check" style="color: #2b542c;"></i>
        </td>
    @endif
@else
    @if ($editable === true)
        <td data-search="0" class="editable-column editable editable-click {{$name}}-bool-field" data-inline-tpl-path="/admin/{{$modelName}}s/{{$attributes['id']}}/inline_edit/{{$name}}">
            <span id="{{$id}}-link" class="editable-link">
                <a href="javascript: showInlineEditForm('{{$id}}', '/admin/{{$modelName}}s/{{$attributes['id']}}/inline_edit/{{$name}}', '{{$name}}');">
                    <i class="fa fa-times" style="color: #ec3131;"></i>
                </a>
            </span>
            <span id="{{$id}}-content" class="editable-content"></span>
        </td>
    @else
        <td data-search="0">
            <i class="fa fa-times" style="color: #ec3131;"></i>
        </td>
    @endif
@endif
