<form wire:submit.prevent="update">
   <div wire:ignore.self class="modal fade" id="modal_update_product" data-backdrop="static" data-keyboard="false"
      tabindex="-1" aria-labelledby="modal_update_product_label" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-centered">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="modal_update_product_label">Update product</h5>
               <button wire:click="cancel" type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">
               {{-- Barcode --}}
               <div class="form-group">
                  <label>Barcode</label>
                  <input wire:model="barcode" class="form-control @error('barcode') is-invalid @enderror" type="text"
                     placeholder="Enter barcode">
                  @error('barcode')<span class="invalid-feedback"> {{ $message }} </span> @enderror
               </div>
               {{-- Product name --}}
               <div class="form-group">
                  <label>Product name</label>
                  <input wire:model="name" class="form-control @error('name') is-invalid @enderror" type="text"
                     placeholder="Enter product name">
                  @error('name')<span class="invalid-feedback"> {{ $message }} </span> @enderror
               </div>
               <div class="form-row">
                  {{-- Purchase price --}}
                  <div class="form-group col-md-6">
                     <label>Purchase price</label>
                     <input wire:model="purchase_price"
                        class="form-control text-right @error('purchase_price') is-invalid @enderror" type="text"
                        type-currency="IDR" placeholder="Rp ">
                     @error('purchase_price')<span class="invalid-feedback"> {{ $message }} </span> @enderror
                  </div>
                  {{-- Selling price --}}
                  <div class="form-group col-md-6">
                     <label>Selling price</label>
                     <input wire:model="selling_price"
                        class="form-control text-right @error('selling_price') is-invalid @enderror" type="text"
                        type-currency="IDR" placeholder="Rp ">
                     @error('selling_price')<span class="invalid-feedback"> {{ $message }} </span> @enderror
                  </div>
               </div>
               {{-- Stock --}}
               <div class="form-group">
                  <label>Stock</label>
                  <input wire:model="stock" class="form-control @error('stock') is-invalid @enderror" type="text"
                     placeholder="Enter stock">
                  @error('stock')<span class="invalid-feedback"> {{ $message }} </span> @enderror
               </div>
            </div>
            <div class="modal-footer">
               <button wire:click="cancel" type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
               <button type="submit" class="btn btn-primary">Save</button>
            </div>
         </div>
      </div>
   </div>
</form>
