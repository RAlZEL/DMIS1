<!-- Edit Property Modal (Homepage) -->
<div wire:ignore.self class="modal modal-blur fade ims-modal-shell ims-edit-property-modal" id="edit_property" tabindex="-1" role="dialog" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
  <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable" role="document">
    <form class="modal-content ims-modal-content" method="POST" wire:submit.prevent="updateProperty">
      <div class="modal-header ims-modal-header">
        <div class="ims-modal-header-group">
          <h5 class="modal-title ims-modal-title">Edit Property</h5>
          <p class="ims-modal-subtitle">Update assignment, asset details, and classification data for this IMS record.</p>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body ims-modal-body-soft">
        <div class="ims-form-shell ims-edit-form-shell">
          <section class="ims-form-panel">
            <div class="ims-form-panel-head">
              <div>
                <h6 class="ims-form-panel-title">Assignment</h6>
                <p class="ims-form-panel-subtitle">Control where the property belongs and who is accountable for it.</p>
              </div>
            </div>

            <div class="row g-3">
              <div class="col-lg-6">
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
              <div class="col-lg-6">
                <label class="form-label">Accountable Officer <span class="text-danger">*</span></label>
                <select class="form-select" wire:model="edit_accountable_officer">
                  <option value="">--- Choose Employee ---</option>
                  @forelse($EmployeeLists as $employee)
                    <option value="{{ $employee->id }}">{{ trim($employee->firstname . ' ' . $employee->middlename . ' ' . $employee->lastname) }}</option>
                  @empty
                    <option value="" disabled>No employees available</option>
                  @endforelse
                </select>
                <span class="text-danger">@error('edit_accountable_officer') {{ $message }} @enderror</span>
              </div>
              <div class="col-lg-6">
                <label class="form-label">Date Acquired <span class="text-danger">*</span></label>
                <input type="date" class="form-control" wire:model="edit_date_acquired">
                <span class="text-danger">@error('edit_date_acquired') {{ $message }} @enderror</span>
              </div>
              <div class="col-lg-6">
                <label class="form-label">Property No.</label>
                <input type="text" class="form-control" placeholder="Enter Property Number" wire:model="edit_property_no">
                <span class="text-danger">@error('edit_property_no') {{ $message }} @enderror</span>
              </div>
            </div>
          </section>

          <section class="ims-form-panel">
            <div class="ims-form-panel-head">
              <div>
                <h6 class="ims-form-panel-title">Asset Details</h6>
                <p class="ims-form-panel-subtitle">Maintain the article, description, value, and specification used in the record.</p>
              </div>
            </div>

            <div class="row g-3">
              <div class="col-lg-6">
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
              <div class="col-lg-6">
                <label class="form-label">Description</label>
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
              <div class="col-12">
                <label class="form-label">Specification <span class="text-danger">*</span></label>
                <input type="text" class="form-control" placeholder="Enter Specification" wire:model="edit_specification">
                <span class="text-danger">@error('edit_specification') {{ $message }} @enderror</span>
              </div>
              <div class="col-lg-6">
                <label class="form-label">Unit of Measurement</label>
                <input type="text" class="form-control" placeholder="Enter Unit of Measurement" wire:model="edit_unit_of_measurement">
                <span class="text-danger">@error('edit_unit_of_measurement') {{ $message }} @enderror</span>
              </div>
              <div class="col-lg-6">
                <label class="form-label">Unit Value <span class="text-danger">*</span></label>
                <div class="input-group ims-currency-input-group">
                  <span class="input-group-text">&#8369;</span>
                  <input type="text" inputmode="decimal" class="form-control currency-input text-end" id="editUnitValueDisplay" data-target="editUnitValueHidden" placeholder="0.00" autocomplete="off" spellcheck="false" value="{{ $edit_unit_value }}">
                  <button class="btn ims-currency-clear currency-clear" type="button" title="Clear">&times;</button>
                </div>
                <input type="hidden" id="editUnitValueHidden" wire:model="edit_unit_value" value="{{ $edit_unit_value }}">
                <span class="text-danger">@error('edit_unit_value') {{ $message }} @enderror</span>
              </div>
            </div>
          </section>

          <section class="ims-form-panel">
            <div class="ims-form-panel-head">
              <div>
                <h6 class="ims-form-panel-title">Classification and Notes</h6>
                <p class="ims-form-panel-subtitle">Keep UACS and other inventory metadata aligned with the selected article and unit value.</p>
              </div>
            </div>

            <div class="row g-3 ims-classification-grid">
              <div class="col-lg-4">
                <label class="form-label d-flex align-items-center gap-2">UACS <span class="ims-field-chip">Auto</span></label>
                <input type="text" class="form-control ims-readonly-field" wire:model="edit_uacs" placeholder="No matching UACS for the current threshold" readonly>
                <span class="text-danger">@error('edit_uacs') {{ $message }} @enderror</span>
              </div>
              <div class="col-lg-4">
                <label class="form-label">Fund Cluster</label>
                <input type="text" class="form-control" placeholder="Enter Fund Cluster" wire:model="edit_fund_cluster">
                <span class="text-danger">@error('edit_fund_cluster') {{ $message }} @enderror</span>
              </div>
              <div class="col-lg-4">
                <label class="form-label">Estimated Useful Life</label>
                <input type="text" class="form-control" placeholder="Enter Estimated Useful Life" wire:model="edit_estimated_useful_life">
                <span class="text-danger">@error('edit_estimated_useful_life') {{ $message }} @enderror</span>
              </div>
              <div class="col-12">
                <div class="ims-inline-helper-card">Auto-filled from the selected article and unit value inside IMS.</div>
              </div>
              <div class="col-12">
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
          </section>
        </div>
      </div>

      <div class="modal-footer ims-modal-footer">
        <button type="button" class="btn ims-btn-tertiary" data-bs-dismiss="modal">Cancel</button>
        <button type="submit" class="btn ims-btn-primary" wire:loading.attr="disabled" wire:target="updateProperty">
          <span wire:loading.remove wire:target="updateProperty">Update Property</span>
          <span wire:loading wire:target="updateProperty"><i class="spinner-border spinner-border-sm me-1"></i>Updating...</span>
        </button>
      </div>
    </form>
  </div>
</div>
