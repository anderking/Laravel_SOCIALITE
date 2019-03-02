@if (Session::has('sweet_alert.alert'))
    <script>
        swal({!!
        	Session::pull('sweet_alert.alert'),
				  Session::get('sweet_alert.text'),
					Session::get('sweet_alert.type'),
					Session::get('sweet_alert.title'),
					Session::get('sweet_alert.confirmButtonText'),
					Session::get('sweet_alert.showConfirmButton'),
					Session::get('sweet_alert.allowOutsideClick'),
					Session::get('sweet_alert.timer')
        !!});

    </script>
@endif
