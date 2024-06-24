<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Quiz;
use App\Models\Question;
use App\Models\Selection;
use App\Models\QuizTaken;

class QuizController extends Controller
{
    public function adminShowQuizzes()
    {
       //$quizzes = Quiz::orderBy('updated_at', 'desc')->get();
       $quizzes = Quiz::orderBy('updated_at', 'desc')
        ->get()
        ->map(function ($quiz) {
            $quiz->totalquestions = DB::table('questions')
                ->where('quizid', $quiz->id)
                ->count();
            return $quiz;
        });
       return view('admin.adminShowQuizzes',compact('quizzes'));
    }

    //GET: return the view (Add quizzes)
    public function addQuizzesView()
    {
        return view('admin.addQuizzesView');
    }

    //POST: Add materials
    public function addQuizzes(Request $request)
    {
        // Create a new Quiz instance
        $quiz = new Quiz;

        // Set the quiz attributes
        $quiz->quizname = $request->quizname;
        $quiz->status = $request->status;

        // Save the quiz to the database
        $quiz->save();

        $quizId = DB::table('quizzes')
            ->where('updated_at', DB::raw('(SELECT MAX(updated_at) FROM quizzes)'))
            ->value('id');

        // Redirect to the admin.addQuestionView route with the quiz ID
        return redirect()->route('admin.addQuestionView', ['quizId' => $quizId]);
    }

    public function addQuestionView($quizId)
    {
        return view('admin.addQuestionView', ['quizId' => $quizId]);
    }

    public function addQuestion(Request $request)
    {
        $question = new Question;

        // Set the question attributes
        $question->question = $request->question;
        $question->answer = $request->answer;
        $question->quizid = $request->quizid;

        $image = $request->file('imageURL');
        if($image)
        {
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('questionImage'), $imageName);
            $question->imageURL = $imageName;
        }

        // Save the question to the database
        $question->save();

        $questionId = DB::table('questions')
            ->where('updated_at', DB::raw('(SELECT MAX(updated_at) FROM questions)'))
            ->value('id');

            for ($i = 1; $i <= 4; $i++) 
            {
                $selection = new Selection;
            
                // Set the selection attributes
                $selection->selection = $request->input("selection{$i}");
                $selection->questionid = $questionId;
            
                // Save the selection to the database
                $selection->save();
            }
        
