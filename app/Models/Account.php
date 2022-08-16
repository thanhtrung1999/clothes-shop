<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class Account extends Authenticatable
{
    use HasFactory;
    use SoftDeletes;
    use Notifiable;

    protected $table = "accounts";
    protected $guarded = "accounts";
    CONST NAME_ROLE_MANAGER = 'manager';
    CONST NAME_ROLE_ADMIN = 'admin';
    CONST NAME_ROLE_STAFF = 'staff';

    protected $fillable = [
        'email',
        'username',
        'password',
        'phone_number',
        'name',
        'gender',
        'date_of_birth',
        'avatar',
        'accountable_id',
        'accountable_type',
        'social_id',
        'social_type',
        'token'
    ];

    protected $hidden = ['password', 'remember_token'];

    protected static function booted()
    {
        parent::booted(); // TODO: Change the autogenerated stub
        static::creating(function ($account) {
            $account->password = Hash::make($account->password);
        });
    }

    public function getAvatarPathAttribute()
    {
        return asset("storage/images/accounts/{$this->avatar}");
    }

    public function accountable()
    {
        return $this->morphTo();
    }

}