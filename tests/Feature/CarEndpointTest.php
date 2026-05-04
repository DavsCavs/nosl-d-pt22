<?php

namespace Tests\Feature;

use App\Models\Car;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CarEndpointTest extends TestCase
{
    use RefreshDatabase;

    // --- Home ---

    public function test_home_page_loads(): void
    {
        $this->get('/')->assertStatus(200);
    }

    // --- GET /cars ---

    public function test_cars_listing_loads(): void
    {
        Car::factory()->count(3)->create();

        $this->get('/cars')->assertStatus(200);
    }

    public function test_cars_listing_shows_car_brand(): void
    {
        Car::factory()->create(['brand' => 'Toyota', 'model' => 'Corolla']);

        $this->get('/cars')->assertSee('Toyota');
    }

    public function test_brand_filter_returns_only_matching_cars(): void
    {
        Car::factory()->create(['brand' => 'BMW', 'model' => 'X5']);
        Car::factory()->create(['brand' => 'Audi', 'model' => 'A4']);

        $response = $this->get('/cars?brand=BMW');

        $response->assertSee('BMW')->assertDontSee('Audi');
    }

    public function test_model_filter_returns_only_matching_cars(): void
    {
        Car::factory()->create(['brand' => 'Toyota', 'model' => 'Corolla']);
        Car::factory()->create(['brand' => 'Toyota', 'model' => 'Camry']);

        $response = $this->get('/cars?model=Corolla');

        $response->assertSee('Corolla')->assertDontSee('Camry');
    }

    public function test_year_from_filter_excludes_older_cars(): void
    {
        Car::factory()->create(['brand' => 'Ford', 'model' => 'Focus', 'year' => 2010]);
        Car::factory()->create(['brand' => 'Honda', 'model' => 'Civic', 'year' => 2020]);

        $response = $this->get('/cars?year_from=2015');

        $response->assertSee('Honda')->assertDontSee('Ford');
    }

    public function test_year_to_filter_excludes_newer_cars(): void
    {
        Car::factory()->create(['brand' => 'Ford', 'model' => 'Focus', 'year' => 2010]);
        Car::factory()->create(['brand' => 'Honda', 'model' => 'Civic', 'year' => 2020]);

        $response = $this->get('/cars?year_to=2015');

        $response->assertSee('Ford')->assertDontSee('Honda');
    }

    public function test_price_from_filter_excludes_cheaper_cars(): void
    {
        Car::factory()->create(['brand' => 'Toyota', 'model' => 'Corolla', 'price' => 3000]);
        Car::factory()->create(['brand' => 'BMW', 'model' => 'X5', 'price' => 10000]);

        $response = $this->get('/cars?price_from=8000');

        $response->assertSee('BMW')->assertDontSee('Toyota');
    }

    public function test_price_to_filter_excludes_expensive_cars(): void
    {
        Car::factory()->create(['brand' => 'Toyota', 'model' => 'Corolla', 'price' => 3000]);
        Car::factory()->create(['brand' => 'BMW', 'model' => 'X5', 'price' => 10000]);

        $response = $this->get('/cars?price_to=5000');

        $response->assertSee('Toyota')->assertDontSee('BMW');
    }

    public function test_country_filter_returns_only_matching_country(): void
    {
        Car::factory()->create(['brand' => 'Toyota', 'model' => 'Corolla', 'country' => 'LV']);
        Car::factory()->create(['brand' => 'BMW', 'model' => 'X5', 'country' => 'EE']);

        $response = $this->get('/cars?country=LV');

        $response->assertSee('Toyota')->assertDontSee('BMW');
    }

    public function test_search_filter_matches_brand_and_model(): void
    {
        Car::factory()->create(['brand' => 'Toyota', 'model' => 'Corolla']);
        Car::factory()->create(['brand' => 'BMW', 'model' => 'X5']);

        $response = $this->get('/cars?search=Toyota');

        $response->assertSee('Toyota')->assertDontSee('BMW');
    }

    public function test_sort_by_price_asc_returns_200(): void
    {
        Car::factory()->count(3)->create();

        $this->get('/cars?sort=price_asc')->assertStatus(200);
    }

    public function test_sort_by_year_desc_returns_200(): void
    {
        Car::factory()->count(3)->create();

        $this->get('/cars?sort=year_desc')->assertStatus(200);
    }

    public function test_cars_listing_paginates(): void
    {
        Car::factory()->count(25)->create();

        $response = $this->get('/cars');

        $response->assertStatus(200);
        // 20 per page — page 2 should also work
        $this->get('/cars?page=2')->assertStatus(200);
    }

    // --- GET /cars/{id} ---

    public function test_car_detail_page_loads(): void
    {
        $car = Car::factory()->create(['brand' => 'Audi', 'model' => 'A6']);

        $this->get("/cars/{$car->id}")
            ->assertStatus(200)
            ->assertSee('Audi')
            ->assertSee('A6');
    }

    public function test_car_detail_shows_all_fields(): void
    {
        $car = Car::factory()->create([
            'brand'       => 'Mercedes-Benz',
            'model'       => 'C-Class',
            'year'        => 2019,
            'engine_size' => '2.0L',
            'mileage'     => 75000,
            'price'       => 12000,
            'country'     => 'LT',
        ]);

        $this->get("/cars/{$car->id}")
            ->assertStatus(200)
            ->assertSee('Mercedes-Benz')
            ->assertSee('C-Class')
            ->assertSee('2019')
            ->assertSee('2.0L')
            ->assertSee('12,000');
    }

    public function test_car_detail_returns_404_for_missing_id(): void
    {
        $this->get('/cars/999999')->assertStatus(404);
    }
}