        return redirect()->back()->with('message', 'Question Added Successfully');
    }

    public function quizDetails($id)
    {
        // Find the quiz by its ID
        $quiz = Quiz::find($id);
        
        // Get all questions associated with the quiz ID
        $questions = DB::table('questions')->where('quizid', $id)->get();
        
        // Get all selections where questionid is in the set of ids from questions with the specified quizid
        $selections = DB::table('selections')
        ->whereIn('questionid', function($query) use ($id) {
            $query->select('id')
                ->from('questions')
                ->where('quizid', $id);
        })
        ->get();

        // Group selections by questionid
        $groupedSelections = $selections->groupBy('questionid');

        $totalquestion = DB::table('questions')
                        ->where('quizid', $id)
                        ->count();
        
        return view('admin.quizDetails', compact('quiz', 'questions', 'groupedSelections', 'totalquestion'));
    }

    public function closeQuiz(Request $request, $id)
    {
        $quiz=Quiz::find($id);
        $quiz->status="Closed";
        
        $quiz->save();
        return redirect()->back()->with('message', 'Quiz Closed Successfully');
    }

    public function openQuiz(Request $request, $id)
    {
        $quiz=Quiz::find($id);
        $quiz->status="Open";
        
        $quiz->save();
        return redirect()->back()->with('message', 'Quiz Opened Successfully');
    }

    public function editQuestionIndex($id)
    {
        $quiz = Quiz::find($id);
        $questions = DB::table('questions')->where('quizid', $id)->get();
        return view('admin.editQuestionIndex', compact('quiz', 'questions'));
    }

    //GET: return the view (Edit questions)
    public function editQuestionsView($quizId)
    {
        $question=Question::find($quizId);
        $selections = DB::table('selections')->where('questionid', $quizId)->get();
        return view('admin.editQuestionsView', compact('question', 'selections'));
    }

    // POST: Update question
    public function editQuestion(Request $request, $id)
    {
        // Find the question by its ID
        $question = Question::find($id);

        // Update the question attributes
        $question->question = $request->question;
        $question->answer = $request->answer;
        $image = $request->file('imageURL');
        if($image)
        {
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('questionImage'), $imageName);
            $question->imageURL = $imageName;
        }
        $question->save();

        // Update selections
        $selections = [
            $request->selection1,
            $request->selection2,
            $request->selection3,
            $request->selection4,
        ];

        $existingSelections = Selection::where('questionid', $id)->get();

        foreach ($existingSelections as $index => $existingSelection) {
            if (isset($selections[$index])) {
                $existingSelection->selection = $selections[$index];
                $existingSelection->save();
            }
        }

        return redirect()->back()->with('message', 'Question Updated Successfully');
    }

    //GET: Delete questions
    public function deleteQuestion($id)
    {
        // Delete selections where questionid is $id
        DB::table('selections')->where('questionid', $id)->delete();

        $question=Question::find($id);
        $question->delete();
        return redirect()->back()->with('message', 'Question Deleted Successfully');
    }

    public function userShowQuizzes()
    {
       //$quizzes = Quiz::orderBy('updated_at', 'desc')->get();
       $quizzes = Quiz::where('status', 'Open')
        ->orderBy('updated_at', 'desc')
        ->get()
        ->map(function ($quiz) {
            $quiz->totalquestions = DB::table('questions')
                ->where('quizid', $quiz->id)
                ->count();
            return $quiz;
        });
       return view('user.userShowQuizzes',compact('quizzes'));
    }

    public function userQuizDetails($id)
    {
        // Find the quiz by its ID
        $quiz = Quiz::find($id);
        
        // Get all questions associated with the quiz ID
        $questions = DB::table('questions')->where('quizid', $id)->get();
        
        // Get all selections where questionid is in the set of ids from questions with the specified quizid
        $selections = DB::table('selections')
        ->whereIn('questionid', function($query) use ($id) {
            $query->select('id')
                ->from('questions')
                ->where('quizid', $id);
        })
        ->get();

        // Group selections by questionid
        $groupedSelections = $selections->groupBy('questionid');

        $totalquestion = DB::table('questions')
                        ->where('quizid', $id)
                        ->count();
        
        return view('user.userQuizDetails', compact('quiz', 'questions', 'groupedSelections', 'totalquestion'));
    }

    public function submitQuiz(Request $request, $quizId)
    {
        $totalMark = 0;

        // Fetch the quiz questions
        $questions = Question::where('quizid', $quizId)->get();

        // Loop through each question to check the user's answer
        foreach ($questions as $question) {
            $userAnswer = $request->input('selection_' . $question->id);

            // Compare user answer with the correct answer
            if ($userAnswer == $question->answer) {
                $totalMark++;
            }
        }

        $quiztaken = new QuizTaken;

        // Set the question attributes
        $quiztaken->marks = $totalMark;
        $quiztaken->studentid = auth()->id();;
        $quiztaken->quizid = $quizId;

        $quiztaken->save();

        $totalQuestions = $questions->count();

        // Redirect to showResult with the necessary data
        return redirect()->route('user.showResult', compact('quizId'));
    }

    public function showResult($quizId)
    {
        // Find the quiz by its ID
        $quiz = Quiz::find($quizId);

        // Fetch the questions related to the quiz
        $questions = Question::where('quizid', $quizId)->get();

        // Calculate total mark and total questions
        $quizTaken = QuizTaken::where('quizid', $quizId)
            ->where('studentid', auth()->id())
            ->orderBy('created_at', 'desc')
            ->first();

        if (!$quizTaken) {
            abort(404, 'Quiz result not found.');
        }

        $totalMark = $quizTaken->marks;
        $totalQuestions = $questions->count();

        return view('user.showResult', compact('quizId', 'totalMark', 'totalQuestions', 'questions', 'quiz'));
    }

    public function showQuizzesRecord()
    {
        $studentId = auth()->id();

        // Eager load the quiz relationship to get quiz name
        $quizTakens = QuizTaken::where('studentid', $studentId)
            ->with('quiz')
            ->orderBy('updated_at', 'desc')
            ->get()
            ->map(function ($quizTaken) {
                $quizTaken->totalQuestions = DB::table('questions')
                    ->where('quizid', $quizTaken->quizid)
                    ->count();
                return $quizTaken;
            });

        return view('user.showQuizzesRecord', compact('quizTakens'));
    }
}
