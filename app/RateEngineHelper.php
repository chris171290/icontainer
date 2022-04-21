<?php

use Carbon\Carbon;

if(!function_exists('searchByPort')){
  function searchByPort(string $isoCode){
    $ports = json_decode(file_get_contents(app_path('ports.json')),true);
    $portName  = "";
    foreach ($ports as $item) {
        if ($item["iso_code"] == strtoupper($isoCode) ){
            $portName = $item["name"];
            break;
        }
    }
    return $portName;
  }
}

if(!function_exists('getTotalPriceCarrierXml')) {
    function getTotalPriceCarrierXml(string $origin, string $destination, string $container):float
    {
        $xmlString = file_get_contents(app_path('carrier-xml.xml'));
        $xmlObject = simplexml_load_string($xmlString);
        $jsonCarrierXML = json_encode($xmlObject);
        $jsonCarrierArrayXML = json_decode($jsonCarrierXML, true);

        $totalCarrierXML = 0;

        foreach ($jsonCarrierArrayXML["route"] as $item) {
            $expiration_date = Carbon::createFromFormat('Y-m-d', $item["expiration_date"]);
            $today = Carbon::now()->format('Y-m-d');
            if (strtolower($item["origin_port"]) == strtolower($origin)
                && strtolower($item["destination_port"]) == strtolower($destination)
                && $expiration_date->gt($today)) {
                $totalCarrierXML = calculateTotalCarrier($item["price_per_container"], $container);
                break;
            }
        }

        return $totalCarrierXML;
    }
}

if(!function_exists('getTotalPriceCarrier')) {
    function getTotalPriceCarrier(string $origin, string $destination, string $container): float
    {
        $totalCarrierJSON = 0;

        $jsonCarrierJSON = json_decode(file_get_contents(app_path('carrier-json.json')), true);

        foreach ($jsonCarrierJSON as $item) {

            $expiration_date = Carbon::createFromTimestamp($item["max_date"]);
            $today = Carbon::now()->format('Y-m-d');
            if ($item["origin"] == $origin && $item["destination"] == $destination && $expiration_date->gt($today)) {
                $totalCarrierJSON = calculateTotalCarrier($item["price_per_container"], $container);
                break;
            }
        }
        return $totalCarrierJSON;
    }
}

if(!function_exists('calculateTotalCarrier')) {
    function calculateTotalCarrier(int $containerPrice, int $totalContainers): float
    {
        return (float)$totalContainers * $containerPrice;
    }
}
