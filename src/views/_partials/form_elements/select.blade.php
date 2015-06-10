<div class="form-group">
    <label class="control-label col-md-2">{{$label}}</label>
    <div class="col-md-10">
        <select class="form-control selectpicker" data-size="10" data-live-search="true" data-style="btn-white" name="{{$name}}">
            @foreach ($options as $option => $optionTitle)
                <option value="{{$option}}">{{$optionTitle}}</option>
            @endforeach
        </select>
    </div>
</div>