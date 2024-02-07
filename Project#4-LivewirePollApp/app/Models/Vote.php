<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vote extends Model {
    use HasFactory;


    public function option() {
        return $this->belongsTo(Option::class);
        // so every Vote will belong to an Option->model
    }


}
