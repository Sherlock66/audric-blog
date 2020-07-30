<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\CategoryProject;

class CategoryProjectController extends Controller
{
    public function create(Request $request) {
        if($request->isMethod('post')) {
            $this->validate($request->all(), [
                'name' => 'required|string',
                'description' => 'nullable|string',
            ]);
            $data = $request->only('name','description');
            CategoryProject::create($data);
        } else {
            $page = $request->page;
            $limit = null;

            if ($request->limit && $request->limit > 0) {
                $limit = $request->limit;
            }
            if ($limit || $page) {
                $category_project = CategoryProject::paginate($limit);
            } else {
                $category_project = CategoryProject::all();
            }
            return view('pages.master.list_category_project', compact('category_project'));
        }

    }

    public function get() {
        $category_project =CategoryProject::all();
       return view('pages.works');
    }

    public function delete($id) {
        $category = CategoryProject::find($id)->first();
        $project->delete($category);
    }
}
