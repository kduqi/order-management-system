<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Customer extends Model
{
    use HasFactory, HasUuids, Notifiable;

    /**
     * The attributes that should be mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = ['first_name', 'last_name', 'email', 'phone', 'address'];

    /**
     * Get the customer's first name.
     */
    protected function firstName(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => ucfirst($value),
        );
    }

    /**
     * Get the customer's last name.
     */
    protected function lastName(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => ucfirst($value),
        );
    }

    /**
     * Get the customer's full name.
     */
    protected function fullName(): Attribute
    {
        return Attribute::get(
            fn () => "{$this->first_name} {$this->last_name}"
        );
    }

    /**
     * Get the customer's orders.
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
