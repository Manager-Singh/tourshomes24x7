<?php
namespace App\Services;

use App\Payment\IPayment;
use App\Payment\IPayPalPayment;
use App\Payment\IStripePayment;

class PaymentService
{
    private $_payPalPayment;
    private $_stripePayment;
    public function __construct(IPayPalPayment $payPalPayment, IStripePayment $stripePayment)
    {
        $this->_payPalPayment = $payPalPayment;
        $this->_stripePayment = $stripePayment;
    }

    public function initialize($data)
    {
        $paymentType = $data['payment_type'];

        switch ($paymentType)
        {
            case 'stripe':
                return $this->_stripePayment->pay($data);
                break;
            case 'paypal':
                return $this->_payPalPayment->pay($data);
                break;
            default:
                return redirect()->back();
        }
    }

    
}
