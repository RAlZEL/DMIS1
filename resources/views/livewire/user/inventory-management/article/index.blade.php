<div>
    <div class="row">
        <div class="card">
            <ul class="nav nav-tabs mt-2" data-bs-toggle="tabs">
            <li class="nav-item">
                <a href="#tabs-articlename" class="nav-link active" data-bs-toggle="tab">Article Name</a>
            </li>
            <li class="nav-item">
                <a href="#tabs-articledescription" class="nav-link" data-bs-toggle="tab">Article Description</a>
            </li>
            </ul>
            <div class="card-body">
            <div class="tab-content">
                
                <div class="tab-pane active show" id="tabs-articlename">
                    <div>
                        
                        @livewire('user.inventory-management.article.articlename.index')

                    </div>
                </div>

                <div class="tab-pane" id="tabs-articledescription">
                    <div>
                        @livewire('user.inventory-management.article.articledescription.index')
                    </div>
                </div>
                
                </div>
            </div>
            </div>
        </div>
    </div>
</div>
