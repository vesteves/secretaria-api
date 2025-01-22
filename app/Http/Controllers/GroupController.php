<?php

namespace App\Http\Controllers;

use App\Http\Requests\Group\StoreGroup;
use App\Http\Requests\Group\UpdateGroup;
use App\Models\Course;
use App\Models\Group;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\StudentSubscribed;

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
     * Get next groups by course_id.
     */
    public function getNextGroupsByCourseId(Course $course)
    {
        $groups = Group::where(function ($query) {
            $query->where('start', '>', Carbon::now())
                ->orWhere('start', '>=', Carbon::now()->subDays(15));
        })
            ->where('course_id', $course->id)
            ->where('can_enroll', true)
            ->get();
        return response()->json($groups);
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
     * Approve or decline a student in a group
     */
    public function subscribe(Group $group, Request $request)
    {
        $group->students()->sync($request->student_id, [
            "is_approved" => $request->is_approved,
        ]);

        $student = Student::find($request->student_id);
        $course = $group->course;

        if ($request->is_approved) {
            Mail::to($student)->send(new StudentSubscribed($student, $group, $course));
        }

        return response()->json([
            "msg" => $request->is_approved ? "Aprovado" : "Reprovado"
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
