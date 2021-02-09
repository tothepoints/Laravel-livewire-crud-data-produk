<?php

namespace App\Http\Livewire\Products;

use App\Models\Product;
use Illuminate\Support\Facades\DB;
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

    public function updated($property, $value)
    {
        if (trim($value)) {
            $this->validateOnly($property);
        } else {
            $this->resetErrorBag($property);
        }
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
        $this->validate();
        DB::beginTransaction();
        try {
            Product::findOrFail($this->productId)->update([
                'barcode' => trim($this->barcode),
                'name' => trim($this->name),
                'purchase_price' => currencyIDRToNumeric($this->purchase_price),
                'selling_price' => currencyIDRToNumeric($this->selling_price),
                'stock' => trim($this->stock),
            ]);

            $this->emit('flashMessage', [
                'type' => 'success',
                'title' => 'Update product',
                'message' => "Product updated successfully"
            ]);

            $this->emit('reloadProducts');
            $this->emit('closeModal', 'modal_update_product');
            $this->initializedProperties();
        } catch (\Throwable $th) {
            DB::rollBack();

            $this->emit('flashMessage', [
                'type' => 'error',
                'title' => 'Update product',
                'message' => "Something went wrong: " . $th->getMessage()
            ]);
        }
        DB::commit();
    }

    public function cancel()
    {
        $this->initializedProperties();
    }

    protected function rules()
    {
        return [
            'barcode' => 'required|numeric|digits_between:12,13|unique:products,barcode,' . $this->productId,
            'name' => 'required|max:100',
            'purchase_price' => 'required|not_regex:/^Rp\s\d{1,3}(\.\d{3})*?$/',
            'selling_price' => 'required|not_regex:/^Rp\s\d{1,3}(\.\d{3})*?$/',
            'stock' => 'required|integer|gt:0'
        ];
    }

    private function initializedProperties()
    {
        $this->resetErrorBag();
        $this->barcode = null;
        $this->name = null;
        $this->purchase_price = null;
        $this->selling_price = null;
        $this->stock = null;
    }
}
