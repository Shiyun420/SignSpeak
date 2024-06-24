<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Material;

class MaterialController extends Controller
{
    //GET: show all materials
    public function adminShowMaterials()
    {
        $materials = Material::orderBy('updated_at', 'desc')->get();

        return view('admin.adminShowMaterials',compact('materials'));
    }

    //GET: return the view (Add materials)
    public function addMaterialsView()
    {
        return view('admin.addMaterialsView');
    }

    //POST: Add materials
    public function addMaterials(Request $request)
    {
        // Validate the request
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'videoURL' => 'required|mimes:mp4,mov,ogg|max:20000',
            'audioURL' => 'required|mimes:mp3,wav|max:10000',
            'category' => 'required|string'
        ]);

        // Create a new Material instance
        $material = new Material;

        // Set the material attributes
        $material->title = $request->title;
        $material->description = $request->description;
        $material->category = $request->category;

        // Handle image upload and conversion to BLOB
        $image = $request->file('image');
        if (!$image) {
            die("File is not an image");
        }
        $imageBlob = file_get_contents($image->getRealPath());
        $material->image = $imageBlob;

        // Handle video upload
        $video = $request->file('videoURL');
        $videoName = time() . '.' . $video->getClientOriginalExtension();
        $video->move(public_path('materialsVideo'), $videoName);
        $material->videoURL = $videoName;

        // Handle audio upload
        $audio = $request->file('audioURL');
        $audioName = time() . '.' . $audio->getClientOriginalExtension();
        $audio->move(public_path('materialsAudio'), $audioName);
        $material->audioURL = $audioName;

        // Save the material to the database
        $material->save();

        // Redirect to the materials list page
        return redirect()->route('admin.adminShowMaterials');
    }

    //GET: return the view (Edit materials)
    public function editMaterialsView($id)
    {
        $material=Material::find($id);
        return view('admin.editMaterialsView', compact('material'));
    }
    
    //POST: Edit materials
    public function editMaterials(Request $request, $id)
    {
        $material=Material::find($id);
        $material->title=$request->title;
        $material->description=$request->description;
        $material->category=$request->category;

        $image = $request->file('image');
        if($image)
        {
            $imageBlob = file_get_contents($image->getRealPath());
            $material->image = $imageBlob;
        }

        $video = $request->file('videoURL');
        if($video)
        {
            $videoName = time() . '.' . $video->getClientOriginalExtension();
            $video->move(public_path('materialsVideo'), $videoName);
            $material->videoURL = $videoName;
        }

        $audio = $request->file('audioURL');
        if($audio)
        {
            $audioName = time() . '.' . $audio->getClientOriginalExtension();
            $audio->move(public_path('materialsAudio'), $audioName);
            $material->audioURL = $audioName;
        }
        
        $material->save();
        return redirect()->back()->with('message', 'Material Details Updated Successfully');
    }

    //GET: get material image
    public function getImage($id)
    {
        $material = Material::find($id);
        if ($material && $material->image) {
            return response()->make($material->image, 200, [
                'Content-Type' => (new \finfo(FILEINFO_MIME))->buffer($material->image)
            ]);
        }
        return response()->make(null, 404);
    }

    //GET: Delete materials
    public function deleteMaterials($id)
    {
        $material=Material::find($id);
        $material->delete();
        return redirect()->back()->with('message', 'Material Deleted Successfully');
    }

    //GET: show all materials (User)
    public function userShowMaterials()
    {
        $materials = Material::where('category', 'alphabet')
                    ->orderBy('title')
                    ->get();
                    //$materials = Material::orderBy('title')->get();

        return view('user.userShowMaterials',compact('materials'));
    }

    //GET: show all materials (User)
    public function userShowNumber()
    {
        $materials = Material::where('category', 'number')
                    ->orderBy('title')
                    ->get();

        return view('user.userShowNumber',compact('materials'));
    }

    //GET: show all materials (User)
    public function userShowOther()
    {
        $materials = Material::where('category', 'others')
                    ->orderBy('updated_at')
                    ->get();

        return view('user.userShowOther',compact('materials'));
    }

    //GET: show materials details
    public function showMaterialDetails($id)
    {
        $material=Material::find($id);
        return view('user.showMaterialDetails', compact('material'));
    }

}
