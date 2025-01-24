<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GalleryCategory extends Model
{
    use HasFactory;
    protected $table = 'gallery_categories';
    public $timestamps = false;

    public function GalleryAlbum() {
        return $this->hasMany(GalleryCategory::class, 'category_id', 'id');
    }
}