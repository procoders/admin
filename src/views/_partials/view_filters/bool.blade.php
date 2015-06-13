<div class="dropdown">
    <select id="{{$id}}" data-live-search="true" data-style="btn-white" name="{{$name}}" class="form-control selectpicker input-sm">
        <option value="">- {{$label}} -</option>
        <option value="{{$trueValue['id']}}">{{$trueValue['name']}}</option>
        <option value="{{$falseValue['id']}}">{{$falseValue['name']}}</option>
    </select>
</div>