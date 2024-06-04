<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Enums\AdminRoleEnum;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;
use App\Models\Admin;
use App\Models\Product;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        if (Admin::all()->count() == 0) {
            Admin::create([
                "name" => "Super Admin",
                "email" => "admin@gmail.com",
                "email_verified_at" => now(),
                "role_id" => AdminRoleEnum::SUPER_ADMIN->value,
                "image" => '/images/adminProfile.jpg',
                "password" => bcrypt("admin123"),
            ]);
        }
        if (Product::all()->count() == 0) {
            $this->call(ProductSeeder::class);
        }
    }
}
