<?php

namespace Fateme\Course\Http\Controllers;

use App\Http\Controllers\Controller;
use Fateme\Course\Http\Requests\LessonRequest;
use Fateme\Course\Repositories\CourseRepo;
use Fateme\Course\Repositories\LessonRepo;
use Fateme\Course\Repositories\SeasonRepo;
use Fateme\Media\Services\MediaFileService;

class LessonController extends Controller
{

    private $lessonRepo;

    public function __construct(LessonRepo $lessonRepo)
    {
        $this->lessonRepo = $lessonRepo;
    }

    public function create($course, SeasonRepo $seasonRepo, CourseRepo $courseRepo)
    {
        $seasons = $seasonRepo->getCourseSeasons($course);
        $course = $courseRepo->findByid($course);
        return view('Courses::lessons.create', compact('seasons', 'course'));
    }

    public function store($course, LessonRequest $request)
    {
        $request->request->add(["media_id" => MediaFileService::upload($request->file('lesson_file'))->id ]);
        $this->lessonRepo->store($course,$request);
        newFeedback();
        return redirect(route('courses.details', $course));
    }
}
