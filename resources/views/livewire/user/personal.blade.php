<div>
    <form action="" method="POST" wire:submit.prevent='UpdateDetails()'>

    <div class="row">

        <div class="col-lg-4">
            <div class="mb-3">
                <label class="form-label">First Name</label>
                <input type="text" class="form-control" name="firstname" placeholder="Enter First Name" wire:model="firstname">
            </div>
            <span class="text-danger"> 
                @error('firstname')
                    {{ $message }}   
                @enderror
            </span>
        </div>

        
        <div class="col-lg-4">
            <div class="mb-3">
                <label class="form-label">Middle Name</label>
                <input type="text" class="form-control" name="middlename" placeholder="Enter Middle Name" wire:model="middlename">
            </div>
            <span class="text-danger"> 
                @error('middlename')
                    {{ $message }}   
                @enderror
            </span>
        </div>

        <div class="col-lg-4">
            <div class="mb-3">
                <label class="form-label">Last Name</label>
                <input type="text" class="form-control" name="lastname" placeholder="Enter Last Name" wire:model="lastname">
            </div>
            <span class="text-danger"> 
                @error('lastname')
                    {{ $message }}   
                @enderror
            </span>
        </div>


    </div>

    <div class="row">

        <div class="col-lg-4">
            <div class="mb-3">
                <label class="form-label">Birth Date</label>
                <input type="date" class="form-control" wire:model="birthdate">
            </div>
            <span class="text-danger"> 
                @error('birthdate')
                    {{ $message }}   
                @enderror
            </span>
        </div>

        
        <div class="col-lg-4">
            <div class="mb-3">
                <label class="form-label">Contact Number </label>
                <input type="number" class="form-control" name="contactnumber" placeholder="Enter Contact Number" wire:model="contactnumber">
            </div>
            <span class="text-danger"> 
                @error('contactnumber')
                    {{ $message }}   
                @enderror
            </span>
        </div>

        <div class="col-lg-4">
            <div class="mb-3">
                <label class="form-label">Email Address</label>
                <input type="email" class="form-control" name="email" placeholder="Enter Email Address" wire:model="email" disabled>
            </div>
            <span class="text-danger"> 
                @error('email')
                    {{ $message }}   
                @enderror
            </span>
        </div>
    </div>
    <div class="col-lg-12">
        <div>
        <label class="form-label">Address</label>
        <textarea class="form-control" rows="3" wire:model="address"></textarea>
        </div>
        <span class="text-danger"> 
            @error('address')
                {{ $message }}   
            @enderror
        </span>
    </div>


    <div class="dropdown-divider"></div>
    <label class="form-label text-center">Employment Information</label>
    <div class="dropdown-divider"></div>
    <div class="col-lg-6">
        <div class="mb-3">
            <label class="form-check form-switch">
            <input class="form-check-input" type="checkbox" name="is_retired" id="is_retired" wire:model="is_retired">
            <span class="form-check-label">Is Retired / Resigned</span>
            </label>
        </div>
        <span class="text-danger"> 
            @error('is_retired')
                {{ $message }}   
            @enderror
        </span>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="mb-3">
                <label class="form-label">Employee Status</label>
                <select class="form-select" wire:model="empstatus">

                        <option value="">--- Choose Employee Status ---</option>
                        <option value="CASUAL">Casual</option>
                        <option value="CONTRACTUAL">Contractual</option>
                        <option value="PERMANENT">Permanent</option>
                        <option value="TRAINEE">Trainee</option>
    
                  
                </select>
            </div>
            <span class="text-danger"> 
                @error('empstatus')
                    {{ $message }}   
                @enderror
            </span>
        </div>
    </div>

    <div class="mb-3">
        <label class="form-label">Employee ID</label>
        <input type="text" class="form-control" name="employeeid" placeholder="Enter Employee ID" wire:model="employeeid">
    </div>
    <span class="text-danger"> 
        @error('employeeid')
            {{ $message }}   
        @enderror
    </span>   

    <div class="row">
        <div class="col-lg-6">
            <div class="mb-3">
                <label class="form-label">Date Hired</label>
                <input type="date" class="form-control" wire:model="datehired">
            </div>
            <span class="text-danger"> 
                @error('datehired')
                    {{ $message }}   
                @enderror
            </span>
        </div>

        <div class="col-lg-6">
            <div class="mb-3">
                <label class="form-label">Position</label>
                <input type="text" class="form-control" name="position" placeholder="Enter Position" wire:model="position">
            </div>
            <span class="text-danger"> 
                @error('position')
                    {{ $message }}   
                @enderror
            </span>
        </div>
    </div>
 
    <div class="mb-3">
        <label class="form-label">Office Assigned</label>
        <input type="text" class="form-control" name="position" placeholder="Enter Position" wire:model="officeid" disabled>
    </div>
    <span class="text-danger"> 
        @error('officeid')
            {{ $message }}   
        @enderror
    </span> 

        <div class="mb-3">
            <label class="form-label">Division Assigned</label>
            <input type="text" class="form-control" name="position" placeholder="Enter Position" wire:model="divisionid" disabled>
        </div>
        <span class="text-danger"> 
            @error('divisionid')
                {{ $message }}   
            @enderror
        </span> 
        
        <div class="mb-3">
            <label class="form-label">Unit Assigned</label>
            <input type="text" class="form-control" name="position" placeholder="Enter Position" wire:model="unitid" disabled>
        </div>
        <span class="text-danger"> 
            @error('unitid')
                {{ $message }}   
            @enderror
        </span> 

    


    <button type="submit" class="btn btn-primary">Save Changes</button>
</form>
</div>
