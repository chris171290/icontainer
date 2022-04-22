<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RateEngineController extends Controller
{
    public function calculateRate (string $origin,string $destination, string $container): JsonResponse
    {

        $arrayCarrierJSON = array(
            'carrier' => 'JSON',
            'total_price' => getTotalPriceCarrier($origin, $destination, $container),
            'currency'=>'USD');
        $arrayCarrierXML = array(
            'carrier' => 'XML',
            'total_price' => getTotalPriceCarrierXml($origin, $destination, $container),
            'currency'=>'USD');

        return response()->json([
            $arrayCarrierJSON,$arrayCarrierXML
        ]);
    }



}
