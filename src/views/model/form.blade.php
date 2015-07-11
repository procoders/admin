@extends('admin::_layout.inner')

@section('innerContent')
    <?php
    AssetManager::addStyle('admin::css/bootstrap-select.min.css');
    AssetManager::addScript('admin::js/bootstrap-select.min.js');
    AssetManager::addScript('admin::js/form-plugins.js');
    ?>

    @if (!empty($form->getGroups()))
            {!! $form->render(true) !!}
    @else
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-inverse">
                    <div class="panel-heading">
                        {{{ $title }}}
                    </div>
                    <div class="panel-body">
                        {!! $form->render() !!}
                    </div>
                </div>
            </div>
        </div>
    @endif
    <script>
        var myFile = document.getElementById("teq");
        if(myFile) {
            myFile.addEventListener('change', function() {
                var max_filesize = 5242880;
                if (this.files[0].size > max_filesize) {
                    $(":submit").attr('disabled', true);
                    $('#filesize_error').remove();
                    $('.clearfix').append('<div style="color: red; clear: both" id="filesize_error">File is too large. File size could not be more than 5 Mb.</div>');
                } else {
                    $('#filesize_error').remove();
                    $(":submit").attr('disabled', false);
                }
            });
        }
        $(document).ready(function() {
            handleSelectpicker();
            window.setInterval(function() {
                $( window ).resize();
            }, 250);
        });
    </script>
@stop