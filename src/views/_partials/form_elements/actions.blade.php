@if (isset($groupped) && $groupped == true)
    </div>
    <div class="row">
@endif
<div class="form-group">
    <div style="border: 0; text-align: right;">
        <a href="{{$cancelUrl}}">
        <button type="button" class="btn btn-white m-r-5 m-b-5"><i class="fa fa-undo"></i>&nbsp;&nbsp;{{ Lang::get('admin::lang.table.cancel')}}</button>
        </a>
        <button type="submit" class="btn btn-success m-r-5 m-b-5"><i class="fa fa-floppy-o"></i>&nbsp;&nbsp;{{Lang::get('admin::lang.table.save')}}</button>
    </div>
</div>