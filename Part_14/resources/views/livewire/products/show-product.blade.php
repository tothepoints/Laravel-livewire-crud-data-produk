<div class="col-md-12">
   <button type="button" class="btn btn-primary px-4" data-toggle="modal" data-target="#modal_create_product">
      Create
   </button>
   <table class="table table-hover mt-1">
      <thead>
         <tr>
            <th>#</th>
            <th>Barcode</th>
            <th>Product name</th>
            <th>Purchase price</th>
            <th>Selling price</th>
            <th>Stock</th>
            <th>action</th>
         </tr>
      </thead>
      <tbody>
         @forelse ($products as $key => $product)
            <tr>
               <td>{{ $key + 1 }}</td>
               <td>{{ $product->barcode }}</td>
               <td>{{ $product->name }}</td>
               <td>{{ currency_IDR($product->purchase_price) }}</td>
               <td>{{ currency_IDR($product->selling_price) }}</td>
               <td>{{ $product->stock }}</td>
               <td>
                  <button wire:click="$emitTo('products.update-product','updateProduct',{{ $product->id }})"
                     class="btn btn-sm btn-info">
                     Update
                  </button>
                  <button wire:click="$emitTo('products.delete-product','deleteProduct',{{ $product->id }})"
                     class="btn btn-sm btn-danger">
                     Delete
                  </button>
               </td>
            </tr>
         @empty
            <tr>
               <td colspan="100%">
                  <strong>No products yet!</strong>
               </td>
            </tr>
         @endforelse
      </tbody>
   </table>
</div>
