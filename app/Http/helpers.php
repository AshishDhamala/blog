<?php
function success_or_failure_message()
{
  $message = "";

  if (session('success_message')) {
    $message .= '<div id="asdh-message" class="alert asdh-nice_bottom_margin" role="alert">';
    $message .= '<h3>' . session("success_message") . '</h3>';
    $message .= '<svg version="1.1" viewBox="0 0 130.2 130.2">
  <circle class="path circle" fill="none" stroke="#73AF55" stroke-width="6" stroke-miterlimit="10" cx="65.1" cy="65.1" r="62.1"/>
  <polyline class="path check" fill="none" stroke="#73AF55" stroke-width="6" stroke-linecap="round" stroke-miterlimit="10" points="100.2,40.2 51.5,88.8 29.8,67.5 "/>
</svg>';
    $message .= '</div>';
  } elseif (session('failure_message')) {
    $message .= '<div id="asdh-message" class="alert asdh-nice_bottom_margin" role="alert">';
    $message .= '<h3>' . session("failure_message") . '</h3>';
    $message .= '<svg version="1.1" viewBox="0 0 130.2 130.2">
  <circle class="path circle" fill="none" stroke="#D06079" stroke-width="6" stroke-miterlimit="10" cx="65.1" cy="65.1" r="62.1"/>
  <line class="path line" fill="none" stroke="#D06079" stroke-width="6" stroke-linecap="round" stroke-miterlimit="10" x1="34.4" y1="37.9" x2="95.8" y2="92.3"/>
  <line class="path line" fill="none" stroke="#D06079" stroke-width="6" stroke-linecap="round" stroke-miterlimit="10" x1="95.8" y1="38" x2="34.4" y2="92.2"/>
</svg>';
    $message .= '</div>';
  }
  return $message;
}

function success_or_failure_message_ajax()
{
  $message = '<div class="asdh-message alert alert-success asdh-nice_bottom_margin" role="alert">
      <h3></h3>
      <svg version="1.1" viewBox="0 0 130.2 130.2">
        <circle class="path circle" fill="none" stroke="#73AF55" stroke-width="6" stroke-miterlimit="10" cx="65.1" cy="65.1" r="62.1"/>
        <polyline class="path check" fill="none" stroke="#73AF55" stroke-width="6" stroke-linecap="round" stroke-miterlimit="10" points="100.2,40.2 51.5,88.8 29.8,67.5 "/>
      </svg>
    </div>';
  return $message;
}

function validation_error_message($errors)
{
  $message = "";
  if (count($errors) > 0) {
    $all_errors = $errors->all();
    $message .= '<div class="alert stay alert-danger">';
    $message .= '<strong>Whoops!</strong> There were some problems with your input.';
    $message .= '<ul>';

    for ($i = 0; $i < count($all_errors); $i++) {
      $message .= '<li>' . $all_errors[$i] . '</li>';
    }

    $message .= '</ul>';
    $message .= '</div>';
    return $message;
  }
  return $message;
}

function beautify_image($image)
{
  $image_name = $image->getClientOriginalName();
  return str_replace(" ", "-", $image_name);
}

function upload_image($image, $path = "")
{
  if ($image->isValid()) {
    $image_name_with_extension = $image->getClientOriginalName();
    $image_extension = $image->getClientOriginalExtension();
    $image_name = str_replace("." . $image_extension, "." . $image_extension, $image_name_with_extension);
    $modified_image_name = "asdh-" . date('YmdHis') . "-" . str_replace(" ", "-", $image_name);
    $image_path = "public/images/" . $path;

    if ($image->move($image_path, $modified_image_name)) {
      return $modified_image_name;
    } else {
      return false;
    }
  }
  return false;
}

function success_class($id)
{
  $class = "";
  if (session('id') == $id) {
    $class = "asdh-is_updated";
  }
  return $class;
}

function format_date($date, $format = 'M d, h:i a')
{
  $dt = new \Carbon\Carbon($date);
  return $dt->format($format);
}

function check_route_data($data)
{
  if (isset($_GET[$data]) && $_GET[$data] !== "" && !empty($_GET[$data])) {
    return $_GET[$data];
  }
  return false;
}

function select_as_per_route($get, $data)
{
  if (isset($_GET[$get]) && $_GET[$get] !== "" && !empty($_GET[$get])) {
    if ($_GET[$get] === $data) {
      return "selected";
    }
  }
  return null;
}

