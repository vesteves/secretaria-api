<?php

namespace App\Http\Controllers;

use App\Http\Requests\Group\StoreGroup;
use App\Http\Requests\Group\UpdateGroup;
use App\Models\Group;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $withCourse = $request->query('course', false);

        if ($withCourse) {
            $groups = Group::with('course')->get();
        } else {
            $groups = Group::all();
        }

        return response()->json($groups);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGroup $request)
    {
        $group = Group::create($request->all());

        return response()->json([
            "msg" => "Turma criada!",
            "data" => $group
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Group $group)
    {
        return response()->json($group);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGroup $request, Group $group)
    {
        $group->update($request->all());

        // TODO colocar em um log de alterações quais campos e quem alterou

        return response()->json([
            "msg" => "Turma atualizada!",
            "data" => $group
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Group $group)
    {
        $group->delete();

        return response()->json([
            "msg" => "Turma removida!"
        ]);
    }
}
