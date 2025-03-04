<?php

namespace App\Http\Controllers;

use App\Http\Requests\Group\StoreGroup;
use App\Http\Requests\Group\UpdateGroup;
use App\Models\Course;
use App\Models\Group;
use App\Models\Student;
use App\Models\Contract;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\StudentSubscribed;
use App\Mail\StudentPaymentSent;

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
     * Change a student status on a group
     */
    public function changeStudentStatus(Group $group, Request $request)
    {
        $group->students()->syncWithPivotValues($request->student_id, [
            "status" => $request->status,
            "price" => $request->price,
            "links" => $request->links,
            "motivation" => $request->motivation,
            "payment_details" => $request->payment_details,
            "sponsor" => $request->sponsor,
            "witness" => $request->witness,
        ]);

        $student = Student::find($request->student_id);
        $studentGroup = $student->groups()->where('group_id', $group->id)->first();

        $course = $group->course;

        $statusMessage = "Pré Cadastrado";

        switch ($request->status) {
            case "presubscribed":
                $statusMessage = "Pré Inscrito";
                break;
            case "paymentsent":
                Mail::to($student)->send(new StudentPaymentSent($student, $studentGroup, $request->links));
                $statusMessage = "Pagamento Enviado";
                break;
            case "unsubscribed":
                $statusMessage = "Inscrição Cancelada";
                break;
            case "subscribed":
                $htmlContent = view('contract', [
                    'student' => $student,
                    'course'  => $course,
                    'group'   => $studentGroup,
                ])->render();

                $contract = Contract::create([
                    "student_id" => $student->id,
                    "group_id" => $group->id,
                    "course_id" => $course->id,
                    "group_student_id" => $studentGroup->pivot->id,
                    "content" => $htmlContent,
                ]);


                Mail::to($student)->send(new StudentSubscribed($student, $studentGroup, $course, $contract));
                $statusMessage = "Inscrito";
                break;
            case "approved":
                $statusMessage = "Aprovado";
                break;
            case "reproved":
                $statusMessage = "Reprovado";
                break;

            case "canceled":
                $statusMessage = "Cancelado";
                break;

            default:
                $statusMessage = "Pré Cadastrado";
                break;
        }

        return response()->json([
            "msg" => $statusMessage,
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
