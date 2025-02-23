<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

use App\Http\Requests\Student\StoreStudent;
use App\Http\Requests\Student\UpdateStudent;
use App\Models\Student;
use App\Mail\StudentPreSubscribed;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->group_id) {
            $students = Student::whereHas('groups', function ($query) use ($request) {
                $query->where('group_id', $request->group_id);
            })->with(['groups' => function ($query) use ($request) {
                $query->where('group_id', $request->group_id)->first();
            }])->get();

            return response()->json($students);
        }

        return response()->json(Student::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStudent $request)
    {
        $student = Student::create($request->validated());

        $student->groups()->attach($request->group_id, [
            "course_id" => $request->course_id,
            "modality" => $request->modality,
            "payment" => $request->payment,
            "discover" => $request->discover,
            "google" => $request->google,
            "price" => $request->price,
            "links" => $request->links,
            "status" => "presubscribed",
        ]);

        Mail::to($student)->send(new StudentPreSubscribed($student));

        return response()->json([
            "msg" => "Estudante criado!",
            "data" => $student
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        return response()->json($student);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStudent $request, Student $student)
    {
        $student->update($request->validated());
        $student->groups()->update($request->validated());

        // TODO colocar em um log de alterações quais campos e quem alterou

        return response()->json([
            "msg" => "Estudante atualizado!",
            "data" => $student
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        $student->delete();

        return response()->json([
            "msg" => "Estudante removido!"
        ]);
    }
}
