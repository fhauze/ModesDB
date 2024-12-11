<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Menu;
use App\Models\Permission;

class MenuPermission extends Pivot
{
    use HasFactory;

    protected $table = 'menu_permission';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'menu_id',
        'role_id', 
        'permission_id', 
    ];

    public function permission()
    {
        return $this->belongsTo(Permission::class, 'permission_id');
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menu_id');
    }
}
