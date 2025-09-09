<div>
    <form method="POST" wire:submit.prevent="searchDTR()">
        <div class="card">
            <div class="row row-0">
                <div class="col-6">

                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Employee Status</label>
                            <select class="form-select" wire:model="empStatus">
                                <option value="">--- Choose Employee Status ---</option>
                                <option value="CASUAL">Casual</option>
                                <option value="CONTRACTUAL">Contractual</option>
                                <option value="PERMANENT">Permanent</option>
                                <option value="TRAINEE">Trainee</option>

                            </select>
                            <span class="text-danger">
                                @error('empStatus')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Office</label>
                            <select class="form-select" wire:model="SelectedOffice">
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
                            <label class="form-label">Employee Name</label>
                            <select class="form-select" wire:model="selectedEmployee">
                                <option value="" selected>--- Choose Employee Name ---</option>

                                @forelse ($Employees as $Employee)
                                <option value="{{ $Employee->id }}">
                                    {{ $Employee->firstname . ' ' . $Employee->middlename . ' ' . $Employee->lastname}}
                                </option>
                                @empty

                                @endforelse

                            </select>
                            <span class="text-danger">
                                @error('selectedEmployee')
                                {{ $message }}
                                @enderror
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
                    {{-- <a href="user/document-tracking/view/{{$Document->id}}" class="btn btn-sm btn-primary" target="_blank">Search</a> --}}
                </div>
            </div>
        </div>
    </form>


    @if (!is_null($all_dtr))
    <div class="row row-cards mt-1"> 
        <div class="col-12">
            <div class="card">
    
                <div class="card-body border-bottom py-3">
                    <div class="d-flex">
                        <div>
                            Employee Name : <strong>{{ $employeeName }} </strong> 
                            <br>
                            Date Range : <strong> {{ $startdate . ' - ' . $enddate }}</strong>
                        </div>
                       
                        {{-- <button class="btn  btn-secondary ms-auto" wire:click.prevent="markAllPrint" rel="noopener" target="_blank">
                           
                            Print
                          </button> --}}

                          <a href="user/daily-time-record/print/{{$selectedEmployee}},{{$startdate}},{{$enddate}}" class="btn btn-secondary ms-auto" target="_blank">
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
                            <th class="text-center">DTR Date</th>
                            <th class="text-center">Time In Morning</th>
                            <th class="text-center">Time Out Morning</th>
                            <th class="text-center">Time In Afternoon</th>
                            <th class="text-center">Time Out Afternoon</th>
                            <th class="text-center">Late</th>
                            <th class="text-center">Undertime</th>
                            <th class="text-center">Remarks</th>
                        
                        </tr>
                    </thead>
                    <tbody>

                        @forelse ($all_dtr as  $DTR)
                        <tr>  
                            
                            <td class="text-center">{{ $DTR[0] }}</td>
                            @if(!is_null($DTR[1]))
                            <td class="text-center">{{ $DTR[1] }}</td>
                            @else 
                            <td class="text-center text-danger">NO RECORD</td>
                            @endif
                            @if(!is_null($DTR[2]))
                            <td class="text-center">{{ $DTR[2] }}</td>
                            @else 
                            <td class="text-center text-danger">NO RECORD</td>
                            @endif
                            @if(!is_null($DTR[3]))
                            <td class="text-center">{{ $DTR[3] }}</td>
                            @else 
                            <td class="text-center text-danger">NO RECORD</td>
                            @endif
                            @if(!is_null($DTR[4]))
                            <td class="text-center">{{ $DTR[4] }}</td>
                            @else 
                            <td class="text-center text-danger">NO RECORD</td>
                            @endif
                            @if ($DTR[5] != '0')
                            <td class="text-center">{{ $DTR[5] }}</td>
                            @else
                            <td></td>
                            @endif
                            @if ($DTR[6] != '0')
                            <td class="text-center">{{ $DTR[6] }}</td>
                            @else
                            <td></td>
                            @endif
                            <td class="text-center">{{ $DTR[7] }}</td>
 
                        </tr>
                        @empty
                        <tr>
                            <td colspan="10" class="text-center">
                                <span class="text-center text-danger">
                                   No DTR found.
                               </span> 
                           </td>
                        </tr>
                        @endforelse
                  
                        
                    </tbody>
                    </table>
                </div>
             
            </div>
        </div>
    </div>
    @endif


</div>
