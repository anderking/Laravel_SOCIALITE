@if (Session::has('sweet_alert.alert'))
<script>
swal({
    text: "{!! Session::get('sweet_alert.text') !!}",
    title: "{!! Session::get('sweet_alert.title') !!}",
    type: "{!! Session::get('sweet_alert.type') !!}",
    showConfirmButton: "{!! Session::get('sweet_alert.showConfirmButton') !!}",
    confirmButtonText: "{!! Session::get('sweet_alert.confirmButtonText') !!}",
    confirmButtonColor: "#AEDEF4"

            // more options
        });
</script>
@endif