<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Wager;
use App\Purchase;

class TaskApiTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_can_create_wager()
    {
        $formData =[
            'total_wager_value' => 10000,
            'odds' => 5,
            'selling_percentage' => 95,
            'selling_price' => 100000,
            'placed_at' => date('Y-m-d H:i:s')
        ];
    
        $this->json('POST','wagers',$formData)
        ->assertStatus(201)
        ->assertJson(['data' => $formData])
        ;
    }
    public function test_can_create_buy()
    {
        $formData =[
            'buying_price' => 120000,
            'wager_id' => 3,
            'bought_at' => date('Y-m-d H:i:s')
        ];
    
        $this->json('POST',route('buy'),$formData)
        ->assertStatus(201)
        ->assertJson(['data' => $formData])
        ;
    }
    
    public function test_can_list_wager()
    {
        $wagers = factory(Wager::class, 3)->make();
        $this->get(route('wagers'))
        ->assertJson(['data'=> $wagers->toArray()])
        ->assertStatus(200);
    }
}
