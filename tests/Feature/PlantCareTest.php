<?php

use App\Models\Plant;

beforeEach(function () {
    $this->plants = Plant::factory(3)->create(['room' => 'Office']);
});

it('shows the dashboard with plant stats', function () {
    $this->get(route('dashboard'))
        ->assertOk()
        ->assertSee('Dashboard')
        ->assertSee('Plants')
        ->assertViewHas('totalPlants', 3);
});

it('lists all plants and filters them', function () {
    $plant = Plant::factory()->create(['name' => 'Monstera', 'species' => 'Monstera deliciosa', 'room' => 'Living room']);

    $this->get(route('plants.index', ['q' => 'monst', 'room' => 'Living room']))
        ->assertOk()
        ->assertSee($plant->name)
        ->assertViewHas('plants', fn ($plants) => $plants->count() === 1);
});

it('shows a single plant with its watering details', function () {
    $this->get(route('plants.show', $this->plants->first()))
        ->assertOk()
        ->assertSee($this->plants->first()->name)
        ->assertSee('Watering interval');
});

it('creates a plant from validated request data', function () {
    $this->post(route('plants.store'), [
        'name' => 'Peace Lily',
        'species' => 'Spathiphyllum wallisii',
        'room' => 'Bedroom',
        'water_every_days' => 5,
        'last_watered_at' => now()->subDays(2)->toDateString(),
        'notes' => 'Brown tips mean too much tap water.',
    ])->assertRedirect();

    $this->assertDatabaseHas('plants', [
        'name' => 'Peace Lily',
        'room' => 'Bedroom',
        'water_every_days' => 5,
    ]);
});

it('rejects invalid plant data', function () {
    $this->post(route('plants.store'), [
        'name' => '',
        'species' => '',
        'room' => '',
        'water_every_days' => 0,
    ])->assertSessionHasErrors(['name', 'species', 'room', 'water_every_days']);

    $this->assertDatabaseCount('plants', 3);
});

it('updates a plant', function () {
    $plant = $this->plants->first();

    $this->put(route('plants.update', $plant), [
        'name' => 'Renamed plant',
        'species' => $plant->species,
        'room' => 'Office',
        'water_every_days' => 10,
    ])->assertRedirect(route('plants.show', $plant));

    $this->assertDatabaseHas('plants', [
        'id' => $plant->id,
        'name' => 'Renamed plant',
        'room' => 'Office',
    ]);
});

it('marks a plant as watered', function () {
    $plant = Plant::factory()->thirsty()->create();

    $this->post(route('plants.water', $plant))
        ->assertRedirect(route('plants.show', $plant));

    $this->assertTrue($plant->fresh()->last_watered_at->isToday());
    expect($plant->fresh()->isThirsty())->toBeFalse();
});

it('deletes a plant', function () {
    $plant = $this->plants->first();

    $this->delete(route('plants.destroy', $plant))
        ->assertRedirect(route('plants.index'));

    $this->assertDatabaseMissing('plants', ['id' => $plant->id]);
});

it('shows the tips page', function () {
    $this->get(route('tips'))
        ->assertOk()
        ->assertSee('Plant tips');
});
