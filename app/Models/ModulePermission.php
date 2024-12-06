<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Module;
use App\Models\Permission;

class ModulePermission extends Pivot
{
    use HasFactory;

    protected $table = 'module_permission';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'role_id',
        'module_id', 
        'permission_id', 
    ];

    public function permission()
    {
        return $this->belongsTo(Permission::class, 'permission_id');
    }

    public function module()
    {
        return $this->belongsTo(Module::class, 'module_id');
    }
}
