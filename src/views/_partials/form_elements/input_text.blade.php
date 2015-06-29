@if (isset($options['inline-edit']) && $options['inline-edit'] === true)
    @if (is_null($label))
        <input type="text" name="{{$name}}" @foreach ($options as $key => $option) {{$key}}="{{$option}}" @endforeach class="form-control input-sm" value="{{$value}}">
    @else
        <div class="form-group">
            <label class="control-label">{{$label}}</label>
            <div>
                <input type="text" name="{{$name}}" @foreach ($options as $key => $option) {{$key}}="{{$option}}" @endforeach class="form-control input-sm" value="{{$value}}">
            </div>
        </div>
    @endif
@else
<div class="form-group">
    <label class="col-md-2 control-label">{{$label}}</label>
    <div class="col-md-10">
        @if (!empty($actions))
            <div class="input-group">
                <input type="text" value="{{$value}}" name="{{$name}}" @foreach ($options as $key => $option) {{$key}}="{{$option}}" @endforeach class="form-control @if ($error) parsley-error @endif" />
                @if ($error)
                    <ul class="parsley-errors-list filled">
                        <li class="parsley-required">{{$error}}</li>
                    </ul>
                @endif
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
            <input type="text" value="{{$value}}" name="{{$name}}" @foreach ($options as $key => $option) {{$key}}="{{$option}}" @endforeach class="form-control @if ($error) parsley-error @endif" />
            @if ($error)
                <ul class="parsley-errors-list filled">
                    <li class="parsley-required">{{$error}}</li>
                </ul>
            @endif
        @endif
    </div>
</div>
@endif