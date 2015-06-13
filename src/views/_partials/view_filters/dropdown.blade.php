<div class="dropdown">
    <select id="{{$id}}" data-live-search="true" data-style="btn-white" name="{{$name}}" class="form-control selectpicker input-sm">
        @foreach ($options as $option)
            <option value="{{$option['id']}}"  @if ($option['id'] == $value) selected @endif>{{$option['name']}}</option>
        @endforeach
    </select>
</div>