<div class="form-group">
    <label class="col-md-2 control-label">{{$label}}</label>
    <div class="col-md-10">
        <div class="input-group">
            <div class="m-b-15">
                <ul class="inverse" @foreach ($options as $key => $option) {{$key}}="{{$option}}" @endforeach>
                    @foreach ($values as $value)
                        <li>{{$value}}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#{{$options['id']}}').tagit({
            fieldName: '{{$name}}[]',
            beforeTagAdded: function(event, ui) {
                var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                return regex.test(ui.tagLabel);
            }
        });
    });
</script>