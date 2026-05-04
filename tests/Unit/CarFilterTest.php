<?php

namespace Tests\Unit;

use App\Models\Car;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CarFilterTest extends TestCase
{
    use RefreshDatabase;

    // --- brand ---

    public function test_filter_by_brand_exact_match(): void
    {
        Car::factory()->create(['brand' => 'Toyota']);
        Car::factory()->create(['brand' => 'BMW']);

        $results = Car::filter(['brand' => 'Toyota'])->get();

        $this->assertCount(1, $results);
        $this->assertEquals('Toyota', $results->first()->brand);
    }

    public function test_filter_by_brand_partial_match(): void
    {
        Car::factory()->create(['brand' => 'Mercedes-Benz']);
        Car::factory()->create(['brand' => 'BMW']);

        $results = Car::filter(['brand' => 'Merc'])->get();

        $this->assertCount(1, $results);
    }

    // --- model ---

    public function test_filter_by_model(): void
    {
        Car::factory()->create(['brand' => 'Toyota', 'model' => 'Corolla']);
        Car::factory()->create(['brand' => 'Toyota', 'model' => 'Camry']);

        $results = Car::filter(['model' => 'Corolla'])->get();

        $this->assertCount(1, $results);
        $this->assertEquals('Corolla', $results->first()->model);
    }

    // --- year ---

    public function test_filter_year_from_excludes_older(): void
    {
        Car::factory()->create(['year' => 2010]);
        Car::factory()->create(['year' => 2018]);
        Car::factory()->create(['year' => 2022]);

        $results = Car::filter(['year_from' => 2015])->get();

        $this->assertCount(2, $results);
        $this->assertTrue($results->every(fn($c) => $c->year >= 2015));
    }

    public function test_filter_year_to_excludes_newer(): void
    {
        Car::factory()->create(['year' => 2010]);
        Car::factory()->create(['year' => 2018]);
        Car::factory()->create(['year' => 2022]);

        $results = Car::filter(['year_to' => 2018])->get();

        $this->assertCount(2, $results);
        $this->assertTrue($results->every(fn($c) => $c->year <= 2018));
    }

    public function test_filter_year_range(): void
    {
        Car::factory()->create(['year' => 2010]);
        Car::factory()->create(['year' => 2015]);
        Car::factory()->create(['year' => 2020]);

        $results = Car::filter(['year_from' => 2013, 'year_to' => 2017])->get();

        $this->assertCount(1, $results);
        $this->assertEquals(2015, $results->first()->year);
    }

    // --- price ---

    public function test_filter_price_from_excludes_cheaper(): void
    {
        Car::factory()->create(['price' => 2000]);
        Car::factory()->create(['price' => 8000]);

        $results = Car::filter(['price_from' => 5000])->get();

        $this->assertCount(1, $results);
        $this->assertEquals(8000, $results->first()->price);
    }

    public function test_filter_price_to_excludes_expensive(): void
    {
        Car::factory()->create(['price' => 2000]);
        Car::factory()->create(['price' => 8000]);

        $results = Car::filter(['price_to' => 5000])->get();

        $this->assertCount(1, $results);
        $this->assertEquals(2000, $results->first()->price);
    }

    public function test_filter_price_range(): void
    {
        Car::factory()->create(['price' => 1000]);
        Car::factory()->create(['price' => 5000]);
        Car::factory()->create(['price' => 12000]);

        $results = Car::filter(['price_from' => 3000, 'price_to' => 9000])->get();

        $this->assertCount(1, $results);
        $this->assertEquals(5000, $results->first()->price);
    }

    // --- country ---

    public function test_filter_by_country_lv(): void
    {
        Car::factory()->create(['country' => 'LV']);
        Car::factory()->create(['country' => 'EE']);
        Car::factory()->create(['country' => 'LT']);

        $results = Car::filter(['country' => 'LV'])->get();

        $this->assertCount(1, $results);
        $this->assertEquals('LV', $results->first()->country);
    }

    public function test_filter_by_country_returns_all_when_empty(): void
    {
        Car::factory()->create(['country' => 'LV']);
        Car::factory()->create(['country' => 'EE']);

        $results = Car::filter([])->get();

        $this->assertCount(2, $results);
    }

    // --- search ---

    public function test_search_matches_brand(): void
    {
        Car::factory()->create(['brand' => 'Audi', 'model' => 'A4']);
        Car::factory()->create(['brand' => 'BMW', 'model' => 'X3']);

        $results = Car::filter(['search' => 'Audi'])->get();

        $this->assertCount(1, $results);
        $this->assertEquals('Audi', $results->first()->brand);
    }

    public function test_search_matches_model(): void
    {
        Car::factory()->create(['brand' => 'Audi', 'model' => 'A4']);
        Car::factory()->create(['brand' => 'BMW', 'model' => 'X3']);

        $results = Car::filter(['search' => 'X3'])->get();

        $this->assertCount(1, $results);
        $this->assertEquals('X3', $results->first()->model);
    }

    public function test_search_matches_year(): void
    {
        Car::factory()->create(['year' => 2015]);
        Car::factory()->create(['year' => 2020]);

        $results = Car::filter(['search' => '2015'])->get();

        $this->assertCount(1, $results);
        $this->assertEquals(2015, $results->first()->year);
    }

    // --- no filters ---

    public function test_empty_filters_returns_all_cars(): void
    {
        Car::factory()->count(5)->create();

        $results = Car::filter([])->get();

        $this->assertCount(5, $results);
    }

    // --- combined filters ---

    public function test_combined_brand_and_country_filter(): void
    {
        Car::factory()->create(['brand' => 'Toyota', 'country' => 'LV']);
        Car::factory()->create(['brand' => 'Toyota', 'country' => 'EE']);
        Car::factory()->create(['brand' => 'BMW',    'country' => 'LV']);

        $results = Car::filter(['brand' => 'Toyota', 'country' => 'LV'])->get();

        $this->assertCount(1, $results);
        $this->assertEquals('Toyota', $results->first()->brand);
        $this->assertEquals('LV', $results->first()->country);
    }
}
