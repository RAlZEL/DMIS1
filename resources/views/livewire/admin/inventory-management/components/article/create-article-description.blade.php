<div wire:ignore.self class="modal fade" id="createArticleDescriptionModal" tabindex="-1" aria-labelledby="createArticleDescriptionLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createArticleDescriptionLabel">Add Article Description</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form wire:submit.prevent="saveDescription">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Article Name *</label>
                        <select class="form-select @error('article_id') is-invalid @enderror" wire:model.defer="article_id">
                            <option value="">Select Article</option>
                            @foreach($ArticleNameLists as $article)
                                <option value="{{ $article->id }}">{{ $article->article_name }}</option>
                            @endforeach
                        </select>
                        @error('article_id') <span class="invalid-feedback">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description *</label>
                        <textarea class="form-control @error('article_description') is-invalid @enderror" 
                                  wire:model.defer="article_description" 
                                  placeholder="Enter article description..."
                                  rows="3"></textarea>
                        @error('article_description') <span class="invalid-feedback">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fa-solid fa-save"></i> Save Description
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
