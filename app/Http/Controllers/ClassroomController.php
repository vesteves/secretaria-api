<?php

namespace App\Http\Controllers;

use App\Http\Requests\Classroom\StoreClassroom;
use App\Http\Requests\Classroom\UpdateClassroom;
use App\Models\Classroom;

class ClassroomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Classroom::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreClassroom $request)
    {
        $classroom = Classroom::create($request->all());

        return response()->json([
            "msg" => "Sala criada!",
            "data" => $classroom
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Classroom $classroom)
    {
        return response()->json($classroom);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateClassroom $request, Classroom $classroom)
    {
        $classroom->update($request->all());

        // TODO colocar em um log de alterações quais campos e quem alterou

        return response()->json([
            "msg" => "Sala atualizada!",
            "data" => $classroom
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Classroom $classroom)
    {
        $classroom->delete();

        return response()->json([
            "msg" => "Sala removida!"
        ]);
    }
}
