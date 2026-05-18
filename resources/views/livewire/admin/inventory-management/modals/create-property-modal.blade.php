<div wire:ignore.self class="modal modal-blur fade ims-modal-shell" id="create_property_modal" tabindex="-1" role="dialog" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content ims-modal-content">
            <div class="modal-header ims-modal-header">
                <div class="ims-modal-header-group">
                    <h5 class="modal-title ims-modal-title">Add New Property</h5>
                    <p class="ims-modal-subtitle">Create a complete IMS inventory record with assignment and classification details.</p>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body ims-modal-body-soft">
                @livewire('admin.inventory-management.components.property.index', key('create-property-modal'))
            </div>
        </div>
    </div>
</div>
