<?php

    namespace App\Models\Tags;

    use Illuminate\Database\Eloquent\Model;

    class PostTag extends Model
    {
        protected $fillable = ['name', 'slug'];
    }
