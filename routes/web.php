<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\RealTimeDetectionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/home',[HomeController::class, 'redirect'])->name('redirect');
Route::get('/realtimeDetection', [RealTimeDetectionController::class, 'realtimeDetection'])->name('realtimeDetection');
Route::get('/detection/index', [RealTimeDetectionController::class, 'index'])->name('realtime-detection');

//MaterialController
Route::get('/adminShowMaterials', [MaterialController::class, 'adminShowMaterials'])->name('admin.adminShowMaterials');
Route::get('/addMaterialsView', [MaterialController::class, 'addMaterialsView'])->name('admin.addMaterialsView');
Route::post('/addMaterials', [MaterialController::class, 'addMaterials'])->name('admin.addMaterials');
Route::get('/editMaterialsView/{id}', [MaterialController::class, 'editMaterialsView'])->name('admin.editMaterialsView');
Route::post('/editMaterials/{id}', [MaterialController::class, 'editMaterials'])->name('admin.editMaterials');
Route::get('/admin/material-image/{id}', [MaterialController::class, 'getImage'])->name('admin.getImage');
Route::get('/deleteMaterials/{id}', [MaterialController::class, 'deleteMaterials'])->name('admin.deleteMaterials');
Route::get('/userShowMaterials', [MaterialController::class, 'userShowMaterials'])->name('user.userShowMaterials');
Route::get('/userShowNumber', [MaterialController::class, 'userShowNumber'])->name('user.userShowNumber');
Route::get('/userShowOther', [MaterialController::class, 'userShowOther'])->name('user.userShowOther');
Route::get('/showMaterialDetails/{id}', [MaterialController::class, 'showMaterialDetails'])->name('user.showMaterialDetails');

//QuizController
Route::get('/adminShowQuizzes', [QuizController::class, 'adminShowQuizzes'])->name('admin.adminShowQuizzes');
Route::get('/addQuizzesView', [QuizController::class, 'addQuizzesView'])->name('admin.addQuizzesView');
Route::post('/addQuizzes', [QuizController::class, 'addQuizzes'])->name('admin.addQuizzes');
Route::get('/admin/addQuestionView/{quizId}', [QuizController::class, 'addQuestionView'])->name('admin.addQuestionView');
Route::post('/addQuestion', [QuizController::class, 'addQuestion'])->name('admin.addQuestion');
Route::get('/admin/quizDetails/{id}', [QuizController::class, 'quizDetails'])->name('admin.quizDetails');
Route::post('/closeQuiz/{id}', [QuizController::class, 'closeQuiz'])->name('admin.closeQuiz');
Route::post('/openQuiz/{id}', [QuizController::class, 'openQuiz'])->name('admin.openQuiz');
Route::get('/admin/editQuestionIndex/{id}', [QuizController::class, 'editQuestionIndex'])->name('admin.editQuestionIndex');
Route::get('/deleteQuestion/{id}', [QuizController::class, 'deleteQuestion'])->name('admin.deleteQuestion');
Route::get('/admin/editQuestionsView/{quizId}', [QuizController::class, 'editQuestionsView'])->name('admin.editQuestionsView');
Route::post('/editQuestion/{id}', [QuizController::class, 'editQuestion'])->name('admin.editQuestion');

Route::get('/userShowQuizzes', [QuizController::class, 'userShowQuizzes'])->name('user.userShowQuizzes');
Route::get('/user/userQuizDetails/{id}', [QuizController::class, 'userQuizDetails'])->name('user.userQuizDetails');
Route::post('/submitQuiz/{quizId}', [QuizController::class, 'submitQuiz'])->name('user.submitQuiz');
Route::get('/showQuizzesRecord', [QuizController::class, 'showQuizzesRecord'])->name('user.showQuizzesRecord');
Route::get('/showResult/{quizId}', [QuizController::class, 'showResult'])->name('user.showResult');

//NoteController
Route::get('/adminShowNotes', [NoteController::class, 'adminShowNotes'])->name('admin.adminShowNotes');
Route::get('/addNotesView', [NoteController::class, 'addNotesView'])->name('admin.addNotesView');
Route::post('/addNotes', [NoteController::class, 'addNotes'])->name('admin.addNotes');
Route::get('/editNotesView/{id}', [NoteController::class, 'editNotesView'])->name('admin.editNotesView');
Route::post('/editNotes/{id}', [NoteController::class, 'editNotes'])->name('admin.editNotes');
Route::get('/deleteNotes/{id}', [NoteController::class, 'deleteNotes'])->name('admin.deleteNotes');
Route::get('/userShowNotes', [NoteController::class, 'userShowNotes'])->name('user.userShowNotes');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
