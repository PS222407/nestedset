<?php

namespace App\Http\Controllers;

use App\Classes\NestedTree;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected NestedTree $nestedTree;

    public function __construct(NestedTree $nestedTree)
    {
        $this->nestedTree = $nestedTree;
    }

    public function nodeUp($id)
    {
        $node = Category::find($id);
        $node->up();

        return redirect()->route('categories_index');
    }

    public function nodeDown($id)
    {
        $node = Category::find($id);
        $node->down();

        return redirect()->route('categories_index');
    }

    public function index()
    {
        $categories = Category::defaultOrder()->get()->toTree();

        $htmltree = $this->nestedTree->getTree($categories, 'categories');

        return view('categories_index', ['htmltree' => $htmltree]);
    }

    public function create()
    {
        $categoriesFlat = Category::withDepth()->defaultOrder()->get()->toFlatTree();
        $options = $this->nestedTree->getDropDown($categoriesFlat);
        return view('categories_create', ['options' => $options]);
    }

    public function edit($id)
    {
        $node = Category::find($id);

        $categoriesFlat = Category::withDepth()->defaultOrder()->get()->toFlatTree();
        $options = $this->nestedTree->getDropDown($categoriesFlat, $node->parent_id);

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

        $node = Category::find($id);
        $node->name = $request->name;
        if ($request->parent != 'null') {
            $node->parent_id = $request->parent;
        } else {
            $node->parent_id = null;
        }
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
