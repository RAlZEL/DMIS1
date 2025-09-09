<div>

  {{-- <div class="page-wrapper">
    <div class="container-xl">
      <!-- Page title -->
      <div class="page-header d-print-none">
        <div class="row align-items-center">
          <div class="col">
            <h2 class="page-title">
              Memorandum
            </h2>
          </div>
          <!-- Page title actions -->
          <div class="col-auto ms-auto d-print-none">
            <button type="button" class="btn btn-primary" onclick="javascript:window.print();">
              <!-- Download SVG icon from http://tabler-icons.io/i/printer -->
              <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2"></path><path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4"></path><rect x="7" y="13" width="10" height="8" rx="2"></rect></svg>
              Print 
            </button>
          </div>
        </div>
      </div>
    </div>
    <div class="page-body">
      <div class="container-xl">
        <div class="card card-lg">
          <div class="card-body m-0">

            <div class="card-header">

                    <img src="{{ asset('images/logo.png') }}" class="brand-image img-circle elevation-3" style="height: 80px">
          
                    <div class="mx-4">
                        Republic of the Philippines<br>
                        Department of Environment and Natural Resources<br>
                        <strong>PROVINCIAL ENVIRONMENT AND NATURAL RESOURCES OFFICE</strong><br>
                        MIMAROPA Region

                        
                    </div> 

                   
             
            </div>
            <div class="col-12 text-end mt-2">
                <p class="h3">Date </p>
             
              </div>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>

               
        
  </div> --}}

  <form action="" method="POST" wire:submit.prevent='createMemo()'>
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3>Memorandum Information</h3>
            </div>


            <div class="card-body">
                <ul class="nav nav-tabs show" data-bs-toggle="tabs">
                    <li class="nav-item">
                        <a href="#tabs-information" class="nav-link active" data-bs-toggle="tab" wire.ignore>
                            <!-- Download SVG icon from http://tabler-icons.io/i/home -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-users"
                                width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0"></path>
                                <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                <path d="M21 21v-2a4 4 0 0 0 -3 -3.85"></path>
                            </svg>
                            Heading</a>
                    </li>
                    <li class="nav-item">
                        <a href="#tabs-body" class="nav-link" data-bs-toggle="tab" wire.ignore>
                            <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="icon icon-tabler icon-tabler-file-description" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                                <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z">
                                </path>
                                <path d="M9 17h6"></path>
                                <path d="M9 13h6"></path>
                            </svg>
                            Body</a>
                    </li>
                </ul>
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane active" id="tabs-information">
                            <div>

                                <button class="btn" wire:click.prevent="enableAttention">
                                    {{ $have_attention ? 'Disable Attention' :  'Enable Attention' }}</a></button>
                                <button class="btn"
                                    wire:click.prevent="enableThru">{{ $have_thru ? 'Disable Thru' :  'Enable Thru'}}</a></button>

                                <div class="dropdown-divider"></div>
                                <div class="mb-3">

                                    <div class="row">

                                        <div class="col-4">

                                            <label class="form-label">Date</label>

                                        </div>
                                        <div class="col-8 mb-3">
                                            <div>

                                                <input type="date" class="form-control" wire:model="date">
                                                <span class="text-danger">
                                                    @error('date')
                                                    {{ $message }}
                                                    @enderror
                                                </span>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                                <div class="mb-3">

                                    <div class="row">

                                        <div class="col-4">

                                            <label class="form-label">From</label>
                                            <span class="text-danger">
                                                @error('from')
                                                {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                        <div class="col-8 mb-3">
                                            <div>

                                                <input type="text" class="form-control"
                                                    placeholder="Enter Employee Name / Position"
                                                    wire:model="from_emp">
                                                <span class="text-danger">
                                                    @error('from_emp')
                                                    {{ $message }}
                                                    @enderror
                                                </span>
                                            </div>
                                            <div class="mt-2">

                                                <input type="text" class="form-control"
                                                    placeholder="Enter Position / Address" wire:model="from_pos">
                                                <span class="text-danger">
                                                    @error('from_pos')
                                                    {{ $message }}
                                                    @enderror
                                                </span>
                                            </div>

                                        </div>
                                    </div>

                                </div>

                                <div class="mb-3">

                                    <div class="row">

                                        <div class="col-4">
                                            <datalist id="to_list">
                                                <option value="FOR">
                                                <option value="TO">
                                            </datalist>
                                            <input type="text" list="to_list" class="form-control" wire:model="to"
                                                placeholder="--- Please Choose ---">
                                            <span class="text-danger">
                                                @error('to')
                                                {{ $message }}
                                                @enderror
                                            </span>
                                        </div>

                                        @foreach ($ToEmployees as $index => $ToEmployee)

                                        @if($index != 0)    
                                        <div class="col-4">
                                        </div>
                                        <div class="col-8 mb-2">
                                            <div class="d-flex ">
                                              <div class="col-12">
                                                  <input type="text" class="form-control"
                                                  placeholder="Employee Name / Position"
                                                  wire:model="to_emp.{{ $index }}">    
                               
                                              
                                                  <span class="text-danger">
                                                      @error('to_emp.{{ $index }}')
                                                      {{ $message }}
                                                      @enderror
                                                  </span>
                                          
                                              <div class="mt-2">
                                                <input type="text" class="form-control"
                                                placeholder="Enter Position / Address"
                                                wire:model="to_pos.{{ $index }}">
                                              <span class="text-danger">
                                                  @error('to_pos.{{ $index }}')
                                                  {{ $message }}
                                                  @enderror
                                              </span>
                                              </div>

                                      

                                            </div>
                                     
                                        
                                        </div>
                                        <div class="dropdown-divider mt-2"></div>
                                      </div>
                                 
                                        @else

                                        <div class="col-8 mb-2">
                                            
                                            <div>

                                                <input type="text" class="form-control"
                                                    placeholder="Employee Name / Position"
                                                    wire:model="to_emp.{{ $index }}">
                                                <span class="text-danger">
                                                    @error('to_emp.{{ $index }}')
                                                    {{ $message }}
                                                    @enderror
                                                </span>
                                            </div>
                                            <div class="mt-2">

                                                <input type="text" class="form-control"
                                                    placeholder="Enter Position / Address"
                                                    wire:model="to_pos.{{ $index }}">
                                                <span class="text-danger">
                                                    @error('to_pos.{{ $index }}')
                                                    {{ $message }}
                                                    @enderror
                                                </span>
                                            </div>
                                            <div class="dropdown-divider mt-2"></div>
                                        </div>

                                        @endif

                                        @endforeach

                                  


                                        <div class="col-4">

                                        </div>

                                        <div class="col-8 mb-3">
                                
                                            @if($ToIndex != 1)
                                            <button type="button" class="btn btn-danger col-12 mb-2"
                                                wire:click.prevent="removeTo({{$ToIndex}})"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-minus" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                  <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                  <path d="M5 12l14 0"></path>
                                                </svg>
                                                  Remove
                                                  </button>
                                            @endif
                                            

                                            <button type="button" class="btn btn-primary col-12"
                                                wire:click.prevent="addTo">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="icon icon-tabler icon-tabler-plus" width="24" height="24"
                                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                    fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                    <path d="M12 5l0 14"></path>
                                                    <path d="M5 12l14 0"></path>
                                                </svg>
                                                Add
                                            </button>

                                        </div>

                                    </div>
                                </div>

                         </div>

                                
                        </div>
                        <div class="tab-pane" id="tabs-body">
                            <div>

                                <div class="mb-3" wire:ignore>
                                    <input class="form-control" id="memo_body" wire:model="body"
                                    wire.ignore.self></input>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-footer">
                <div class="d-flex">
                    <button type="submit" class="btn btn-primary ms-auto">Create</a>
                </div>
            </div>

        </div>
    </div>
</div>

</form>


</div>
