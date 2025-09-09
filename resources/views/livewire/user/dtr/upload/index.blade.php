<div>
   <div class="row row-cards"> 
       <div class="col-12">
           <div class="card">
               @can('upload', App\Models\DTR::class)
               <div class="card-header">
                   <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#upload">
                     <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-upload" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2"></path>
                        <path d="M7 9l5 -5l5 5"></path>
                        <path d="M12 4l0 12"></path>
                     </svg>
                   Upload File
                   </button>
                   @if (count($DTRs) != 0)
                   <button class="btn btn-success ms-auto" data-bs-toggle="modal" data-bs-target="#save">
                     Upload and Save
                     </button>
                  @endif

               </div>

               
               @endcan
       
               <div class="card-body border-bottom py-3">
                   <div class="d-flex">
                   <div class="text-muted">

                       Show
                       <div class="mx-2 d-inline-block">
                           <select class="form-select" wire:model="perPage">
                               <option value="10">10</option>
                               <option value="25">25</option>
                               <option value="50">50</option>
                               <option value="100">100</option>
                           </select>
                       </div>
        
                       entries
                   </div>
                   <div class="ms-auto text-muted">
                       Search:
                       <div class="ms-2 d-inline-block">
                       <input type="text" class="form-control form-control-sm" aria-label="Search" wire:model='Search'>
                       </div>
                   </div>
                   </div>
               </div>
               <div class="table-responsive">
                   <table class="table table-vcenter table-mobile-md card-table">
                   <thead>
                       <tr>
                        <th class="text-center">Employee ID</th> 
                        <th class="text-center">First Name</th>
                        <th class="text-center">Middle Name</th>
                        <th class="text-center">Last Name</th>
                        <th class="text-center">DTR Date</th>
                        <th class="text-center">Schedule</th>
                        <th class="text-center">Time</th>
                        <th class="text-center">Late</th>
                        <th class="text-center">Undertime</th>
                       </tr>
                   </thead>
                   <tbody>

                     @forelse ($DTRs as $DTR)
                     <tr>  
                         <td class="text-center" data-label="Employee ID">{{ $DTR[0] }}</td>
                         <td class="text-center" data-label="First Name">{{ $DTR[1] }}</td>
                         <td class="text-center" data-label="Middle Name">{{ $DTR[2] }}</td>
                         <td class="text-center" data-label="Last Name">{{ $DTR[3] }}</td>
                         <td class="text-center" data-label="DTR Date">{{ $DTR[4] }}</td>
                         <td class="text-center" data-label="Schedule">{{ $DTR[5] }}</td>
                         <td class="text-center" data-label="Time">{{ $DTR[6] }}</td>
                         @if ($DTR[7] != '00:00')
                           <td class="text-center" data-label="Late">{{ $DTR[7] }}</td>
                         @else
                         <td class="text-center" data-label="Late"></td>
                         @endif
                         @if ($DTR[8] != '00:00')
                           <td class="text-center" data-label="Undertime">{{ $DTR[8] }}</td>
                         @else
                         <td class="text-center" data-label="Undertime"></td>
                         @endif
                         
                         {{-- @if ($DTR->schedule == 'TimeInM' )
                         <td class="text-center">Time In - Morning</td>
                         @endif
                         @if ($DTR->schedule == 'TimeOutM')
                         <td class="text-center">Time Out - Morning</td>
                         @endif
                         @if ($DTR->schedule == 'TimeInA' )
                         <td class="text-center">Time In - Afternoon</td>
                         @endif
                         @if ($DTR->schedule == 'TimeOutA' )
                         <td class="text-center">Time Out - Afternoon</td>
                         @endif

                         @if ($DTR->schedule == '1stShift' )
                         <td class="text-center">1st Shift</td>
                         @endif
                         @if ($DTR->schedule == '2ndShift' )
                         <td class="text-center">2nd Shift</td>
                         @endif
                         @if ($DTR->schedule == 'WholeDay' )
                         <td class="text-center">Whole Day</td>
                         @endif
                         @if ($DTR->time)
                         <td class="text-center">{{ date('h:i A', strtotime($DTR->time)) }}</td>
                         @else 
                         <td class="text-center"></td>
                         @endif
                         @if($DTR->late)
                         <td class="text-center">{{ date('H:i', strtotime($DTR->late)) }}</td>
                         @else
                         <td class="text-center"></td>
                       
                         @endif
                         
                         @if($DTR->undertime)
                         <td class="text-center">{{ date('H:i', strtotime($DTR->undertime)) }}</td>
                         @else
                         <td class="text-center"></td>
                         @endif
                         <td class="text-center">{{ $DTR->remarks }}</td>
                 
                      
                      
                             <td class="text-center">
                                 @can('delete', $DTR)
                                 <div class="btn-group">
                                   
                                     <a href="" class="btn btn-sm btn-danger" wire:click.prevent="deleteDTR({{$DTR->id}})">Delete</a>
                          
                                 </div>
                                 @endcan
                             </td> --}}
                         
                     </tr>
                     @empty
                     <tr>
                         <td colspan="9" class="text-center">
                             <span class="text-center text-danger">
                                No DTR to upload.
                            </span> 
                        </td>
                     </tr>
                     @endforelse
                   
                       
                   </tbody>
                   </table>
               </div>
               <div class="card-footer d-flex align-items-center">
                   {{-- {{ $DTRs->links('livewire::bootstrap') }} --}}
               </div>
           </div>
       </div>
   </div>



   <div wire:ignore.self class="modal modal-blur fade" id="save" tabindex="-1" role="dialog" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
       <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
         <form class="modal-content" method="POST"     wire:submit.prevent='addDTR()'>
           <button type="button" class="btn-info" data-bs-dismiss="modal" aria-label="Close"></button>
           <div class="modal-status bg-info"></div>
           <div class="modal-body text-center py-4">
             <!-- Download SVG icon from http://tabler-icons.io/i/alert-triangle -->
             <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-danger icon-lg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 9v2m0 4v.01" /><path d="M5 19h14a2 2 0 0 0 1.84 -2.75l-7.1 -12.25a2 2 0 0 0 -3.5 0l-7.1 12.25a2 2 0 0 0 1.75 2.75" /></svg>
             <h3>Are you sure?</h3>
             <div class="text-muted">Do you  want to Save all data?</div>
           </div>
           <div class="modal-footer">
             <div class="w-100">
               <div class="row">
                 <div class="col"><a href="#" class="btn w-100" data-bs-dismiss="modal">
                     Cancel
                   </a></div>
                 <div class="col"> 
                   <button type="submit" class="btn btn-info w-100">Save</button>  
                  </div>
               </div>
             </div>
           </div>
       </form>
       </div>
     </div>

     
    <div wire:ignore.self class="modal modal-blur fade" id="upload" tabindex="-1" role="dialog" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
      <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
          <form class="modal-content" method="POST" wire:submit.prevent='uploadDTR()'>
              <div class="modal-header">
                  <h5 class="modal-title"> Upload File</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>

              <div class="modal-body">
              
                      
                  <div class="mb-3">
                      <label class="form-label">Device Name</label>
                      <select class="form-select" wire:model="selectedDevice">
                          <option value="" selected>--- Choose Device ---</option>

                          @forelse ($DTRDevices as $Device)
                          <option value="{{ $Device->id }}">
                              {{ $Device->device }}
                          </option>
                          @empty

                          @endforelse

                      </select>
                      <span class="text-danger">
                          @error('selectedDevice')
                          {{ $message }}
                          @enderror
                      </span>
                  </div>

                  <div class="mb-3">
                     <div class="form-label">DTR File </div>
                     <input type="file" class="form-control" wire:model="addDTR">
      
                     <span class="text-danger">
                         @error('addDTR')
                         {{ $message }}
                         @enderror
                     </span>
                 </div>
      
                 @if ($addDTR)
                 <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-check" width="24"
                     height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                     stroke-linecap="round" stroke-linejoin="round">
                     <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                     <path d="M5 12l5 5l10 -10"></path>
                 </svg>
                 Your file is ready to upload!
                 @endif
      
                 <div class="mb-3">
      
                     <div class="form-label" wire:loading wire:target="addDTR">Uploading File</div>
      
                     <div class="progress" wire:loading wire:target="addDTR">
                         <div class="progress-bar progress-bar-indeterminate bg-green text-center" wire:loading
                             wire:target="addDTR"></div>
      
                     </div>
                 </div>

                                  
              </div>
                  
              <div class="modal-footer">
                  <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Save</button>
              </div>
          </form>
        </div>
      </div>
  </div> 


</div>
