<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model {
    use HasFactory;

    // Defines the relationship between a review and its book
    public function book() {
        return $this->belongsTo(Book::class);
    }
}
