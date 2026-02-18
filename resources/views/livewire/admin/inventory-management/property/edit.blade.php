<!-- Edit Property Modal (Homepage) -->
<div wire:ignore.self class="modal modal-blur fade" id="edit_property" tabindex="-1" role="dialog" aria-hidden="true"
  data-bs-backdrop="static" data-bs-keyboard="false">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <form class="modal-content" method="POST" wire:submit.prevent="updateProperty">
      <div class="modal-header">
        <h5 class="modal-title">Edit Property</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <div class="row g-3">
          <div class="col-lg-6">
            <div class="mb-3">
              <label class="form-label">Date Acquired <span class="text-danger">*</span></label>
              <input type="date" class="form-control" wire:model="edit_date_acquired">
              <span class="text-danger">@error('edit_date_acquired') {{ $message }} @enderror</span>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="mb-3">
              <label class="form-label">Property No.</label>
              <input type="text" class="form-control" placeholder="Enter Property Number" wire:model="edit_property_no">
              <span class="text-danger">@error('edit_property_no') {{ $message }} @enderror</span>
            </div>
          </div>
        </div>

        <div class="row g-3">
          <div class="col-lg-6">
            <div class="mb-3">
              <label class="form-label">Article / Item <span class="text-danger">*</span></label>
              <select class="form-select" wire:model="edit_article_id">
                <option value="">--- Choose Article ---</option>
                @forelse($ArticleNameLists as $art)
                  <option value="{{ $art->id }}">{{ $art->article_name }}</option>
                @empty
                  <option value="" disabled>No articles available</option>
                @endforelse
              </select>
              <span class="text-danger">@error('edit_article_id') {{ $message }} @enderror</span>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="mb-3">
              <label class="form-label">Article Description (Select)</label>
              <select class="form-select" wire:model="edit_article_desc_id">
                <option value="">--- Choose Description ---</option>
                @forelse($ArticleDescriptionLists as $desc)
                  <option value="{{ $desc->id }}">{{ $desc->article_description }}</option>
                @empty
                  <option value="" disabled>No descriptions available</option>
                @endforelse
              </select>
              <span class="text-danger">@error('edit_article_desc_id') {{ $message }} @enderror</span>
            </div>
          </div>
        </div>


        <div class="row g-3">
          <div class="col-lg-12">
            <div class="mb-3">
              <label class="form-label">Specification <span class="text-danger">*</span></label>
              <input type="text" class="form-control" placeholder="Enter Specification" wire:model="edit_specification">
              <span class="text-danger">@error('edit_specification') {{ $message }} @enderror</span>
            </div>
          </div>
        </div>

        <div class="row g-3">
          <div class="col-lg-12">
            <div class="mb-3">
              <label class="form-label">Unit Value <span class="text-danger">*</span></label>
              <div class="input-group">
                <span class="input-group-text">₱</span>
                <input type="text" inputmode="decimal" class="form-control currency-input" id="editUnitValueDisplay" data-target="editUnitValueHidden"
                  placeholder="0.00" autocomplete="off" spellcheck="false" value="{{ $edit_unit_value }}">
                <button class="btn btn-outline-secondary currency-clear" type="button" title="Clear">&times;</button>
              </div>
              <input type="hidden" id="editUnitValueHidden" wire:model.defer="edit_unit_value" value="{{ $edit_unit_value }}">
              <span class="text-danger">@error('edit_unit_value') {{ $message }} @enderror</span>
            </div>
          </div>
        </div>

        <div class="row g-3">
          <div class="col-lg-12">
            <div class="mb-3">
              <label class="form-label">Quantity Per Physical Count</label>
              <input type="text" inputmode="decimal" class="form-control" placeholder="Enter Quantity Per Count" wire:model="edit_quantity_per_count"
                style="-moz-appearance: textfield; -webkit-appearance: none;" 
                onkeypress="return event.charCode >= 48 && event.charCode <= 57 || event.charCode == 46">
              <span class="text-danger">@error('edit_quantity_per_count') {{ $message }} @enderror</span>
            </div>
          </div>
        </div>

        <div class="row g-3">
          <div class="col-lg-6">
            <div class="mb-3">
              <label class="form-label">Remarks <span class="text-danger">*</span></label>
              <select class="form-select" wire:model="edit_remarks">
                <option value="">--- Choose Remarks ---</option>
                @forelse ($RemarksList as $Remark)
                  <option value="{{ $Remark->remark_name }}">{{ $Remark->remark_name }}</option>
                @empty
                  <option value="" disabled>No remarks available</option>
                @endforelse
              </select>
              <span class="text-danger">@error('edit_remarks') {{ $message }} @enderror</span>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="mb-3">
              <label class="form-label">Office <span class="text-danger">*</span></label>
              <select class="form-select" wire:model="edit_office">
                <option value="">--- Choose Office ---</option>
                @forelse($OfficeLists as $office)
                  <option value="{{ $office->id }}">{{ $office->office }}</option>
                @empty
                  <option value="" disabled>No offices available</option>
                @endforelse
              </select>
              <span class="text-danger">@error('edit_office') {{ $message }} @enderror</span>
            </div>
          </div>
        </div>

        <div class="row g-3">
          <div class="col-lg-12">
            <div class="mb-3">
              <label class="form-label">Accountable Officer <span class="text-danger">*</span></label>
              <select class="form-select" wire:model="edit_accountable_officer">
                <option value="">--- Choose Employee ---</option>
                @forelse($EmployeeLists as $employee)
                  <option value="{{ $employee->id }}">
                    {{ $employee->firstname . ' ' . $employee->middlename . ' ' . $employee->lastname }}
                  </option>
                @empty
                  <option value="" disabled>No employees available</option>
                @endforelse
              </select>
              <span class="text-danger">@error('edit_accountable_officer') {{ $message }} @enderror</span>
            </div>
          </div>
        </div>
      </div>

      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Update</button>
      </div>
    </form>
  </div>
</div>