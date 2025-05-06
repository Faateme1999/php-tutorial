<?php

namespace Fateme\Course\Http\Controllers;

use App\Http\Controllers\Controller;
use Fateme\Category\Repositories\CategoryRepo;
use Fateme\Course\Http\Requests\CourseRequest;
use Fateme\Course\Models\Course;
use Fateme\Course\Repositories\CourseRepo;
use Fateme\Media\Services\MediaFileService;
use Fateme\User\Repositories\UserRepo;
use Responses\AjaxResponses;


class CourseController extends Controller
{

    public function index(CourseRepo $courseRepo)
    {
        $this->authorize('index', Course::class);
//        if (auth()->user()->hasAnyPermission([Permission::PERMISSION_MANAGE_COURSES, Permission::PERMISSION_SUPER_ADMIN])) {
            $courses = $courseRepo->paginate();
//        } else {
//            $courses = $courseRepo->getCoursesByTeacherId(auth()->id());
//        }

        return view('Courses::index', compact('courses'));
    }
    public function create(UserRepo $userRepo,CategoryRepo $categoryRepo)
    {
        $this->authorize('create', Course::class);
        $teachers = $userRepo->getTeachers();
        $categories = $categoryRepo->all();

        return view('Courses::create', compact('teachers','categories'));
    }

    public function store(CourseRequest $request, CourseRepo $courseRepo)
    {
        $this->authorize('create', Course::class);
        $request->request->add(['banner_id' => MediaFileService::publicUpload($request->file('image'))->id]);
        $teacherId = $request->input('teacher_id', auth()->id());
        if (hasPermissionTo(Permission::PERMISSION_MANAGE_COURSES) == false) {
            $teacherId = auth()->id();
        }
        $courseRepo->store($request->merge([
            'teacher_id' => $teacherId,
        ]));

        return redirect()->route('courses.index');
    }

    public function edit($id, CourseRepo $courseRepo, UserRepo $userRepo, CategoryRepo $categoryRepo)
    {
        $course = $courseRepo->findByid($id);
        $this->authorize('edit', $course);
        $teachers = $userRepo->getTeachers();
        $categories = $categoryRepo->all();

        return view('Courses::edit', compact('course', 'teachers', 'categories'));
    }

    public function update($id, CourseRequest $request, CourseRepo $courseRepo)
    {
        $course = $courseRepo->findByid($id);
        $this->authorize('edit', $course);
        if ($request->hasFile('image')) {
            $request->request->add(['banner_id' => MediaFileService::publicUpload($request->file('image'))->id]);
            if ($course->banner) {
                $course->banner->delete();
            }
        } else {
            $request->request->add(['banner_id' => $course->banner_id]);
        }
        $courseRepo->update($id, $request);

        return redirect(route('courses.index'));
    }


    public function details($id, CourseRepo $courseRepo)
    {
        $course = $courseRepo->findByid($id);
        return view('Courses::details', compact('course'));

    }


    public function destroy($id, CourseRepo $courseRepo)
    {
        $course = $courseRepo->findByid($id);
        $this->authorize('delete', $course);
        if ($course->banner) {
            $course->banner->delete();
        }
        $course->delete();

        return AjaxResponses::SuccessResponse();
    }

    public function accept($id, CourseRepo $courseRepo)
    {
        $this->authorize('change_confirmation_status', Course::class);
        if ($courseRepo->updateConfirmationStatus($id, Course::CONFIRMATION_STATUS_ACCEPTED)) {
            return AjaxResponses::SuccessResponse();
        }

        return AjaxResponses::FailedResponse();
    }

    public function reject($id, CourseRepo $courseRepo)
    {
        $this->authorize('change_confirmation_status', Course::class);
        if ($courseRepo->updateConfirmationStatus($id, Course::CONFIRMATION_STATUS_REJECTED)) {
            return AjaxResponses::SuccessResponse();
        }
        return AjaxResponses::FailedResponse();
    }

    public function lock($id, CourseRepo $courseRepo)
    {
        $this->authorize('change_confirmation_status', Course::class);
        if ($courseRepo->updateStatus($id, Course::STATUS_LOCKED)) {
            return AjaxResponses::SuccessResponse();
        }
        return AjaxResponses::FailedResponse();
    }

}
