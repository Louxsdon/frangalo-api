<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        "shirt_length",
        "around_arm",
        "waist",
        "neck",
        "trouser_length",
        "shoulder_to_chest",
        "hip",
        "shoulder_to_hip",
        "breast_length",
        "shoulder_to_waist",
        "ankle",
        "dress_length",
        "notes",
        "customer_id",
        "status"
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, "customer_id");
    }
}
