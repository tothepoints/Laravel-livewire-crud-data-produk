<form wire:submit.prevent="delete">
   <div wire:ignore.self class="modal fade" id="modal_delete_product" data-backdrop="static" data-keyboard="false"
      tabindex="-1" aria-labelledby="modal_delete_product_label" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-centered">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="modal_delete_product_label">Delete product</h5>
               <button wire:click="cancel" type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">
               <p>
                  Are you sure you want to delete <strong>{{ $name }}</strong> product with barcode
                  <strong>{{ $barcode }}</strong>?
               </p>
            </div>
            <div class="modal-footer">
               <button wire:click="cancel" type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
               <button type="submit" class="btn btn-primary">Delete</button>
            </div>
         </div>
      </div>
   </div>
</form>
