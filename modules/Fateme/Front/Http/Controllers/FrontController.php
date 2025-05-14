<?php

namespace Fateme\Front\Http\Controllers;
use Fateme\Course\Repositories\CourseRepo;

class FrontController
{
    public function index()
    {
        return view('Front::index');
    }

    public function singleCourse($slug, CourseRepo $courseRepo)
    {
        $courseId = Str::before(Str::after($slug, 'c-'), '-');
        $course = $courseRepo->findByid($courseId);
        return view('Front::singleCourse', compact('course'));
    }

}
