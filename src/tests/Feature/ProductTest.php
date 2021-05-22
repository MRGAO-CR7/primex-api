<?php

namespace Tests\Feature;

use App\Models\Product;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use CloudCreativity\LaravelJsonApi\Testing\MakesJsonApiRequests;

class ProductTest extends TestCase
{

    use RefreshDatabase;
    use MakesJsonApiRequests;

    protected function setUp(): void
    {
        parent::setUp();
        $this->resourceType = 'products';
    }

    public function testRead()
    {
        $product = Product::factory()->create();

        $response = $this->doRead($product->id);

        $response->assertStatus(200);

        $responseContent = json_decode($response->getContent(), true);
        $this->assertEquals($product->id, $responseContent['data']['id']);
        $this->assertEquals($product->name, $responseContent['data']['attributes']['name']);
        $this->assertEquals([], $responseContent['data']['relationships']['stocks']['data']);
    }
}
