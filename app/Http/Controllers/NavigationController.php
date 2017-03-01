<?php

namespace App\Http\Controllers;

use App\Http\Requests\NavigationRequest;
use App\Navigation;
use Illuminate\Http\Request;

class NavigationController extends AsdhController
{
  public function __construct()
  {
    parent::__construct();
  }

  public function index()
  {
    $nav_items = Navigation::orderBy('name')->paginate($this->default_pagination_limit);
    return view('admin.navigation.index', compact('nav_items'));
  }

  public function create()
  {
    $all_nav_items = Navigation::all();
    return view('admin.navigation.create', compact('all_nav_items'));
  }

  public function store(NavigationRequest $request)
  {
    $nav_item = new Navigation;
    $admin = ($request->admin == "on") ? 1 : 0;

    $nav_item->name = strtolower($request->get('name'));
    $nav_item->link = $request->link;
    $nav_item->admin = $admin;

    if ($nav_item->save()) {
      return redirect()->to(route('navigation.index'))->with('success_message', 'Successfully created');
    } else {
      return redirect()->to(route('navigation.index'))->with('failure_message', '<b>' . $nav_item->name . '</b> could not be created');
    }
  }

  public function show($id)
  {
    //
  }

  public function edit($id)
  {
    $nav_item = Navigation::find($id);
    $nav_items = Navigation::all();
    return view('admin.navigation.edit', compact('nav_item', 'nav_items'));
  }

  public function update(NavigationRequest $request, $id)
  {
    $nav_item = Navigation::find($id);
    $admin = ($request->admin == "on") ? 1 : 0;

    $nav_item->name = $request->name;
    $nav_item->link = $request->link;
    $nav_item->admin = $admin;

    if ($nav_item->save()) {
      return redirect()->to(route('navigation.index'))->with('success_message', 'Successfully updated');
    } else {
      return redirect()->to(route('navigation.index'))->with('failure_message', '<b>' . $nav_item->name . '</b> could not be updated');
    }
  }

  public function destroy($id)
  {
    /*$nav_item = Navigation::find($id);
    if ($nav_item->delete()) {
      return "Successfully deleted";
    } else {
      return 'no';
    }*/
  }

  public function delete(Request $request)
  {
    if (isset($request->deleteMultiple)) {
      Navigation::destroy($request->deleteMultiple);
      return redirect(route('navigation.index'))->with('success_message', 'Navigation items successfully deleted.');
    } else if (isset($request->delete)) {
      $navigation = Navigation::findOrFail($request->delete);
      $navigation->delete();
      return redirect(route('navigation.index'))->with('success_message', 'Navigation item successfully deleted.');
    }
    return redirect(route('navigation.index'))->with('failure_message', 'To delete, you need to select at least one navigation item.');
  }
}
