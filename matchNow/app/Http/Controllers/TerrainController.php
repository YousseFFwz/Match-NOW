<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Terrain;

class TerrainController extends Controller
{
    public function index()
    {
        $terrains = Terrain::all();
        return view('admin.terrains.index', compact('terrains'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'location' => 'required',
        ]);

        Terrain::create($request->all());

        return back()->with('success', 'Terrain created');
    }

    public function update(Request $request, $id)
    {
        $terrain = Terrain::findOrFail($id);

        $terrain->update($request->all());

        return back()->with('success', 'Updated');
    }

    public function destroy($id)
    {
        Terrain::findOrFail($id)->delete();

        return back()->with('success', 'Deleted');
    }
}
