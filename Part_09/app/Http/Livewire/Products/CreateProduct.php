<?php

namespace App\Http\Livewire\Products;

use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class CreateProduct extends Component
{
    public $barcode;
    public $name;
    public $purchase_price;
    public $selling_price;
    public $stock;

    protected $rules = [
        'name' => 'required|max:100',
        'barcode' => 'required|digits_between:12,13|unique:products,barcode',
        'purchase_price' => 'required|not_regex:/^Rp\s\d{1,3}(\.\d{3})*?$/',
        'selling_price' => 'required|not_regex:/^Rp\s\d{1,3}(\.\d{3})*?$/',
        'stock' => 'required|integer|gt:0'
    ];

    protected $validationAttributes = [
        'barcode' => 'barcode',
        'name' => 'name',
        'purchase_price' => 'purchase price',
        'selling_price' => 'selling price',
        'stock' => 'stock'
    ];

    public function mount()
    {
        $this->initializedProperties();
    }

    public function updated($property, $value)
    {
        if (trim($value)) {
            $this->validateOnly($property);
        } else {
            $this->clearValidation($property);
        }
    }

    public function render()
    {
        return view('livewire.products.create-product');
    }

    public function save()
    {
        $this->validate();
        DB::beginTransaction();
        try {
            Product::create([
                'barcode' => $this->barcode,
                'name' => $this->name,
                'purchase_price' => currencyToNumeric($this->purchase_price),
                'selling_price' => currencyToNumeric($this->selling_price),
                'stock' => $this->stock,
            ]);

            $this->emit('flashMessage', [
                'type' => 'success',
                'title' => 'Create product',
                'message' => "Product created successfully"
            ]);

            $this->emit('reloadProducts');
            $this->emit('closeModal', 'modal_create_product');
            $this->initializedProperties();
        } catch (\Throwable $th) {
            DB::rollBack();

            $this->emit('flashMessage', [
                'type' => 'error',
                'title' => 'Create product',
                'message' => "Something went wrong: " . $th->getMessage()
            ]);
        }
        DB::commit();
    }

    public function cancel()
    {
        $this->initializedProperties();
    }

    private function initializedProperties()
    {
        $this->clearValidation();
        $this->barcode = null;
        $this->name = null;
        $this->purchase_price = null;
        $this->selling_price = null;
        $this->stock = null;
    }
}
