<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlogTranslation extends Model
{
  protected $fillable = ['title', 'short_description', 'description', 'lang', 'attribute_id','blog_id'];

  public function blog(){
    return $this->belongsTo(Blog::class);
  }

}
