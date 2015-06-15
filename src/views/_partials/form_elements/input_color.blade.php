<div class="form-group">
    <label class="col-md-2 control-label">{{$label}}</label>

    <div class="col-md-10">
        <div class="input-group colorpicker-component" data-color="{{$value}}" data-color-format="rgb" id="'#'+'{{$options['id']}}" data-colorpicker-guid="2">
            <input type="text" value="{{$value}}" name="{{$name}}" @foreach ($options as $key => $option) {{$key}}="{{$option}}" @endforeach class="form-control" />
            <span class="input-group-addon">
                <i style="background-color: {{$value}};" id="{{$options['id']}}-color"></i>
            </span>
        </div>
    </div>

    <script>
        $(document).ready(function(){
            $('#'+'{{$options['id']}}').colorpicker({format: 'hex'});
            $('#'+'{{$options['id']}}').on('change', function() {
                $('#'+'{{$options['id']}}-color').css('background-color', $(this).val());
            });
        });
    </script>
</div>