<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubMenu extends Model
{
    use HasFactory;

    protected $fillable = ['name','display_name', 'type', 'menu_id','route_name'];

    // Relationship with Menu
    public function menu()
    {
        return $this->belongsTo(Menu::class);  // Ensure SubMenu belongs to a Menu
    }
}
