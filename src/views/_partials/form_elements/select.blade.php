@if (isset($options['inline-edit']) && $options['inline-edit'] === true)
    <div class="form-group">
        <label class="control-label">{{$label}}</label>
        <div>
            <select class="form-control selectpicker" data-size="10" data-live-search="true" data-style="btn-white" name="{{$name}}" id="{{$id}}">
                @foreach ($list as $option => $optionTitle)
                    <option value="{{$option}}" @if ($option == $value) selected="selected" @endif>{{$optionTitle}}</option>
                @endforeach
            </select>
        </div>
    </div>
@else
<div class="form-group">
    <label class="control-label col-md-2">{{$label}}</label>
    <div class="col-md-10">
        <select class="form-control selectpicker" data-size="10" data-live-search="true" data-style="btn-white" name="{{$name}}" id="{{$id}}">
            @foreach ($list as $option => $optionTitle)
                <option value="{{$option}}" @if ($option == $value) selected="selected" @endif>{{$optionTitle}}</option>
            @endforeach
        </select>
    </div>
</div>
@endif