<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

/**
 * Class Good
 * @package App
 * 
 * @property-read $id
 * @property-read $title
 * @property-read $description
 * @property-read $price
 * @property-read Category $category
 */

class Good extends Model
{
    use HasFactory;

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function getImageId() {
        return $this->id % 9 + 1;
    }
}
