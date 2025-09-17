<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Item;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Category::factory(5)->create()->each(function ($cat) {
            Item::factory(10)->make()->each(function ($item) use ($cat) {
                $cat->items()->create($item->toArray());
            });
        });
    }
}
