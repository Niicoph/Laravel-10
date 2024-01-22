<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Book;
use App\Models\Review;

class DatabaseSeeder extends Seeder {
   
    public function run(): void {
        Book::factory(33)->create()->each(function($book) { // Create 33 books
            $numReviews = random_int(5, 30);                // Each book will have randomly between 5 and 30 reviews
            Review::factory()->count($numReviews)
                ->good()
                ->for($book)
                ->create();
        });
        Book::factory(33)->create()->each(function($book) { 
            $numReviews = random_int(5, 30);                
            Review::factory()->count($numReviews)
                ->average()
                ->for($book)
                ->create();
        });
        Book::factory(34)->create()->each(function($book) { 
            $numReviews = random_int(5, 30);                
            Review::factory()->count($numReviews)
                ->bad()
                ->for($book)
                ->create();
        });
    }
}
