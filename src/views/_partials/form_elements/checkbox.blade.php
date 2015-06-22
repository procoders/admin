@if (isset($options['inline-edit']) && $options['inline-edit'] === true)
    <div class="form-group">
        <label class="control-label">{{$label}}</label>
        <div>
            <input type="hidden" name="{{$name}}" value="0" />
            <input type="checkbox" value="{{$value}}" name="{{$name}}" @foreach ($options as $key => $option) {{$key}}="{{$option}}" @endforeach />
        </div>
    </div>
@else
<div class="form-group">
    <label class="col-md-2 control-label">{{$label}}</label>
    <div class="col-md-10">
        <input type="hidden" name="{{$name}}" value="0" />
        <label class="@if ($error) parsley-error @endif"><input type="checkbox" value="{{$value}}" name="{{$name}}" @foreach ($options as $key => $option) {{$key}}="{{$option}}" @endforeach /></label>
        @if ($error)
            <ul class="parsley-errors-list filled">
                <li class="parsley-required">{{$error}}</li>
            </ul>
        @endif
    </div>
</div>
@endif