<div class="form-group">
    <label class="col-md-2 control-label">{{$label}}</label>
    <div class="col-md-10">
        <input type="text" value="{{$value}}" name="{{$name}}" min="{{$minValue}}" max="{{$maxValue}}" class="form-control input-number"/>
    </div>
</div>

<script>$('.input-number').bootstrapNumber({upClass: 'danger', downClass: 'success'});</script>