// It will provide name of the route at given index
// @example
// http://www.abc.com/posts
// Here, posts is at index 0
// This function will give posts if index = 0 is passed as parameter
function get_route_name_at_index($index)
{
  $route = \Illuminate\Support\Facades\Request::path();
  $route_array = explode('/', $route);
  return isset($route_array[$index]) ? $route_array[$index] : false;
}

// this function will return create and index link of all any controller.
function crud_for_every_page($name)
{
  $crud = '
    <div class="row asdh-nice_bottom_margin">
      <div class="col-xs-12">
        <a href="' . route($name . '.create') . '" class="btn btn-primary " title="Create new ' . $name . '" id="create">
          <i class="fa fa-plus"></i> Create
        </a>
        <a href="' . route($name . '.index') . '" class="btn btn-success" title="Show every ' . $name . '" id="show">
          <i class="fa fa-eye"></i> Show
        </a>
        <a href="#" class="btn btn-danger asdh-delete_confirmation_dialogue_toggle" id="delete_multiple"><i class="fa fa-trash"></i> Delete Multiple</a>
        <div class="asdh-delete_confirmation_dialogue">
          <h3>Are you sure?</h3>';
  if ($name == 'user' || $name == 'category') {
    $crud .= '<p>All the posts of this user will be assigned to <br>"<b>Default (core)</b>" ' . $name . '.</p>';
  }
  $crud .= '<button type="submit" class="btn btn-danger btn-lg">Delete</button>
                <a href="#" class="btn btn-primary btn-lg">No</a>
              </div>
      </div>
    </div>
  ';

  return $crud;
}

// tag seo
function tag_seo($post)
{
  $seo = '';
  foreach ($post->tags as $tag) {
    $seo .= '<meta property="article:tag" content="' . $tag->name . '" />' . PHP_EOL;
  }
  return $seo;
}

function current_user_role()
{
  // return Auth::user()->roles[0]->name;
  return Auth::user()->role->name;
}

function asdhSEO(\App\Post $post, $company)
{
  $post_description = substr(strip_tags($post->content), 0, 150);

  $seo = '<meta name="description" content="' . $post_description . '">' . PHP_EOL;
  $seo .= '<link rel="canonical" href="' . route('post.detail', $post->slug) . '"/>' . PHP_EOL;

  // Facebook
  $seo .= '<meta property="og:locale" content="en_US" />' . PHP_EOL;
  $seo .= '<meta property="og:type" content="article" />' . PHP_EOL;
  $seo .= '<meta property="og:title" content="' . $post->title . '". />' . PHP_EOL;
  $seo .= '<meta property="og:description" content="' . $post_description . '" />' . PHP_EOL;
  $seo .= '<meta property="og:url" content="' . route('post.detail', $post->slug) . '" />' . PHP_EOL;
  $seo .= '<meta property="og:site_name" content="' . $company->name . '" />' . PHP_EOL;
  $seo .= '<meta property="og:image" content="' . $post->image() . '" />' . PHP_EOL;
  $seo .= '<meta property="og:image:width" content="1200" />' . PHP_EOL;
  $seo .= '<meta property="og:image:height" content="630" />' . PHP_EOL;
  if (isset($post->user->facebook_page_url) && $post->user->facebook_page_url !== "")
    $seo .= '<meta property="article:publisher" content="' . $post->user->facebook_page_url . '" />' . PHP_EOL;
  if (isset($post->user->facebook_profile_url) && $post->user->facebook_profile_url !== "")
    $seo .= '<meta property="article:author" content="' . $post->user->facebook_profile_url . '" />' . PHP_EOL;
  foreach ($post->tags as $tag) {
    $seo .= '<meta property="article:tag" content="' . $tag->name . '" />' . PHP_EOL;
  }
  $seo .= '<meta property="article:published_time" content="' . $post->created_at('c') . '" />' . PHP_EOL;
  // Twitter
  $seo .= '<meta name="twitter:card" content="summary" />' . PHP_EOL;
  $seo .= '<meta name="twitter:description" content="'. $post_description .'" />' . PHP_EOL;
  $seo .= '<meta name="twitter:title" content="' . $post->title . '" />' . PHP_EOL;
  $seo .= '<meta name="twitter:image" content="' . $post->image() . '" />' . PHP_EOL;
  if (isset($post->user->twitter_username) && $post->user->twitter_username !== "")
    $seo .= '<meta name="twitter:creator" content="' . $post->user->twitter_username . '" />' . PHP_EOL;
  return $seo;
}
