<div class="form-group">
    <label class="col-md-2 control-label">{{$label}}</label>
    <div class="col-md-10">
        <textarea name="{{$name}}" id="{{$id}}" @foreach ($options as $key => $option) {{$key}}="{{$option}}" @endforeach rows="10">{{$value}}</textarea>
    </div>
</div>
@if (isset($options['data-editor']) && $options['data-editor'] == SleepingOwl\Admin\Models\Form\FormItem\Textarea::EDITOR_WYSIHTML)
    <script>$(document).ready(function() {$('#{{$id}}').wysihtml5();})</script>
@endif