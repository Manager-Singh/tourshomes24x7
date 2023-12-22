@extends('admin.main')
@section('content')
    <div class="dash-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="db-add-list-wrap">
                        <div class="act-title">
                            <h5>Payment Methods :</h5>
                        </div>
                                @include('admin.payments.stripe-info')
                                @include('admin.payments.paypal-info')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
<script>
    (function($) {
        "use strict";
        //Paypal
        $('#paypalSubmit').on('submit', function (e) {
            e.preventDefault();
            $.ajax({
                url: "{{route('admin.paypal.info.store')}}",
                method: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                success: function (data) {
                    let html = '';
                    if (data.errors) {
                        html = '<div class="alert alert-danger">';
                        for (let count = 0; count < data.errors.length; count++) {
                            html += '<p>' + data.errors[count] + '</p>';
                        }
                        html += '</div>';
                        $('#alert_message').fadeIn("slow");
                        $('#alert_message').html(html);
                        setTimeout(function() {
                            $('#alert_message').fadeOut("slow");
                        }, 3000);
                    }
                    else if(data.success){
                        $('#alert_message').fadeIn("slow"); //Check in top in this blade
                        $('#alert_message').addClass('alert alert-success').html(data.success);
                        setTimeout(function() {
                            $('#alert_message').fadeOut("slow");
                        }, 3000);
                    }
                }
            });
        });

        //Strip
        $('#stripSubmit').on('submit', function (e) {
            e.preventDefault();
            $.ajax({
                url: "{{route('admin.stripe.info.store')}}",
                method: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                success: function (data) {
                    let html = '';
                    if (data.errors) {
                        html = '<div class="alert alert-danger">';
                        for (let count = 0; count < data.errors.length; count++) {
                            html += '<p>' + data.errors[count] + '</p>';
                        }
                        html += '</div>';
                        $('#alert_message').fadeIn("slow");
                        $('#alert_message').html(html);
                        setTimeout(function() {
                            $('#alert_message').fadeOut("slow");
                        }, 3000);
                    }
                    else if(data.success){
                        $('#alert_message').fadeIn("slow"); //Check in top in this blade
                        $('#alert_message').addClass('alert alert-success').html(data.success);
                        setTimeout(function() {
                            $('#alert_message').fadeOut("slow");
                        }, 3000);
                    }
                }
            });
        });
    })(jQuery);
</script>
@endpush
