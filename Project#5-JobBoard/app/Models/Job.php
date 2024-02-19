<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model {
    use HasFactory;

    public static array $experience = ['entry' , 'intermediate' , 'senior'];
    // we set which experiences types exits, and because it is static, we can access from the migration.
    public static array $category = ['IT','Finance','Sales','Marketing'];

}
