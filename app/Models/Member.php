<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Member extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "members";
    protected $fillable = [
        'address'
    ];

    public function account()
    {
        return $this->morphOne(Account::class, 'accountable');
    }

    public function cart()
    {
        return $this->hasOne(ShoppingCart::class, 'identifier', 'id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'member_id', 'id');
    }
}
