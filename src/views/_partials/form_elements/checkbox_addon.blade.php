<div class="form-group">
    <label class="col-md-2 control-label">{{$label}}</label>
    <div class="col-md-10">
        <div class="input-group">
            <span class="input-group-addon">
                <input type="hidden" name="{{$name}}" value="0" />
                <input type="checkbox" value="{{$value}}" name="{{$name}}" @foreach ($options as $key => $option) {{$key}}="{{$option}}" @endforeach />
            </span>
            <input type="text" class="form-control" placeholder="" value="{{$addonValue}}" name="{{$name}}-addon">
        </div>
    </div>
</div>