@extends('admin::_layout.inner')

@section('innerContent')
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">{{{ $title }}}</h1>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12">
			{!! $form->render() !!}
		</div>
	</div>
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
    </script>

@stop