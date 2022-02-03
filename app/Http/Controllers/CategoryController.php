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
            $tree .= $this->getTree($node->children);
            $tree .= '</li>';
        }
        $tree .= '</ul>';

        return $tree;
    }

    public function getDropDown($data): string
    {
        $tree = '';

        foreach ($data as $node) {
            $lines = str_repeat('- ', $node->depth);
            $tree .= '<option value="' . $node->id . '">' . $lines . $node->name . '</option>';

        }

        return $tree;
    }

    public function nodeUp()
    {
        $node = Category::find(22);

        $bool = $node->up();

        return redirect()->route('categories_index');
    }

    public function nodeDown()
    {
        $node = Category::find(22);

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

    public function createAction(Request $request)
    {
        $validated  = $request->validate([
            'name' => 'required',
        ]);

        $parent = Category::find($request->parent);

        Category::create(['name' => $request->name], $parent);

        return redirect()->route('categories_index');
    }
}