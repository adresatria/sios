<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_organization',
        'type_organization',
        'address',
        'city',
        'province',
        'npwp_number',
        'npwp_file',
        'phone_number',
        'email_organization',
        'name_pic',
        'pic_phone_number',
        'pic_email',
        'position',
        'created_by',
        'updated_by',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($customer) {
            $customer->created_by = Auth::id();
            $customer->updated_by = Auth::id();
        });

        static::updating(function ($customer) {
            $customer->updated_by = Auth::id();
        });
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
