<div class="form-group">
    <label class="col-md-2 control-label">{{$label}}</label>
    <div class="col-md-10">
        <input type="hidden" name="{{$name}}" value="0" />
        <input type="checkbox" value="{{$value}}" name="{{$name}}" @foreach ($options as $key => $option) {{$key}}="{{$option}}" @endforeach />
    </div>
</div>