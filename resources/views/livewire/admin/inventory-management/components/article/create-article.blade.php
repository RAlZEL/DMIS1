<div wire:ignore.self class="modal fade" id="createArticleModal" tabindex="-1" aria-labelledby="createArticleLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createArticleLabel">Add New Article</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form wire:submit.prevent="saveArticle">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Article Name *</label>
                        <input type="text" class="form-control @error('article_name') is-invalid @enderror" 
                               wire:model.defer="article_name" 
                               placeholder="Enter article name..."
                               maxlength="50">
                        @error('article_name') <span class="invalid-feedback">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fa-solid fa-save"></i> Save Article
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
