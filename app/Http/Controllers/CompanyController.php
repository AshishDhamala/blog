<?php

namespace App\Http\Controllers;

use App\Company;
use App\Http\Requests\CompanyRequest;
use App\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CompanyController extends AsdhController
{
  public function index()
  {
    $company = Company::findOrFail(1);
    return view('admin.company.index', compact('company'));
  }

  public function create()
  {
    //
  }

  public function store(Request $request)
  {
    //
  }

  public function show($id)
  {
    //
  }

  public function edit($id)
  {
    $company = Company::findOrFail($id);
    return view('admin.company.edit', compact('company'));
  }

  public function update(CompanyRequest $request, $id)
  {
    $company = Company::findOrFail($id);
    $company->name = $request->name;
    $company->email = $request->email;
    $company->phone = $request->phone;
    $company->established_date = $request->established_date;
    $company->address = $request->address;

    if ($company->save()) {
      return redirect()->/*to(route('company.index'))*/back()->with('success_message', 'Successfully updated');
    } else {
      return redirect()->to(route('company.index'))->with('failure_message', 'Sorry, company information could not be updated. Please try again later!');
    }

  }

  public function destroy($id)
  {
    //
  }

}
