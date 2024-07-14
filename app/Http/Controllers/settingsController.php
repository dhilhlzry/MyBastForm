<?php

namespace App\Http\Controllers;

use App\Models\DocumentSet;
use Illuminate\Http\Request;

class settingsController extends Controller
{
    public function index()
    {
        $data['value'] = DocumentSet::where('name', 'mom')->first();
        return view('admin.settings.index', $data);
    }

    public function store(Request $request)
    {
        if ($mom = DocumentSet::where('name', 'mom')->first() == null) {
        } else {
            $mom = DocumentSet::where('name', 'mom')->first();
            $mom->delete();
        }
        DocumentSet::create([
            'name' => 'mom',
            'margin_y' => $request->margin_y,
            'margin_x' => $request->margin_x,
            'col1_mt' => $request->column1,
            'col2_mt' => $request->column2,
            'col3_mt' => $request->column3,
            'col4_mt' => $request->column4,
        ]);

        session()->flash('success', 'Data Saved!');
        return redirect()->route('settings.index');
    }
}
