<?php

namespace App\Http\Livewire\Products;

use App\Models\Product;
use Livewire\Component;

class UpdateProduct extends Component
{

    public $productId;
    public $barcode;
    public $name;
    public $purchase_price;
    public $selling_price;
    public $stock;

    protected $listeners = [
        'updateProduct' => 'showModal'
    ];

    public function render()
    {
        return view('livewire.products.update-product');
    }

    public function showModal(Product $product)
    {
        $this->productId = $product->id;
        $this->barcode = $product->barcode;
        $this->name = $product->name;
        $this->purchase_price = currency_IDR($product->purchase_price);
        $this->selling_price = currency_IDR($product->selling_price);
        $this->stock = $product->stock;
        $this->emit('showModal', 'modal_update_product');
    }

    public function update()
    {
        dd('Todo: update');
    }

    public function cancel()
    {
        $this->initializedProperties();
    }

    private function initializedProperties()
    {
        $this->barcode = null;
        $this->name = null;
        $this->purchase_price = null;
        $this->selling_price = null;
        $this->stock = null;
    }
}
