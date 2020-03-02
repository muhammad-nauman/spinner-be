<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use SoftDeletes;
    protected $guarded = [];

    protected $appends = ['file_url'];

    public function inventories()
    {
        return $this->hasMany(Inventory::class);
    }

    public function getFileUrlAttribute()
    {
        return url(Storage::url(preg_replace('/\s/', '%20', $this->file)));
    }
}
