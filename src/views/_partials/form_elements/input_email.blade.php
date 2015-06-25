<div class="form-group">
    <label class="col-md-2 control-label">{{$label}}</label>
    <div class="col-md-10">
        <input type="text" value="{{$value}}" name="{{$name}}" @foreach ($options as $key => $option) {{$key}}="{{$option}}" @endforeach class="form-control @if ($error) parsley-error @endif" />
        @if ($error)
            <ul class="parsley-errors-list filled">
                <li class="parsley-required">{{$error}}</li>
            </ul>
        @endif
    </div>
</div>