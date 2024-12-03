<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ModulePermission extends Pivot
{
    use HasFactory;

    // Define the table name
    protected $table = 'module_permission';  // Ensure this matches the table name in your database

    // Specify the primary key if different from the default
    protected $primaryKey = 'id';  // This is optional, only needed if the pivot table has a custom primary key

    // If the pivot table has extra columns (e.g., timestamps)
    public $timestamps = false;  // Set this to true if you have created_at / updated_at columns

    // You can add any additional attributes you want to be mass assignable
    protected $fillable = [
        'name',
        'module_id', 
        'permission_id', 
        // add any other columns in the pivot table if needed
    ];
}
