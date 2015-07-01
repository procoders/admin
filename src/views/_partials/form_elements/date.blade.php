<div class="form-group">
    <label class="col-md-2 control-label">{{$label}}</label>
    <div class="col-md-10">
        <div class="input-group date" id="{{$id}}-control" data-date-format="dd.mm.yyyy" data-date-start-date="Date.default">
            <input type="text" name="{{$name}}" class="form-control @if ($error) parsley-error @endif" placeholder="Select Date" value="{{$value}}" id="{{$id}}" @foreach ($options as $key => $option) {{$key}}="{{$option}}" @endforeach />
            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
        </div>
        @if ($error)
            <ul class="parsley-errors-list filled">
                <li class="parsley-required">{{$error}}</li>
            </ul>
        @endif
    </div>
</div>
<script>$(document).ready(function() {$('#{{$id}}-control').datepicker({todayHighlight: true});});</script>