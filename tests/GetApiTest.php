<?php

namespace Tests\Feature;

use Tests\TestCase;

class GetApiTest extends TestCase
{

    public function testRequiredParameters (){
        $this->get('api/v1/quote/rates/{origin}/{destination}/{container}',
            ['origin'=>'','destination'=>'','container'=>''])
            ->assertStatus(200);


    }
    
}
