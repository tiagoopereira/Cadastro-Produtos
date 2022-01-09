<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

class Product extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['id', 'name'];

    public function tags(): Relation
    {
        return $this->belongsToMany(Tag::class);
    }
}
