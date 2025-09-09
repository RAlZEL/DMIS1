<div>
    <form method="POST" wire:submit.prevent="searchInventory()">
        <div class="card">
            <div class="row row-0">
                <div class="col-6">

                    <div class="card-body">


                        <div class="mb-3">
                            <label class="form-label">Office :</label>
                            <select class="form-select" wire:model="selectedOffice">
                                <option value="" selected>--- Choose Office ---</option>
                                @forelse ($OfficeLists as $Office)
                                <option value="{{ $Office->id }}">
                                    {{ $Office->office}}
                                </option>
                                @empty

                                @endforelse
                            </select>
                            <span class="text-danger">
                                @error('SelectedOffice')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>


                        <div class="mb-3">
                            <label class="form-label">Article :</label>
                            <select class="form-select" wire:model="selectedArticle">
                                <option value="" selected>--- Choose Article Name ---</option>                           
                                @forelse ($articleids as $Article)
                                    <option value="{{ $Article->id }}">{{ $Article->article_name}}</option>   
                                @empty
                                    
                                @endforelse
                            </select>
                            <span class="text-danger">
                               
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card-body">

                        <div class="mb-3">
                            <label class="form-label">Start Date :<span class="text-danger">*</span></label>
                            <input type="date" class="form-control" wire:model="startdate">
                            <span class="text-danger">
                                @error('startdate')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">End Date :<span class="text-danger">*</span></label>
                            <input type="date" class="form-control" wire:model="enddate">
                            <span class="text-danger">
                                @error('enddate')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>
                </div>

            </div>
            <div class="card-footer">
                <div class="d-flex">
                    <button type="submit" class="btn btn-primary ms-auto">Search</button>
                   
                </div>
            </div>
        </div>
    </form>


   
    <div class="row row-cards mt-1"> 
        <div class="col-12">
            <div class="card">
    
                <div class="card-body border-bottom py-3">
                    <div class="d-flex">
                        <div>
                            <br>
                            Date Range : <strong> </strong>
                        </div>
                       
                        {{-- <button class="btn  btn-secondary ms-auto" wire:click.prevent="markAllPrint" rel="noopener" target="_blank">
                           
                            Print
                          </button> --}}

                          <a href="" class="btn btn-secondary ms-auto" target="_blank">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-printer" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2"></path>
                                <path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4"></path>
                                <path d="M7 13m0 2a2 2 0 0 1 2 -2h6a2 2 0 0 1 2 2v4a2 2 0 0 1 -2 2h-6a2 2 0 0 1 -2 -2z"></path>
                             </svg>
                             Print</a> &nbsp;
                          {{-- $this->selectedEmployee,$this->startdate,$this->enddate --}}
                          {{-- <a class="btn ms-auto"
                            href="{{ route('user.UserPrintDTR',[$selectedEmployee, $startdate, $enddate]) }}"
                            rel="noopener" target="_blank">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-printer"
                                width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path
                                    d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2">
                                </path>
                                <path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4"></path>
                                <path d="M7 13m0 2a2 2 0 0 1 2 -2h6a2 2 0 0 1 2 2v4a2 2 0 0 1 -2 2h-6a2 2 0 0 1 -2 -2z">
                                </path>
                            </svg>
                            <span class="mx-2">Print</span>
                        </a>
                     --}}
                    
                    {{-- <div class="ms-auto text-muted">
                        Search:
                        <div class="ms-2 d-inline-block">
                        <input type="text" class="form-control form-control-sm" aria-label="Search" wire:model='Search'>
                        </div>
                    </div> --}}
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap datatable">
                    <thead>
                        <tr>
                            <th class="text-center">No.</th>
                            <th class="text-center">Article/Item</th>
                            <th class="text-center">Description</th>
                            <th class="text-center">Property Number</th>
                            <th class="text-center">Unit Of Measurement</th>
                            <th class="text-center">Unit Value</th>
                            <th class="text-center">Quantity Per Card</th>
                            <th class="text-center">Quantity Per Physical Count</th>
                            <th class="text-center">Remarks</th>
                            <th class="text-center">Accountable Officer</th>
                        
                        </tr>
                    </thead>
                    <tbody>
                  
                    </tbody>
                    </table>
                </div>
             
            </div>
        </div>
    </div>
   


</div>
