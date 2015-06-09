@if (SleepingOwl\Admin\Columns\Column\Control::DELETE_BUTTON == $type)
    <a href="{{$link}}">
        <button class="btn btn-danger delete" type="button">
            <i class="glyphicon glyphicon-trash"></i>
            <span>{{$title}}</span>
        </button>
    </a>
@elseif (SleepingOwl\Admin\Columns\Column\Control::EDIT_BUTTON == $type)
    <a href="{{$link}}">
        <button class="btn btn-warning cancel" type="reset">
            <i class="glyphicon glyphicon-pencil"></i>
            <span>{{$title}}</span>
        </button>
    </a>
@endif

