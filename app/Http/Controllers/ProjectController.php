<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Project;

class ProjectController extends Controller
{
    public function create(Request $request) {
        $this->validate($request->all(), [
            'category_id' => 'required|exists:category_projects,id',
            'name' => 'required|string',
            'description' => 'nullable|string',
            'image' => 'required',
            'started_at' => 'nullable',
            'ended_at' => 'nullable',
            'url' => 'nullable|string',
            'enterprise' => 'nullable|string',
            'created_at' => Carbon::now
        ]);

        $data = $request->only('category_id','name','description','image','started_at','ended_at','url', 'enterprise');
        if ($file = $request->file('image')) {
            $request->validate(['image' => 'image|mimes:jpeg,png,jpg,gif,svg']);
            $extension = $file->getClientOriginalExtension();
            $relativeDestination = "uploads/projects";
            $destinationPath = public_path($relativeDestination);
            $safeName = str_replace(' ', '_', $request->email) . time() . '.' . $extension;
            $file->move($destinationPath, $safeName);
            $data['image'] = url("$relativeDestination/$safeName");
           
        }
        $user = Project::create($data);
    }

    public function get(Request $request) {
        $page = $request->page;
        $limit = null;

        if ($request->limit && $request->limit > 0) {
            $limit = $request->limit;
        }
        if ($limit || $page) {
            $all_projects = Project::paginate($limit);
        } else {
            $all_projects = Project::all();
        }
        return view('pages.works');
    }

    public function delete($id) {
        $project = Project::find($id)->first();
        $project->delete($project);
    }
}
