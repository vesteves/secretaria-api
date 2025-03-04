<?php

use Illuminate\Support\Facades\Route;

use App\Models\Student;
use App\Models\Course;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/contract', function () {
    $student = Student::find(6);
    $group = $student->groups()->where('group_id', 1)->first();
    $course = Course::find($group->course_id);

    // $htmlContent = view('contract', [
    //     "student" => $student,
    //     "group" => $group,
    //     "course" => $course,
    // ])->render();
    // dd($htmlContent);
    // dd($group->pivot->id);
    // dd($course);

    return view('contract', [
        "student" => $student,
        "group" => $group,
        "course" => $course,
    ]);
});
