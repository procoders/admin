@if (isset($options['inline-edit']) && $options['inline-edit'] === true)
    <div class="form-group">
        <label class="control-label">{{$label}}</label>
        <div>
            <input type="text" name="{{$name}}" class="form-control input-sm" value="{{$value}}">
        </div>
    </div>
@else
<div class="form-group">
    <label class="col-md-2 control-label">{{$label}}</label>
    <div class="col-md-10">
        @if (!empty($actions))
            <div class="input-group">
                <input type="text" value="{{$value}}" name="{{$name}}" @foreach ($options as $key => $option) {{$key}}="{{$option}}" @endforeach class="form-control" />
                <div class="input-group-btn">
                    <ul class="dropdown-menu pull-right">
                        @foreach ($actions as $action)
                            <li><a href="{{$action['link']}}" @if (!empty($action['on-click'])) onclick="{{$action['on-click']}}" @endif >{{$action['title']}}</a></li>
                            @if ($action['separated'] === true) <li class="divider"></li> @endif
                        @endforeach
                    </ul>
                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                        <span class="caret"></span>
                    </button>
                    <button type="button" class="btn btn-primary" @if (!empty($actions[0]['on-click'])) onclick="{{$actions[0]['on-click']}}" @endif>{{$actions[0]['title']}}</button>
                </div>
            </div>
        @else
            <input type="text" value="{{$value}}" name="{{$name}}" @foreach ($options as $key => $option) {{$key}}="{{$option}}" @endforeach class="form-control" />
        @endif
    </div>
</div>
@endif