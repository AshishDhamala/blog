<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class Category extends Model
{
  protected $guarded = ['id'];

  public function name() {
    return ucfirst($this->name);
  }

  public function posts() {
    return $this->hasMany('App\Post');
  }

  public function is_default() {
    return ($this->name === "default" || $this->name === "Default") ? true : false;
  }

  public function has_posts() {
    return count($this->posts);
  }

  public function seo()
  {
    $company = Company::find(1);
    $title = $this->name() . " Category - " . $company->name();
    $seo = '<link rel="canonical" href="' . route('category.detail', $this->slug) . '" />';
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
