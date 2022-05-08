<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prayer extends Model
{
    use HasFactory;
    protected $fillable = ['category_id', 'main_phrase', 'txt', 'graduation', 'photo', 'has_photo'];

    public function category() {
        return $this->belongsTo(Category::class, 'category_id');
    }

}
