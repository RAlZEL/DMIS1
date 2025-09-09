<div>
    <div class="card">
        <div class="card-header">
          <h3 class="card-title"> 
            Incoming {{ Str::plural('Voucher',$IncomingLists->count()) }}
          </h3>
        </div>
        <div class="card-body border-bottom py-3">
          <div class="d-flex">
            {{-- <div class="text-muted">
              Show
              <div class="mx-2 d-inline-block">
                <input type="text" class="form-control form-control-sm" value="8" size="3" aria-label="Invoices count">
              </div>
              entries
            </div> --}}
            @if ($IncomingLists->count() !=0 && $selectedRows)
            <div class=" text-muted">
              <button id="btnGroupDrop1" type="button" class="btn dropdown-toggle btn-sm" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                Action
              </button>
                <div class="dropdown-menu dropdown-menu-end" data-popper-placement="bottom-end" style="position: absolute; inset: 0px 0px auto auto; margin: 0px; transform: translate3d(-0.222214px, 38px, 0px);">
                    
                  <a class="dropdown-item" wire:click.prevent="markAllAccept">
                    Accept {{ Str::plural('Voucher', count($selectedRows)) }}
                  </a>
                  <a class="dropdown-item" wire:click.prevent="markAllReject">
                    Reject {{ Str::plural('Voucher', count($selectedRows)) }}
                  </a>
                  <a class="dropdown-item" wire:click.prevent="markAllPrint">
                    Print Manifest
                  </a>
                </div>
        
              </div>
              <div class="text-muted btn-sm">
                <span class="mx-2 text-sm"> selected {{ count($selectedRows) }}  {{ Str::plural('Voucher', count($selectedRows)) }}</span>
              </div>    
            @endif
            
        
        
            <div class="ms-auto text-muted">
              Search:
              <div class="ms-2 d-inline-block">
                <input type="text" class="form-control form-control-sm" aria-label="Search invoice" wire:model='Search'>
              </div>
            </div>

        
          </div>
        </div>
        <div class="table-responsive">
          <table class="table table-vcenter table-mobile-md card-table">
            <thead>
              <tr>
                <th class="w-1"><input class="form-check-input m-0 align-middle" type="checkbox" aria-label="Select all invoices" wire:model="selectedPageRows"></th>
                <th class="w-1">Sequence ID <!-- Download SVG icon from http://tabler-icons.io/i/chevron-up -->
                  {{-- <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-sm text-dark icon-thick" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><polyline points="6 15 12 9 18 15"></polyline></svg> --}}
                </th>
                <th>Particulars</th>
                <th>Amount</th>
                <th>Route From</th>
                <th></th>
                {{-- <th></th> --}}
    
              </tr>
            </thead>
            <tbody>
        
                @forelse ($IncomingLists as $List)
                <tr>
                <td><input class="form-check-input m-0 align-middle" type="checkbox" aria-label="Select invoice" id="{{ $List->id }}" value="{{$List->id}}" wire:model="selectedRows"></td>
                <td class="text-muted">{{ $List->sequenceid }}</td>
                <td>
                    <a href="user/Financial-Management/view/{{$List->id}}" tabindex="-1" target="_blank">{{ $List->particulars}}
                    </a>
                </td>
                <td class="text-muted">{{ number_format($List->amount,2,'.',',') }}</td>
  
                <td class="text-muted">{{ $List->fromoffice->office . ' - ' . $List->fromunit->unit}} <span class="text-muted"><i><span class="btn-sm">by {{ $List->fromuser->username}}</span></i></span></td>
                <td class="text-muted"><span class="btn-sm">{{ $List->updated_at->diffforhumans()}}</span></td>
                   
                    </tr>

             
                @empty
                <tr>
                    <td colspan="6" class="text-center text-muted">No Incoming Voucher</td>
                </tr>
                  
                @endforelse
        
            </tbody>
          </table>
    
        </div>
        <div class="card-footer d-flex align-items-center">
        
          {{ $IncomingLists->links('livewire::bootstrap') }}
        </div>
    </div>


</div>
