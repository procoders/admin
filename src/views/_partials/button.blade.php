@if (SleepingOwl\Admin\Columns\Column\Control::DELETE_BUTTON == $type)
    <form method="POST" action="{{$link}}" accept-charset="UTF-8" style="display: inline-block;" onsubmit="return confirm('Do you really want to delete this entity?');">
        <input name="_method" type="hidden" value="DELETE" id="_method">
        <input name="_token" type="hidden" value="{{csrf_token()}}" id="_token">
        <button class="btn btn-danger delete" type="submit">
            <i class="glyphicon glyphicon-trash"></i>
            <span>{{$title}}</span>
        </button>
    </form>
@elseif (SleepingOwl\Admin\Columns\Column\Control::EDIT_BUTTON == $type)
    <a href="{{$link}}">
        <button class="btn btn-warning cancel" type="reset">
            <i class="glyphicon glyphicon-pencil"></i>
            <span>{{$title}}</span>
        </button>
    </a>
@endif

