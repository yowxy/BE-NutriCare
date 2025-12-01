<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FoodLog extends Model
{
    protected $table = 'food_logs';
    protected $fillable = [
        'user_id',
        'food_name',
        'calories',
        'protein',
        'carbs',
        'fat',
        'sugar',
        'sodium',
        'vit_c',
        'vit_a',
        'potassium',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
