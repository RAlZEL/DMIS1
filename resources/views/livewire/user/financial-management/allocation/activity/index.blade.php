<div>
    <div class="row">
        <div class="card">
            <ul class="nav nav-tabs mt-2" data-bs-toggle="tabs">
            <li class="nav-item">
                <a href="#tabs-details" class="nav-link active" data-bs-toggle="tab">Activity List</a>
            </li>
            <li class="nav-item">
                <a href="#tabs-password" class="nav-link" data-bs-toggle="tab">Allocation(s)</a>
            </li>
            </ul>
            <div class="card-body">
            <div class="tab-content">
                <div class="tab-pane active show" id="tabs-details">
                    <div>
                        
                        @livewire('user.financial-management.allocation.activity.create.index')

                    </div>
                </div>
                <div class="tab-pane" id="tabs-password">
                    <div>
                        @livewire('user.financial-management.allocation.activity.allocation.index')
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>
