<div>
    <div class="row row-cards"> 
        <div class="col-sm-6 col-lg-4">
            
            <div class="card">
                <div class="card-header">
                    <a href="{{route('mail.userMail') }}"> <h3>Mail - Document Tracking System</h3></a>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <a href="{{route('user.FM') }}"> <h3>Financial Management System</h3></a>

                </div>
                <a href="{{ route('mail.FMMail')}}" ss class="nav-link">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-mail-exclamation mx-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M15 19h-10a2 2 0 0 1 -2 -2v-10a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v5.5"></path>
                        <path d="M3 7l9 6l9 -6"></path>
                        <path d="M19 16v3"></path>
                        <path d="M19 22v.01"></path>
                     </svg>
                      Incoming {{ Str::plural('Voucher', $incomingCount) }}
                      @if ($incomingCount != 0)
                      <span class="badge bg-red mx-2">  {{ $incomingCount }} </span>
                      @endif
     
                  </a>            
                  <a href="{{ route('mail.processingIndexFM')}}" class="nav-link">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-mail-cog mx-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M12 19h-7a2 2 0 0 1 -2 -2v-10a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v5"></path>
                        <path d="M3 7l9 6l9 -6"></path>
                        <path d="M19.001 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                        <path d="M19.001 15.5v1.5"></path>
                        <path d="M19.001 21v1.5"></path>
                        <path d="M22.032 17.25l-1.299 .75"></path>
                        <path d="M17.27 20l-1.3 .75"></path>
                        <path d="M15.97 17.25l1.3 .75"></path>
                        <path d="M20.733 20l1.3 .75"></path>
                     </svg>
                      Processing {{ Str::plural('Voucher', $processingCount)}}
                      @if ($processingCount != 0)
                      <span class="badge bg-red mx-2">  {{ $processingCount }} </span>
                      @endif
                  </a>  
                  <a href="{{ route('mail.outgoingIndexFM')}}" class="nav-link">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-mail-forward mx-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M12 18h-7a2 2 0 0 1 -2 -2v-10a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v7.5"></path>
                        <path d="M3 6l9 6l9 -6"></path>
                        <path d="M15 18h6"></path>
                        <path d="M18 15l3 3l-3 3"></path>
                     </svg>
                      Outgoing {{ Str::plural('Voucher', $outgoingCount) }}
                      @if ($outgoingCount != 0)
                      <span class="badge bg-red mx-2">  {{ $outgoingCount }} </span>
                      @endif
                  </a>  
                  <a href="{{ route('mail.rejectedIndexFM')}}" class="nav-link">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-mail-cancel mx-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M12 19h-7a2 2 0 0 1 -2 -2v-10a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v5"></path>
                        <path d="M19 19m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0"></path>
                        <path d="M17 21l4 -4"></path>
                        <path d="M3 7l9 6l9 -6"></path>
                     </svg>
                      Rejected {{ Str::plural('Voucher',$rejectedCount) }}
                      @if ($rejectedCount != 0)
                      <span class="badge bg-red mx-2">  {{ $rejectedCount }} </span>
                      @endif
                  </a> 
             
          
            </div>

            {{-- @can('viewADAFM', App\Models\FinancialManagement\voucher::class)
        
            <div class="card">
                <div class="card-header">
                    <a href="{{route('mail.ADAFM') }}"> <h3>ADA List(s)</h3></a>
                </div>
            </div>
            @endcan --}}

        </div>



        <div class="col-sm-6 col-lg-8">
     
                @livewire('user.mail.financial-management.incoming')
        
        </div>
      
    </div>
</div>
