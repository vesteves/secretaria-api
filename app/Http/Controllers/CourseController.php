<?php

namespace App\Http\Controllers;

use App\Http\Requests\Course\StoreCourse;
use App\Http\Requests\Course\UpdateCourse;
use App\Models\Course;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Course::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCourse $request)
    {
        $course = Course::create($request->all());

        return response()->json([
            "msg" => "Curso criado!",
            "data" => $course
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        return response()->json($course);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCourse $request, Course $course)
    {
        $course->update($request->all());

        // TODO colocar em um log de alterações quais campos e quem alterou

        return response()->json([
            "msg" => "Curso atualizado!",
            "data" => $course
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        $course->delete();

        return response()->json([
            "msg" => "Curso removido!"
        ]);
    }
}
