<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
  protected $guarded = ['id'];

  public function name()
  {
    return ucfirst($this->name);
  }

  public function seo()
  {
    $title = "Home - " . $this->name();
    $seo = '<link rel="canonical" href="' . route('home') . '" />';
    $seo .= '<meta property="og:locale" content="en_US" />';
    $seo .= '<meta property="og:type" content="website" />';
    $seo .= '<meta property="og:title" content="'. $title .'" />';
    $seo .= '<meta property="og:url" content="' . route('home') . '" />';
    $seo .= '<meta property="og:site_name" content="'. $this->name .'" />';
    $seo .= '<meta name="twitter:card" content="summary" />';
    $seo .= '<meta name="twitter:title" content="'. $title .'" />';
    return $seo;
  }
}
