<div class="form-group">
    <label class="col-md-3 control-label">{{$label}}</label>
    <div class="col-md-9">
        <input type="checkbox" value="{{$value}}" name="{{$name}}" @foreach ($options as $key => $option) {{$key}}="{{$option}}" @endforeach />
    </div>
</div>