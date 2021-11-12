<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App;

class Blog extends Model
{
    use SoftDeletes;

    public function getTranslation($field = '', $lang = false){
		$lang = $lang == false ? App::getLocale() : $lang;
		$blog_translation = $this->hasMany(BlogTranslation::class)->where('lang', $lang)->first();
		return $blog_translation != null ? $blog_translation->$field : $this->$field;
    }
    public function category() {
        return $this->belongsTo(BlogCategory::class, 'category_id');
    }

}
