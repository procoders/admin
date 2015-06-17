<div class="form-group">
    <label class="col-md-2 control-label">{{$label}}</label>
    <div class="col-md-10">
        <div class="input-group date" id="{{$id}}-control" data-date-format="dd.mm.yyyy" data-date-start-date="Date.default">
            <input type="text" class="form-control" placeholder="Select Date" value="{{$value}}" id="{{$id}}"/>
            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
        </div>
    </div>
</div>
<script>$(document).ready(function() {$('#{{$id}}-control').datepicker({todayHighlight: true});});</script>