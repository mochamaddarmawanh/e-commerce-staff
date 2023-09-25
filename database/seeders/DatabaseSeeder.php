<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Mochamad Darmawan Hardjakusumah',
                'slug' => 'mochamad-darmawan-hardjakusumah',
                'email' => 'mochamaddarmawanh@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'gender' => 'male',
                'role' => 'admin',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Jhon Doe',
                'slug' => 'jhon-doe',
                'email' => 'jhondoe@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'gender' => 'male',
                'role' => 'cashier',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Jessica William',
                'slug' => 'jessica-willian',
                'email' => 'williamjessica@gmail.com',
                'email_verified_at' => null,
                'password' => Hash::make('password'),
                'gender' => 'female',
                'role' => 'customer',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);

        \App\Models\User::factory(50)->create();
        \App\Models\Color::factory(3)->create();
        \App\Models\Tag::factory(6)->create();
        \App\Models\Brand::factory(2)->create();
        \App\Models\Category::factory(4)->create();
        \App\Models\Product::factory(3)->create();

        DB::table('product_colors')->insert([
            [
                'product_id' => 1,
                'color_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'product_id' => 1,
                'color_id' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'product_id' => 1,
                'color_id' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'product_id' => 2,
                'color_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'product_id' => 3,
                'color_id' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);

        DB::table('product_tags')->insert([
            [
                'product_id' => 1,
                'tag_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'product_id' => 1,
                'tag_id' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'product_id' => 1,
                'tag_id' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'product_id' => 2,
                'tag_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'product_id' => 3,
                'tag_id' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);

        DB::table('product_sizes')->insert([
            [
                'product_id' => 1,
                'size_id' => 'xl',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'product_id' => 1,
                'size_id' => 'xxxl',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'product_id' => 1,
                'size_id' => 'xxl',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'product_id' => 2,
                'size_id' => 'l',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'product_id' => 3,
                'size_id' => 'm',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);

        DB::table('discount_min_purchases')->insert([
            [
                'amount_threshold' => 500000,
                'discount_percentage' => 25,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
