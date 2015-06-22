<div class="form-group">
    <label class="col-md-2 control-label">{{$label}}</label>
    <div class="col-md-10">
        <input type="number" value="{{$value}}" name="{{$name}}" @foreach ($options as $key => $option) {{$key}}="{{$option}}" @endforeach class="form-control @if ($error) parsley-error @endif"/>
        @if ($error)
            <ul class="parsley-errors-list filled">
                <li class="parsley-required">{{$error}}</li>
            </ul>
        @endif
    </div>
    <script>
        $(document).ready(function() {
           $('{{'#' . $options['id']}}').keyup(function(e) {
               if (/\D/g.test(this.value))
                   this.value = this.value.replace(/\D/g, '');
           });
        });
    </script>
</div>