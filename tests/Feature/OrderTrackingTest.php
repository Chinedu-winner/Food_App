<?php

namespace Tests\Feature;

use App\Models\Order;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrderTrackingTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function owner_can_view_tracking_page_and_status_endpoint()
    {
        $user = User::factory()->create();
        $order = Order::factory()->create(['user_id' => $user->id, 'status' => Order::STATUS_PREPARING]);

        $this->actingAs($user)
             ->get(route('orders.track', $order))
             ->assertStatus(200)
             ->assertSee('Real-time tracking');

        $this->actingAs($user)
             ->getJson(route('orders.status', $order))
             ->assertJson([ 'status' => Order::STATUS_PREPARING ]);
    }

    /** @test */
    public function non_owner_cannot_access_tracking_or_status()
    {
        $user = User::factory()->create();
        $other = User::factory()->create();
        $order = Order::factory()->create(['user_id' => $other->id]);

        $this->actingAs($user)
             ->get(route('orders.track', $order))
             ->assertStatus(403);

        $this->actingAs($user)
             ->getJson(route('orders.status', $order))
             ->assertStatus(403);
    }
}
