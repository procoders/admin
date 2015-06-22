<?php
$id = uniqid();
?>
@if ($editable === true)
    <td data-search="{{$value}}" class="editable-column editable editable-click {{$name}}-bool-field" data-inline-tpl-path="/admin/{{$modelName}}s/{{$attributes['id']}}/inline_edit/{{$name}}">
        <span id="{{$id}}-link" class="editable-link">
            <a href="javascript: showInlineEditForm('{{$id}}', '/admin/{{$modelName}}s/{{$attributes['id']}}/inline_edit/{{$name}}', '{{$name}}');">
                {!! $content !!}
            </a>
        </span>
        <span id="{{$id}}-content" class="editable-content"></span>
    </td>
@else
    <td data-search="{{$value}}">
        {!! $content !!}
    </td>
@endif