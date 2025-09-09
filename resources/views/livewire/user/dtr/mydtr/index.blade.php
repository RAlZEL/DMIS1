<div>
    <form method="POST" wire:submit.prevent="searchDTR()">
        <div class="card">
            <div class="row row-0">
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
                    </div>
                </div>
                <div class="col-6">
                    <div class="card-body">


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


    @if (!is_null($all_dtr))
    <div class="row row-cards mt-1"> 
        <div class="col-12">
            <div class="card">

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
                            
                            <td class="text-center" data-label="DTR Date">{{ $DTR[0] }}</td>
                            @if(!is_null($DTR[1]))
                            <td class="text-center" data-label="Time In Morning">{{ $DTR[1] }}</td>
                            @else 
                            <td class="text-center text-danger" data-label="Time In Morning">NO RECORD</td>
                            @endif
                            @if(!is_null($DTR[2]))
                            <td class="text-center" data-label="Time Out Morning">{{ $DTR[2] }}</td>
                            @else 
                            <td class="text-center text-danger" data-label="Time Out Morning">NO RECORD</td>
                            @endif
                            @if(!is_null($DTR[3]))
                            <td class="text-center" data-label="Time In Afternoon">{{ $DTR[3] }}</td>
                            @else 
                            <td class="text-center text-danger" data-label="Time In Afternoon">NO RECORD</td>
                            @endif
                            @if(!is_null($DTR[4]))
                            <td class="text-center" data-label="Time Out Afternoon">{{ $DTR[4] }}</td>
                            @else 
                            <td class="text-center text-danger" data-label="Time Out Afternoon">NO RECORD</td>
                            @endif
                            @if ($DTR[5] != '0')
                            <td class="text-center" data-label="Late">{{ $DTR[5] }}</td>
                            @else
                            <td></td>
                            @endif
                            @if ($DTR[6] != '0')
                            <td class="text-center" data-label="Undertime">{{ $DTR[6] }}</td>
                            @else
                            <td></td>
                            @endif
                            <td class="text-center" data-label="Remarks">{{ $DTR[7] }}</td>
 
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
