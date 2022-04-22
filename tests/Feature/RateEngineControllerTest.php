<?php

namespace Tests\Feature;

use Tests\TestCase;

class RateEngineControllerTest extends TestCase
{

    public function testIfOriginIsMissing (){
        $this->get('api/v1/quote/rates/{origin}/{destination}/{container}',
            ['origin'=>'esvlc','destination'=>'','container'=>'']
        )->assertStatus(200);
    }



}
