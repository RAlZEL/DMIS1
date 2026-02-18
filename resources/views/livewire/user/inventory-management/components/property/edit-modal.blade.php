<div wire:ignore.self class="modal fade" id="editPropertyModal" tabindex="-1" aria-labelledby="editPropertyLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editPropertyLabel">Edit Property</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form wire:submit.prevent="updateProperty">
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Article Name *</label>
                            <select class="form-select @error('edit_article_id') is-invalid @enderror" wire:model="edit_article_id">
                                <option value="">Select Article</option>
                                @foreach($ArticleNameLists as $article)
                                    <option value="{{ $article->id }}">{{ $article->article_name }}</option>
                                @endforeach
                            </select>
                            @error('edit_article_id') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Description</label>
                            <select class="form-select @error('edit_article_desc_id') is-invalid @enderror" wire:model="edit_article_desc_id">
                                <option value="">Select Description</option>
                                @foreach($ArticleDescriptionLists as $desc)
                                    <option value="{{ $desc->id }}">{{ $desc->article_description }}</option>
                                @endforeach
                            </select>
                            @error('edit_article_desc_id') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Property No.</label>
                            <input type="text" class="form-control @error('edit_property_no') is-invalid @enderror" wire:model.defer="edit_property_no">
                            @error('edit_property_no') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Specification</label>
                            <input type="text" class="form-control @error('edit_specification') is-invalid @enderror" wire:model.defer="edit_specification">
                            @error('edit_specification') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Unit Value (₱)</label>
                            <input type="number" step="0.01" class="form-control @error('edit_unit_value') is-invalid @enderror" wire:model.defer="edit_unit_value">
                            @error('edit_unit_value') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Quantity Physical Count</label>
                            <input type="number" class="form-control @error('edit_quantity_per_count') is-invalid @enderror" wire:model.defer="edit_quantity_per_count">
                            @error('edit_quantity_per_count') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Date Acquired</label>
                            <input type="date" class="form-control @error('edit_date_acquired') is-invalid @enderror" wire:model.defer="edit_date_acquired">
                            @error('edit_date_acquired') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Office</label>
                            <select class="form-select @error('edit_office') is-invalid @enderror" wire:model.defer="edit_office">
                                <option value="">Select Office</option>
                                @foreach($OfficeLists as $office)
                                    <option value="{{ $office->id }}">{{ $office->office }}</option>
                                @endforeach
                            </select>
                            @error('edit_office') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-12">
                            <label class="form-label">Accountable Officer</label>
                            <select class="form-select @error('edit_accountable_officer') is-invalid @enderror" wire:model.defer="edit_accountable_officer">
                                <option value="">Select Officer</option>
                                @foreach($EmployeeLists as $employee)
                                    <option value="{{ $employee->id }}">{{ $employee->firstname }} {{ $employee->middlename }} {{ $employee->lastname }}</option>
                                @endforeach
                            </select>
                            @error('edit_accountable_officer') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-12">
                            <label class="form-label">Remarks</label>
                            <textarea class="form-control @error('edit_remarks') is-invalid @enderror" rows="2" wire:model.defer="edit_remarks" placeholder="Enter remarks..."></textarea>
                            @error('edit_remarks') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update Property</button>
                </div>
            </form>
        </div>
    </div>
</div>
