<div>
    <div class="row">
        <div class="card">
            <ul class="nav nav-tabs mt-2" data-bs-toggle="tabs">
            <li class="nav-item">
                <a href="#tabs-accountname" class="nav-link active" data-bs-toggle="tab">Account Name</a>
            </li>
            <li class="nav-item">
                <a href="#tabs-accountnumber" class="nav-link" data-bs-toggle="tab">Account Number</a>
            </li>
            </ul>
            <div class="card-body">
            <div class="tab-content">
                <div class="tab-pane active show" id="tabs-accountname">
                    <div>
                        
                        @livewire('user.financial-management.account.accountname.index')

                    </div>
                </div>
                <div class="tab-pane" id="tabs-accountnumber">
                    <div>
                        @livewire('user.financial-management.account.accountnumber.index')
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>
