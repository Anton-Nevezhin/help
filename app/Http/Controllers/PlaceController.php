<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Place;

class PlaceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $places = Place::orderBy('name')->paginate(10);
        return view('places.index', compact('places'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('places.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
    $validated = $request->validate([
        'name' => 'required|string|max:255|unique:places,name',
        'address' => 'required|string|min:1',
        'phone' => 'nullable|string|max:20',
    ], [
        'name.required' => 'Название обязательно для заполнения',
        'name.unique' => 'Эта площадка уже есть в базе',
        'name.max' => 'Название не может быть длиннее 255 символов',
        'address.required' => 'Адрес обязателен для заполнения',
        'phone.max' => 'Телефон не может быть длиннее 20 символов',
        'address.min' => 'Адрес не может быть пустым',
    ]);

    Place::create($validated);

    return redirect()->route('places.index')->with('success', 'Место добавлено');

    }

    /**
     * Display the specified resource.
     */
    public function show(Place $place)
    {
        return view('places.show', compact('place'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Place $place)
    {
        return view('places.edit', compact('place'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Place $place)
    {
        $place->update($request->all());
        return redirect()->route('places.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Place $place)
    {
        $place->delete();
        return redirect()->route('places.index');

    }

    public function quickStore(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'phone' => 'nullable|string',
        ]);

        $place = Place::create($validated);
        
        return response()->json([
            'id' => $place->id,
            'name' => $place->name
        ]);
    }
}
