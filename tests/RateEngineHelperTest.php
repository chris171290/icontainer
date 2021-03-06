<?php

namespace Tests;

class RateEngineHelperTest extends TestCase
{

    protected function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub

    }

    public function testGetTotalPriceCarrierXmlAndMustReturnFloat ()
    {
        $result = getTotalPriceCarrierXml('esbcn','esmus','2');
        $this->assertIsFloat($result);

    }

    public function testGetTotalPriceCarrierXmlWithIncorrectOriginAndMustReturnZero (){
        $result = getTotalPriceCarrierXml('esbcn','emus','2');
        $this->assertEquals(0,$result);
    }

    public function testGetTotalPriceCarrierJsonAndMustReturnFloat ()
    {
        $result = getTotalPriceCarrier('esbcn','esmus','1');

        $this->assertIsFloat($result);

    }

    public function testGetTotalPriceCarrierJsonWithIncorrectOriginAndMustReturnZero (){
        $result = getTotalPriceCarrier('esbcn','emus','1');
        $this->assertEquals(0,$result);
    }

}
