<?php

namespace App\Http\Controllers;

use App\Http\Services\MyFatoorahService;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MyFatoorahController extends Controller
{
    public $fatoorahservice ;
    public function __construct(myFatoorahService $fatoorahService)
    {
        $this->fatoorahservice = $fatoorahService;
    }

    public function pay()
    {
        $data = [
            //Fill required data
            'NotificationOption' => 'Lnk', //'SMS', 'EML', or 'ALL'
            'InvoiceValue'       => '50',
            'CustomerName'       => 'fname lname',
            //Fill optional data
            'DisplayCurrencyIso' => 'KWD',
            //'MobileCountryCode'  => '+965',
            'CustomerMobile'     => '1234567890',
            'CustomerEmail'      => 'email@example.com',
            'CallBackUrl'        => env('SUCCESS_URL'),
            'ErrorUrl'           => env('ERROR_URL'), //or 'https://example.com/error.php'
            'Language'           => 'en', //or 'ar'
            //'CustomerReference'  => 'orderId',
            //'CustomerCivilId'    => 'CivilId',
            //'UserDefinedField'   => 'This could be string, number, or array',
            //'ExpiryDate'         => '', //The Invoice expires after 3 days by default. Use 'Y-m-d\TH:i:s' format in the 'Asia/Kuwait' time zone.
            //'SourceInfo'         => 'Pure PHP', //For example: (Laravel/Yii API Ver2.0 integration)
            //'CustomerAddress'    => $customerAddress,
            //'InvoiceItems'       => $invoiceItems,
        ];

        return  $this->fatoorahservice->sendPayment($data);
    }
}
