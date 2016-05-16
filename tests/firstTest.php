<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class homeTest extends TestCase
{
    /**
     * Testing to see if some pages respond.
     *
     * @return void
     */
    public function testExample()
    {      

             // test to see if redirected since no login.
	        $response = $this->call('GET', '/badurlthatisnotreal');          
	  		$this->assertEquals(404, $response->status());

    }
}
