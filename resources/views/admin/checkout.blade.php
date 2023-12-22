@extends('admin.main')
@section('content')
<div class="dash-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="act-title">
                    <h5>Select Payment Option :</h5>
                </div>
                <div class="row">
                    <div class="col-4">
                      <div class="list-group" id="list-tab" role="tablist">
                        <a class="list-group-item list-group-item-action active" id="list-home-list" data-toggle="list" href="#list-home" role="tab" aria-controls="home">Stripe</a>
                        <a class="list-group-item list-group-item-action" id="list-profile-list" data-toggle="list" href="#list-profile" role="tab" aria-controls="profile">PayPal</a>
                      </div>
                    </div>
                    <div class="col-8">
                      <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">
                            <div class="card">
                            <div class="card-body">
                                <div class="db-add-listing">
                                    <form role="form" action="{{ route('admin.payment') }}" method="post" class="validation"
                                          data-cc-on-file="false"
                                          data-stripe-publishable-key="{{ env('STRIPE_KEY') }}"
                                          id="payment-form">
                                        @csrf
                                        <input type="hidden" name="package_id" class="user_id" value="{{$paymentInfo['package_id']}}">
                                        <input type="hidden" name="expire_at" class="user_id" value="{{$paymentInfo['expire_at']}}">
                                        <input type="hidden" name="price" class="user_id" value="{{$paymentInfo['price']}}">
                                        <input type="hidden" name="item" class="user_id" value="{{$paymentInfo['item']}}">
                                        <input type="hidden" name="user_id" class="user_id" value="{{$paymentInfo['user_id']}}">
                                        <input type="hidden" name="credited_by" class="credited_by" value="{{$paymentInfo['credited_by']}}">
                                        <input type="hidden" name="amount" class="amount" value="{{$paymentInfo['amount']}}">
                                        <input type="hidden" name="description" class="amount" value="added by {{$paymentInfo['description']}}">
                                        <input type="hidden" name="validity" class="amount" value="added by {{$paymentInfo['validity']}}">
                                        <input type="hidden" name="payment_type" value="stripe">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Name on Card:</label> <span class="text-danger">*</span>
                                                    <input class='form-control' size='4' type='text'>
                                                </div>
                                            </div>
                                            <div class="col-md-6 required">
                                                <div class="form-group">
                                                    <label>Card Number:</label> <span class="text-danger">*</span>
                                                    <input autocomplete='off' class='form-control card-num' size='20' type='text'>
                                                </div>
                                            </div>
                                            <div class="col-md-4 required">
                                                <div class="form-group">
                                                    <label>CVC:</label> <span class="text-danger">*</span>
                                                    <input autocomplete='off' class='form-control card-cvc' placeholder='e.g 415' size='4' type='text'>
                                                </div>
                                            </div>
                                            <div class="col-md-4 required">
                                                <div class="form-group">
                                                    <label>Expiration Month:</label> <span class="text-danger">*</span>
                                                    <input class='form-control card-expiry-month' placeholder='MM' size='2' type='text'>
                                                </div>
                                            </div>
                                            <div class="col-md-4 required">
                                                <div class="form-group">
                                                    <label>Expiration Year:</label> <span class="text-danger">*</span>
                                                    <input class='form-control card-expiry-year' placeholder='YYYY' size='4' type='text'>
                                                </div>
                                            </div>
                                            <div class='col-md-6'>
                                                <div class='col-md-12 hide error form-group'>
                                                    <div class='alert-danger alert'>Fix the errors before you begin.</div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <button class="btn btn-danger btn-lg btn-block" type="submit">
                                                        <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                                                        Pay Now ({{$paymentInfo['amount']}})
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                        </div>
                        <div class="tab-pane fade" id="list-profile" role="tabpanel" aria-labelledby="list-profile-list">
                        <div class="card">
                            <div class="card-body">
                                <div class="db-add-listing">
                                    <form class="w3-container w3-display-middle w3-card-4 " method="POST" id="payment-form"  action="{{url('admin/payment/add-funds/paypal')}}">
                                        @csrf
                                        <input type="hidden" name="package_id" class="user_id" value="{{$paymentInfo['package_id']}}">
                                        <input type="hidden" name="expire_at" class="user_id" value="{{$paymentInfo['expire_at']}}">
                                        <input type="hidden" name="price" class="user_id" value="{{$paymentInfo['price']}}">
                                        <input type="hidden" name="item" class="user_id" value="{{$paymentInfo['item']}}">
                                        <input type="hidden" name="user_id" class="user_id" value="{{$paymentInfo['user_id']}}">
                                        <input type="hidden" name="credited_by" class="credited_by" value="{{$paymentInfo['credited_by']}}">
                                        <input type="hidden" name="amount" class="amount" value="{{$paymentInfo['amount']}}">
                                        <input type="hidden" name="description" class="amount" value="added by {{$paymentInfo['description']}}">
                                        <input type="hidden" name="validity" class="amount" value="added by {{$paymentInfo['validity']}}">
                                        <input type="hidden" name="payment_type" value="paypal">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Enter Amount:</label> <span class="text-danger">*</span>
                                                    <input class="form-control" name="amount" type="text" value="{{$paymentInfo['amount']}}" readonly>
                                                </div>
                                                <button class="btn btn-danger">Pay with PayPal</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        </div>
                      </div>
                    </div>
                  </div>
            </div>
            </div>
    </div>
</div>

@endsection
@push('scripts')
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>

<script type="text/javascript" src="https://js.stripe.com/v2/"></script>

<script type="text/javascript">
    $(function() {
        var $form         = $(".validation");
        $('form.validation').bind('submit', function(e) {
            var $form         = $(".validation"),
                inputVal = ['input[type=email]', 'input[type=password]',
                    'input[type=text]', 'input[type=file]',
                    'textarea'].join(', '),
                $inputs       = $form.find('.required').find(inputVal),
                $errorStatus = $form.find('div.error'),
                valid         = true;
            $errorStatus.addClass('hide');

            $('.has-error').removeClass('has-error');
            $inputs.each(function(i, el) {
                var $input = $(el);
                if ($input.val() === '') {
                    $input.parent().addClass('has-error');
                    $errorStatus.removeClass('hide');
                    e.preventDefault();
                }
            });

            if (!$form.data('cc-on-file')) {
                e.preventDefault();
                Stripe.setPublishableKey($form.data('stripe-publishable-key'));
                Stripe.createToken({
                    number: $('.card-num').val(),
                    cvc: $('.card-cvc').val(),
                    exp_month: $('.card-expiry-month').val(),
                    exp_year: $('.card-expiry-year').val()
                }, stripeHandleResponse);
            }

        });

        function stripeHandleResponse(status, response) {
            if (response.error) {
                $('.error')
                    .removeClass('hide')
                    .find('.alert')
                    .text(response.error.message);
            } else {
                var token = response['id'];
                $form.find('input[type=text]').empty();
                $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
                $form.get(0).submit();
            }
        }

    });
</script>
@endpush
