<?php

namespace Tests\Feature;

use Tests\TestCase;

class GetApiTest extends TestCase
{
    // test if the Origin is missing
    // test if the Destination is missing
    // test if the number of containers is missing
    // test if the route response 200 code OK

    public function testIfOriginIsMissing (){
        $this->get('api/v1/quote/rates/{origin}/{destination}/{container}',['origin'=>'esvlc','destination'=>'','container'=>''])
            ->assertStatus(200);



//        $response = $this->json('GET',  'api/v1/quote/rates/{origin}/{destination}/{container}',[],
//                    ['origin'=>'esbcn','destination'=>'esmus','container'=>'1']);


    }



}
