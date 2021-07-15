<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'car_model_id',
        'color_id',
        'name',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function model()
    {
        return $this->belongsTo(CarModel::class);
    }

    public function color()
    {
        return $this->belongsTo(Color::class);
    }

}
