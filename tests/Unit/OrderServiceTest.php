<?php

namespace Tests\Unit;

use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use App\Services\OrderService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\TestCase;

class OrderServiceTest extends TestCase
{
    use RefreshDatabase;

    protected OrderService $orderService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->orderService = new OrderService();
    }

    public function test_order_created()
    {
        $customer = Customer::factory()->create();
        $product1 = Product::factory()->create(['price' => 100]);
        $product2 = Product::factory()->create(['price' => 50]);

        $orderData = [
            'customer_id' => $customer->id,
            'products' => [
                ['id' => $product1->id, 'quantity' => 2],
                ['id' => $product2->id, 'quantity' => 3],
            ],
        ];

        $order = $this->orderService->create($orderData);

        $this->assertEquals($order->id, $order['id']);
        $this->assertEquals('processing', $order['status']);
        $this->assertEquals($customer->id, $order['customer']['id']);
        $this->assertCount(2, $order['products']);

        $this->assertEquals(350, $order['total']);
    }
}
