<div>
    <div class="row g-0">
        <div class="col-12">
            <div class="card border-0 shadow-none">
                <ul class="nav nav-tabs border-bottom" role="tablist" data-bs-toggle="tabs">
                    <li class="nav-item" role="presentation">
                        <a href="#tabs-articlename" class="nav-link active" data-bs-toggle="tab" role="tab" aria-selected="true">Article Name</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a href="#tabs-articledescription" class="nav-link" data-bs-toggle="tab" role="tab" aria-selected="false">Article Description</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active show" id="tabs-articlename" role="tabpanel">
                        @livewire('user.inventory-management.article.articlename.index')
                    </div>
                    <div class="tab-pane" id="tabs-articledescription" role="tabpanel">
                        @livewire('user.inventory-management.article.articledescription.index')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
