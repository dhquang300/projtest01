<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Wager;
use App\Purchase;

class TaskApiTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }
    
//     public function test_can_create_wager()
//     {
//         $data =[
//             'total_wager_value' => 120000,
//             'odds' => 5,
//             'selling_percentage' => 95,
//             'selling_price' => 100000,
//             'placed_at' => date('Y-m-d H:i:s')
//         ];
        
//         $this->json('POST', '/wagers',$data)
//         ->assertStatus(201)
//         ->assertJson(['data' => $data])
//         ;
//     }
}
