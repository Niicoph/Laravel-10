<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Event extends Model {
    use HasFactory;

    public function user() : BelongsTo {
        return $this->belongsTo(User::class);  // so event belongs to a user
    }

    public function attendees() : HasMany {
        return $this->hasMany(Attendee::class); // so event is an owner of all the attendees
    } 


}
