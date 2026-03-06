<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use App\Models\Package;

class AdminPackageTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_create_package()
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $this->actingAs($admin)
            ->post(route('admin.packages.store'), [
                'name' => 'Test Paket',
                'description' => 'Desc',
                'price' => 100000,
            ])
            ->assertRedirect(route('admin.packages.index'));

        $this->assertDatabaseHas('packages', ['name' => 'Test Paket']);
    }

    public function test_admin_can_update_package()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $package = Package::create(['name' => 'Old', 'description' => '', 'price' => 1000]);

        $this->actingAs($admin)
            ->put(route('admin.packages.update', $package->id), [
                'name' => 'Updated',
                'description' => 'Updated desc',
                'price' => 2000,
            ])
            ->assertRedirect(route('admin.packages.index'));

        $this->assertDatabaseHas('packages', ['name' => 'Updated']);
    }

    public function test_admin_can_delete_package()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $package = Package::create(['name' => 'ToDelete', 'description' => '', 'price' => 1000]);

        $this->actingAs($admin)
            ->delete(route('admin.packages.destroy', $package->id))
            ->assertRedirect(route('admin.packages.index'));

        $this->assertDatabaseMissing('packages', ['name' => 'ToDelete']);
    }
}
