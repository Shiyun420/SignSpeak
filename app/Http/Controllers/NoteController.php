<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Note;

class NoteController extends Controller
{
    //GET: show all notes
    public function adminShowNotes()
    {
        $notes = Note::orderBy('updated_at', 'desc')->get();

        return view('admin.adminShowNotes',compact('notes'));
    }

    //GET: return the view (Add notes)
    public function addNotesView()
    {
        return view('admin.addNotesView');
    }

    //POST: Add notes
    public function addNotes(Request $request)
    {
        // Validate the request
        $request->validate([
            'title' => 'required|string|max:255',
            'noteURL' => 'required|mimes:pdf,doc,docx|max:20000'
        ]);

        // Create a new Note instance
        $note = new Note;

        // Set the note attributes
        $note->title = $request->title;

        // Handle note upload
        if ($request->hasFile('noteURL')) {
            $file = $request->file('noteURL');
            $fileName = $request->title . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('notesFiles'), $fileName);
            $note->noteURL = $fileName;
        }

        // Execute the insert_note procedure
        DB::statement("CALL insert_note('" . $note->title . "', '" . $note->noteURL . "')");

        // Redirect to the notes list page
        return redirect()->route('admin.adminShowNotes');
    }

    //GET: return the view (Edit notes)
    public function editNotesView($id)
    {
        $note=Note::find($id);
        return view('admin.editNotesView', compact('note'));
    }
    
    //POST: Edit notes
    public function editNotes(Request $request, $id)
    {
        $note=Note::find($id);
        $note->title=$request->title;
        
        if ($request->hasFile('noteURL')) {
            $file = $request->file('noteURL');
            $fileName = $request->title . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('notesFiles'), $fileName);
            $note->noteURL = $fileName;
        }
        
        // Execute the update_note procedure
        DB::statement("CALL update_note('" . $id . "', '" . $note->title . "', '" . $note->noteURL . "')");
        
        return redirect()->back()->with('message', 'Note Details Updated Successfully');
    }

    //GET: Delete notes
    public function deleteNotes($id)
    {
        $note=Note::find($id);
        $note->delete();
        return redirect()->back()->with('message', 'Note Deleted Successfully');
    }

    //GET: show all notes (User)
    public function userShowNotes()
    {
        $notes = Note::orderBy('updated_at')->get();
        return view('user.userShowNotes', compact('notes'));
    }


}
