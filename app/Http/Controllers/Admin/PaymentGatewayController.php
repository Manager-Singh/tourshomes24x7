<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PaypalInfo;
use App\Models\StripeInfo;
use App\Traits\ENVFilePutContent;
use App\ViewModels\IPaymentModel;
use Illuminate\Http\Request;

class PaymentGatewayController extends Controller
{
    use ENVFilePutContent;

    private $_paymentModel;

    public function __construct(IPaymentModel $model)
    {
        $this->_paymentModel = $model;
    }

    public function index()
    {
        $setting_paypal  = PaypalInfo::latest()->first();
        $setting_strip  = StripeInfo::latest()->first();
        return view('admin.payments.index',compact('setting_paypal','setting_strip'));
    }

    public function checkoutPage(Request $request)
    {
        $paymentInfo = request()->all();
        $user = auth()->user();
        $paymentInfo['amount'] = (int) $paymentInfo['price'];

        return view('admin.checkout',compact('paymentInfo','user'));
    }

    public function payment(Request $request)
    {
        $this->_paymentModel->initialize($request);

        notify()->success('Payment has been successfully processed');
        return redirect()->route('admin.credits.index');
    }

    public function paymentPaypal(Request $request)
    {
        return $this->_paymentModel->initialize($request);
    }

}
