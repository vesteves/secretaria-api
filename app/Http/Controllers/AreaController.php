<?php

namespace App\Http\Controllers;

use App\Http\Requests\Area\StoreArea;
use App\Http\Requests\Area\UpdateArea;
use App\Models\Area;

class AreaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Area::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreArea $request)
    {
        $area = Area::create($request->all());

        return response()->json([
            "msg" => "Area criada!",
            "data" => $area
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Area $area)
    {
        return response()->json($area);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateArea $request, Area $area)
    {
        $area->update($request->all());

        // TODO colocar em um log de alterações quais campos e quem alterou

        return response()->json([
            "msg" => "Area atualizada!",
            "data" => $area
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Area $area)
    {
        $area->delete();

        return response()->json([
            "msg" => "Area removida!"
        ]);
    }
}
