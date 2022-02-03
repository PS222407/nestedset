<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function getTree($data): string
    {
        $tree = '<ul>';

        foreach ($data as $node) {
            $tree .= '<li>' . $node['name'];
            $tree .= '<a style="padding: 10px;" href="/categories/move-down/' . $node->id . '">&dArr;</a>';
            $tree .= '<a style="padding: 10px;" href="/categories/move-up/' . $node->id . '">&uArr;</a>';
            $tree .= '<a style="padding: 10px;" href="/categories/edit/' . $node->id . '">Edit</a>';
            $tree .= '<a style="padding: 10px;" href="/categories/delete/' . $node->id . '">Delete</a>';
            $tree .= $this->getTree($node->children);
            $tree .= '</li>';
        }
        $tree .= '</ul>';


        return $tree;
    }

    public function getDropDown($data, $selectedParent = null): string
    {
        $tree = '';

        foreach ($data as $node) {
            $lines = str_repeat('- ', $node->depth);

            if ($node->id == $selectedParent) {
                $tree .= '<option selected="selected" value="' . $node->id . '">' . $lines . $node->name . '</option>';
            } else {
                $tree .= '<option value="' . $node->id . '">' . $lines . $node->name . '</option>';
            }
        }

        return $tree;
    }

    public function nodeUp($id)
    {
        $node = Category::find($id);

        $bool = $node->up();

        return redirect()->route('categories_index');
    }

    public function nodeDown($id)
    {
        $node = Category::find($id);

        $bool = $node->down();

        return redirect()->route('categories_index');
    }


    public function index()
    {
        $categories = Category::defaultOrder()->get()->toTree();

        $htmltree = $this->getTree($categories);

        return view('categories_index', ['htmltree' => $htmltree]);
    }

    public function create()
    {
        $categoriesFlat = Category::withDepth()->defaultOrder()->get()->toFlatTree();
        $options = $this->getDropDown($categoriesFlat);
        return view('categories_create', ['options' => $options]);
    }

    public function edit($id)
    {
        $node = Category::find($id);

        $categoriesFlat = Category::withDepth()->defaultOrder()->get()->toFlatTree();
        $options = $this->getDropDown($categoriesFlat, $node->parent_id);

        return view('categories_edit', ['options' => $options, 'node' => $node]);
    }

    public function createAction(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
        ]);

        $parent = Category::find($request->parent);

        Category::create(['name' => $request->name], $parent);

        return redirect()->route('categories_index');
    }

    public function editAction(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required',
        ]);

        $node = Category::find($id); //
        $node->name = $request->name;
        $node->save();

        return redirect()->route('categories_index');
    }

    public function delete($id)
    {
        $node = Category::find($id); //
        $node->delete();

        return redirect()->route('categories_index');
    }
}
