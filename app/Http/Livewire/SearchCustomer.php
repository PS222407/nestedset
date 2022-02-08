<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class SearchCustomer extends Component
{
    public $customerName;
    public $products;

    public function render()
    {
        $name = str_replace(' ', '', $this->customerName);

        $this->products = $name == '' ? [] : DB::select("SELECT * FROM products WHERE REPLACE (name, ' ', '') LIKE '%$name%'");

        return view('livewire.search-customer');
    }
}
