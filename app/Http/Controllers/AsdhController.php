<?php

namespace App\Http\Controllers;

use App\Company;
use App\Navigation;
use Carbon\Carbon;
use View;
use Illuminate\Http\Request;

class AsdhController extends Controller
{
  protected $website = [];
  protected $default_pagination_limit = 10;

  public function __construct()
  {
    $with_navigation = Navigation::where('admin', '1')->get();
    $without_navigation = Navigation::where('admin', '1')->where('name', '!=', 'navigation')->get();
    View::share('admin_nav_items', $with_navigation);
    View::share('nav_items', Navigation::where('admin', '0')->get());
    View::share('global_company', Company::find(1));
  }

}
