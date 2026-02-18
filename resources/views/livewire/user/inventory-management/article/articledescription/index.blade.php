<div>
  <div class="row row-cards"> 
      <div class="col-12">
          <div class="card border-0">

            @can('create', App\Models\InventoryManagement\article\articledescription::class)
              <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Article Descriptions</h5>
                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#add_article_description" title="Add Article Description" aria-label="Add Article Description">
                  <i class="fa-solid fa-plus me-2" aria-hidden="true"></i>
                  Add Description
                </button>
              </div>
              @endcan
              <div class="card-body border-bottom py-3">
                  <div class="d-flex flex-wrap gap-3 align-items-center">
                      <div class="text-muted d-flex align-items-center">
                          <span class="me-2">Show</span>
                          <div class="mx-2 d-inline-block">
                              <select class="form-select form-select-sm" wire:model="perPage">
                                  <option value="10">10</option>
                                  <option value="25">25</option>
                                  <option value="50">50</option>
                                  <option value="100">100</option>
                              </select>
                          </div>
                          <span>entries</span>
                      </div>
                      <div class="ms-auto">
                          <input type="text" class="form-control form-control-sm" aria-label="Search" wire:model='Search' placeholder="Search Article Description">
                      </div>
                  </div>
              </div>
              <div class="table-responsive">
                  <table class="table table-vcenter table-striped card-table">
                  <thead>
                      <tr>
                          <th class="text-center" style="width: 80px;">ID</th>
                          <th class="text-center">Article Name</th>
                          <th class="text-center">Description</th>
                          <th class="text-center w-1">Action</th>
                      </tr>
                  </thead>
                  <tbody>
                      @forelse ($ArticleDescriptions as $Index => $ArticleDescription)
                      <tr>
                          <td class="text-center" data-label="Id">{{ $ArticleDescription->id }}</td>
                          <td class="text-center" data-label="Article Name">{{ $ArticleDescription->ArticleName->article_name }}</td>
                          <td class="text-center" data-label="Description">{{ $ArticleDescription->article_description }}</td>
                          <td class="text-center">
                              @can('update', $ArticleDescription)
                              <button class="btn btn-sm btn-primary" wire:click.prevent="editArticle({{$ArticleDescription->id}})">
                                <i class="fa-solid fa-pen-to-square me-1" aria-hidden="true"></i>
                                Edit
                              </button>
                              @endcan
                          </td>
                      </tr>
                      @empty
                      <tr>
                          <td colspan="4" class="text-center py-4">
                              <span class="text-muted">No article descriptions found.</span>
                         </td>
                      </tr>
                      @endforelse
                  </tbody>
                  </table>
              </div>
              <div class="card-footer d-flex align-items-center py-2">
                  {{ $ArticleDescriptions->links('livewire::bootstrap') }}
              </div>
          </div>
      </div>
  </div>

<div class="modal modal-blur fade" id="add_article_description" tabindex="-1" role="dialog" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <form class="modal-content" method="POST" wire:submit.prevent="{{ $updateArticle ? 'updateArticle' : 'addArticle' }}()">
          <div class="modal-header">
            <h5 class="modal-title">
              <i class="fa-solid fa-align-left me-2" aria-hidden="true"></i>
              {{ $updateArticle ? 'Update Article Description' : 'Add Article Description'}}
            </h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
              <div class="mb-3">
                  <label class="form-label">Article Name <span class="text-danger">*</span></label>
                  @if ($updateArticle)
                      <input type="text" class="form-control" name="article_name" wire:model.defer="article_name" readonly>
                  @else
                      <select class="form-select" wire:model.defer="article_name">
                          <option value="" selected>--- Choose Article Name ---</option>
                          @forelse ($Articles as $Article)
                              <option value="{{ $Article->id }}">{{ $Article->article_name}}</option>
                          @empty
                          @endforelse
                        </select>
                  @endif                  
                  @error('article_name')
                      <div class="text-danger small mt-1">{{ $message }}</div>
                  @enderror
              </div>

              <div class="mb-3">
                  <label class="form-label">Article Description <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" name="article_description" placeholder="Enter Article Description" wire:model.defer="article_description">
                  @error('article_description')
                      <div class="text-danger small mt-1">{{ $message }}</div>
                  @enderror
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary">{{ $updateArticle ? 'Update' : 'Save'}}</button>
          </div>
      </form>
      </div>
  </div>

  <div class="modal modal-blur fade" id="delete_description" tabindex="-1" role="dialog" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
      <form class="modal-content" method="POST" wire:submit.prevent='destroyArticle()'>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        <div class="modal-status bg-danger"></div>
        <div class="modal-body text-center py-4">
          <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-danger icon-lg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 9v2m0 4v.01" /><path d="M5 19h14a2 2 0 0 0 1.84 -2.75l-7.1 -12.25a2 2 0 0 0 -3.5 0l-7.1 12.25a2 2 0 0 0 1.75 2.75" /></svg>
          <h3>Are you sure?</h3>
          <div class="text-muted">Do you really want to delete this article description?</div>
        </div>
        <div class="modal-footer">
          <div class="w-100">
            <div class="row">
              <div class="col"><button type="button" class="btn w-100" data-bs-dismiss="modal">Cancel</button></div>
              <div class="col"> 
                <button type="submit" class="btn btn-danger w-100">Delete</button>  
               </div>
            </div>
          </div>
        </div>
    </form>
    </div>
  </div>

  {{-- 
  <div wire:ignore.self class="modal modal-blur fade" id="delete_pap" tabindex="-1" role="dialog" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
      <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <form class="modal-content" method="POST"     wire:submit.prevent='destroyPAP()'>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          <div class="modal-status bg-danger"></div>
          <div class="modal-body text-center py-4">
            <!-- Download SVG icon from http://tabler-icons.io/i/alert-triangle -->
            <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-danger icon-lg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 9v2m0 4v.01" /><path d="M5 19h14a2 2 0 0 0 1.84 -2.75l-7.1 -12.25a2 2 0 0 0 -3.5 0l-7.1 12.25a2 2 0 0 0 1.75 2.75" /></svg>
            <h3>Are you sure?</h3>
            <div class="text-muted">Do you really want to delete this PAP.</div>
          </div>
          <div class="modal-footer">
            <div class="w-100">
              <div class="row">
                <div class="col"><a href="#" class="btn w-100" data-bs-dismiss="modal">
                    Cancel
                  </a></div>
                <div class="col"> 
                  <button type="submit" class="btn btn-danger w-100">Delete</button>  
                 </div>
              </div>
            </div>
          </div>
      </form>
      </div>
  </div> --}}
</div>
