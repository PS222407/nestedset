<?php

namespace App\Classes;

class NestedTree{
    public function getTree($data, $url): string
    {
        $tree = '<ul>';

        foreach ($data as $node) {
            $tree .= '<li>' . $node['name'];
            $tree .= '<a style="padding: 10px;" href="/'.$url.'/move-down/' . $node->id . '">&dArr;</a>';
            $tree .= '<a style="padding: 10px;" href="/'.$url.'/move-up/' . $node->id . '">&uArr;</a>';
            $tree .= '<a style="padding: 10px;" href="/'.$url.'/edit/' . $node->id . '">Edit</a>';
            $tree .= '<a style="padding: 10px;" href="/'.$url.'/delete/' . $node->id . '">Delete</a>';
            $tree .= $this->getTree($node->children, $url);
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
}
