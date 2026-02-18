<div>
    <div class="row row-cards g-0">
        <div class="col-12">
            <div class="card border-0 shadow-none">
                <div class="card-header bg-light d-flex align-items-center justify-content-between border-bottom">
                    <div class="d-flex gap-2 align-items-center">
                        <span class="text-muted small">Show</span>
                        <select class="form-select form-select-sm" style="width: auto;" wire:model="perPage">
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                        <span class="text-muted small">entries</span>
                    </div>
                    <div class="d-flex gap-2 align-items-center">
                        <input type="text" class="form-control form-control-sm" style="width: 200px;" aria-label="Search" wire:model='Search' placeholder="Search Article Name">
                        @can('create', App\Models\InventoryManagement\article\articlename::class)
                            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#add_article" title="Add Article" aria-label="Add Article">
                                <i class="fa-solid fa-plus me-1" aria-hidden="true"></i>
                                Add
                            </button>
                        @endcan
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-vcenter table-hover table-striped mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="text-start">Article Name</th>
                                <th class="text-center w-1">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($ArticleNames as $Index => $Articlename)
                                <tr class="align-middle">
                                    <td class="text-start fw-500">{{ $Articlename->article_name }}</td>
                                    <td class="text-center">
                                        @can('update', $Articlename)
                                            <a href="" class="btn btn-sm btn-icon btn-primary" wire:click.prevent="editArticle({{$Articlename->id}})" title="Edit" aria-label="Edit">
                                                <i class="fa-solid fa-pen-to-square" aria-hidden="true"></i>
                            </a>
                                        @endcan
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2" class="text-center py-4">
                                        <span class="text-muted">No articles found</span>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="card-footer border-top d-flex align-items-center">
                    {{ $ArticleNames->links('livewire::bootstrap') }}
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div wire:ignore.self class="modal modal-blur fade" id="add_article" tabindex="-1" role="dialog" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form class="modal-content" wire:submit.prevent="{{ $updateArticle ? 'updateArticle' : 'addArticle' }}">
                <div class="modal-header bg-light border-bottom">
                    <h5 class="modal-title fw-bold mb-0">{{ $updateArticle ? '✏️ Update Article' : '➕ Add Article' }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pt-4">
                    <div class="mb-0">
                        <label class="form-label fw-600 mb-2">Article Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-lg @error('article_name') is-invalid @enderror" 
                               placeholder="Enter article name" wire:model.defer="article_name" autofocus>
                        @error('article_name')
                            <div class="invalid-feedback d-block mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer border-top bg-light">
                    <button type="button" class="btn btn-link text-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                        <span wire:loading.remove>{{ $updateArticle ? 'Update Article' : 'Add Article' }}</span>
                        <span wire:loading><i class="spinner-border spinner-border-sm me-2"></i>Processing...</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>
