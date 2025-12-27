<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }

    #[Test]
    public function an_authenticated_user_can_create_a_product()
    {
        $response = $this->actingAs($this->user)->post(route('products.store'), [
            'name' => 'Produto Teste',
            'description' => 'Descrição do teste',
            'price' => 100.50,
            'stock_quantity' => 10,
        ]);
        $response->assertRedirectToRoute('dashboard');
        $this->assertDatabaseHas('products', [
            'name' => 'Produto Teste',
            'price' => 100.50
        ]);
    }

    #[Test]
    public function a_product_name_must_be_unique_except_for_itself()
    {
        $product = Product::factory()->create(['name' => 'Produto Original']);
        $response = $this->actingAs($this->user)->put(route('products.update', $product), [
            'name' => 'Produto Original',
            'price' => 200.00,
            'stock_quantity' => 5,
        ]);
        $response->assertRedirectToRoute('dashboard');
        $response->assertSessionHas('success');
    }

    #[Test]
    public function an_authenticated_user_can_delete_a_product()
    {
        $product = Product::factory()->create();

        $response = $this->actingAs($this->user)->delete(route('products.destroy', $product));

        $response->assertRedirectToRoute('dashboard');
        $this->assertDatabaseMissing('products', ['id' => $product->id]);
    }

    #[Test]
    public function unauthenticated_users_cannot_access_dashboard()
    {
        $response = $this->get(route('dashboard'));
        $response->assertRedirect('/login');
    }
}
