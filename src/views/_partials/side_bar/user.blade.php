@if (!empty(Admin::$instance))
<?php $adm = Admin::$instance; ?>
    @if (!empty($adm->getUserInfoContent()))
    <ul class="nav">
        <li class="nav-profile">
            <div class="info">
                {!! $adm->getUserInfoContent() !!}
            </div>
        </li>
    </ul>
    @endif
@endif