

<div class="form-group">
    <label class="col-md-2 control-label">{{$label}}</label>
    <div class="col-md-10">
        <div class="input-group">
            <span class="input-group-addon">{{{ $currency }}}</span>
            <input type="text" value="{{$value}}" name="{{$name}}" @foreach ($options as $key => $option) {{$key}}="{{$option}}" @endforeach class="form-control" />
            <span class="input-group-addon">.00</span>
        </div>
    </div>
</div>