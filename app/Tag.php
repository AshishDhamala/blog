<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
  protected $guarded = ['id'];

  public function posts() {
    return $this->belongsToMany('App\Post');
  }

  public function has_posts() {
    return count($this->posts);
  }

  public function name() {
    return str_replace('-', ' ', $this->name);
  }

  public function names_as_array() {
    $tags = Tag::all();
    $tag_names = [];
    foreach ($tags as $tag) {
      $tag_names[] = $tag->name;
    }
    return $tag_names;
  }

  public function seo()
  {
    $company = Company::find(1);
    $title = $this->name() . " Tag - " . $company->name();
    $seo = '<link rel="canonical" href="' . route('tag.detail', $this->slug) . '" />';
    $seo .= '<meta property="og:locale" content="en_US" />';
    $seo .= '<meta property="og:type" content="object" />';
    $seo .= '<meta property="og:title" content="'. $title .'" />';
    $seo .= '<meta property="og:url" content="' . route('category.detail', $this->slug) . '" />';
    $seo .= '<meta property="og:site_name" content="'. $this->name .'" />';
    $seo .= '<meta name="twitter:card" content="summary" />';
    $seo .= '<meta name="twitter:title" content="'. $title .'" />';
    return $seo;
  }

}
