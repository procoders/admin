<div class="form-group">
    <label class="col-md-2 control-label">{{$label}}</label>
    <div class="col-md-10">
        <textarea name="{{$name}}" id="{{$id}}" @foreach ($options as $key => $option) {{$key}}="{{$option}}" @endforeach rows="10">{{$value}}</textarea>
    </div>
</div>
@if (isset($options['class']) && preg_match('/wysihtml-editor/', $options['class']))
    <?php
        AssetManager::addStyle('admin::css/bootstrap-wysihtml5.css');
        AssetManager::addScript('admin::js/wysihtml5-0.3.0.js');
        AssetManager::addScript('admin::js/bootstrap-wysihtml5.js');
    ?>
    <script>$(document).ready(function() {$('#{{$id}}').wysihtml5();})</script>
@endif