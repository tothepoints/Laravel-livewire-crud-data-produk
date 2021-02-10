<?php

namespace App\Http\Livewire\Products;

use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class DeleteProduct extends Component
{
    public $productId;
    public $barcode;
    public $name;

    protected $listeners = [
        'deleteProduct' => 'showModal'
    ];

    public function mount()
    {
        $this->initializedProperties();
    }

    public function render()
    {
        return view('livewire.products.delete-product');
    }

    public function showModal(Product $product)
    {
        $this->productId = $product->id;
        $this->barcode = $product->barcode;
        $this->name = $product->name;
        $this->emit('showModal', 'modal_delete_product');
    }

    public function delete()
    {
        DB::beginTransaction();
        try {
            Product::findOrFail($this->productId)->delete();
            $this->emit('flashMessage', [
                'type' => 'success',
                'title' => 'Delete product',
                'message' => "Product deleted successfully"
            ]);

            $this->emit('reloadProducts');
            $this->emit('closeModal', 'modal_delete_product');
            $this->initializedProperties();
        } catch (\Throwable $th) {
            DB::rollBack();

            $this->emit('flashMessage', [
                'type' => 'error',
                'title' => 'Delete product',
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
        $this->productId = null;
        $this->barcode = null;
        $this->name = null;
    }
}
