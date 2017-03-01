<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class Post extends Model
{
  protected $guarded = ['id'];

  public function user()
  {
    return $this->belongsTo('App\User');
  }

  public function category()
  {
    return $this->belongsTo('App\Category');
  }

  public function tags()
  {
    return $this->belongsToMany('App\Tag');
  }

  public function title()
  {
    return ucfirst($this->title);
  }

  public function title_modified()
  {
    return ucwords($this->title);
  }

  public function image()
  {
    return url("public/images/post/" . $this->image);
  }

  public function active()
  {
    return $this->active ? "Active" : "In active";
  }

  public function content_stripped($length = 100)
  {
    $stripped_content = substr(strip_tags($this->content), 0, $length);
    $read_more = '<a class="asdh-read_more" href="' . route('post.detail', $this->slug) . '">Read more</a>';
    return $stripped_content . "... " . $read_more;
  }
  public function seo()
  {
    $company = Company::find(1);
    $title = $this->title()." - ".$company->name();
    $post_description = substr(strip_tags($this->content), 0, 154);

    $seo = '<meta name="description" content="' . $post_description . '">';
    $seo .= '<link rel="canonical" href="' . route('post.detail', $this->slug) . '"/>';

    // Facebook
    $seo .= '<meta property="og:locale" content="en_US" />';
    $seo .= '<meta property="og:type" content="article" />';
    $seo .= '<meta property="og:title" content="' . $title . '". />';
    $seo .= '<meta property="og:description" content="' . $post_description . '" />';
    $seo .= '<meta property="og:url" content="' . route('post.detail', $this->slug) . '" />';
    $seo .= '<meta property="og:site_name" content="' . $company->name . '" />';
    $seo .= '<meta property="og:image" content="' . $this->image() . '" />';
    $seo .= '<meta property="og:image:width" content="1200" />';
    $seo .= '<meta property="og:image:height" content="630" />';
    if (isset($this->user->facebook_page_url) && $this->user->facebook_page_url !== "")
      $seo .= '<meta property="article:publisher" content="' . $this->user->facebook_page_url . '" />';
    if (isset($this->user->facebook_profile_url) && $this->user->facebook_profile_url !== "")
      $seo .= '<meta property="article:author" content="' . $this->user->facebook_profile_url . '" />';
    foreach ($this->tags as $tag) {
      $seo .= '<meta property="article:tag" content="' . $tag->name . '" />';
    }
    $seo .= '<meta property="article:published_time" content="' . $this->created_at('c') . '" />';
    // Twitter
    $seo .= '<meta name="twitter:card" content="summary" />';
    $seo .= '<meta name="twitter:description" content="'. $post_description .'" />';
    $seo .= '<meta name="twitter:title" content="' . $title . '" />';
    $seo .= '<meta name="twitter:image" content="' . $this->image() . '" />';
    if (isset($this->user->twitter_username) && $this->user->twitter_username !== "")
      $seo .= '<meta name="twitter:creator" content="' . $this->user->twitter_username . '" />';
    return $seo;
  }
}
