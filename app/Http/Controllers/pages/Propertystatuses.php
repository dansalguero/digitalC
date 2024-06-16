<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Property_status;

class propertystatuses extends Controller
{
  public function index()
  {
    $propertystatuses = Property_status::all();
    return view('content.pages.propertystatuses', ['propertystatuses' => $propertystatuses]);
  }

  public function create()
  {
    return view('content.pages.propertystatuses-create');
  }

  public function store(Request $request)
  {
    $validator = $request->validate([
      'name' => 'required'
    ]);
    $propertystatus = new Property_status();
    $propertystatus->name = $request->name;
    $propertystatus->created_at = now();
    $propertystatus->updated_at = now();
    $propertystatus->save();
    return redirect()->route('pages-propertystatuses');
  }

  public function show($status_id)
  {
    $propertystatus = Property_status::all();
    return view('content.pages.propertystatuses-show', ['propertystatus' => $propertystatus]);
  }

  public function update(Request $request)
  {
    $propertystatus = Property_status::find($request->property_id);
    $propertystatus->name = $request->name;
    $propertystatus->updated_at = now();
    $propertystatus->save();
    return redirect()->route('pages-propertystatuses');
  }

  public function destroy($property_id)
  {
    $propertystatus = Property_status::find($property_id);
    $propertystatus->delete();
    return redirect()->route('pages-propertystatuses');
  }
}