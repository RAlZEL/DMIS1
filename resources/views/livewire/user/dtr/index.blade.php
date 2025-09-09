<div>
    <div class="row row-cards">
        <div class="col-12">
            <div class="card">
                @can('create', App\Models\DTR::class)
                <div class="card-header">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_dtr">
                        Add New DTR
                    </button>
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
                                <input type="text" class="form-control form-control-sm" aria-label="Search"
                                    wire:model='Search'>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-vcenter table-mobile-md card-table">
                        <thead>
                            <tr>
                                <th class="text-center">DTR ID</th>
                                <th class="text-center">First Name</th>
                                <th class="text-center">Middle Name</th>
                                <th class="text-center">Last Name</th>
                                <th class="text-center">DTR Date</th>
                                <th class="text-center">Schedule</th>
                                <th class="text-center">Time</th>
                                <th class="text-center">Late</th>
                                <th class="text-center">Undertime</th>
                                <th class="text-center">Remarks</th>
                                <th class="text-center">Encoded From</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @forelse ($DTRs as $DTR)
                            <tr>

                                <td class="text-center" data-label="DTR ID">{{ $DTR->id }}</td>
                                <td class="text-center" data-label="First Name">{{ $DTR->Employee->firstname }}</td>
                                <td class="text-center" data-label="Middle Name">{{ $DTR->Employee->middlename }}</td>
                                <td class="text-center" data-label="Last Name">{{ $DTR->Employee->lastname }}</td>
                                <td class="text-center" data-label="DTR Date">{{ $DTR->date }}</td>
                                @if ($DTR->schedule == 'TimeInM' )
                                <td class="text-center" data-label="Schedule">Time In - Morning</td>
                                @endif
                                @if ($DTR->schedule == 'TimeOutM')
                                <td class="text-center" data-label="Schedule">Time Out - Morning</td>
                                @endif
                                @if ($DTR->schedule == 'TimeInA' )
                                <td class="text-center" data-label="Schedule">Time In - Afternoon</td>
                                @endif
                                @if ($DTR->schedule == 'TimeOutA' )
                                <td class="text-center" data-label="Schedule">Time Out - Afternoon</td>
                                @endif

                                @if ($DTR->schedule == '1stShift' )
                                <td class="text-center" data-label="Schedule">1st Shift</td>
                                @endif
                                @if ($DTR->schedule == '2ndShift' )
                                <td class="text-center" data-label="Schedule">2nd Shift</td>
                                @endif
                                @if ($DTR->schedule == 'WholeDay' )
                                <td class="text-center" data-label="Schedule">Whole Day</td>
                                @endif
                                @if ($DTR->schedule == 'TRAVEL ORDER' )
                                <td class="text-center" data-label="Schedule">TRAVEL ORDER</td>
                                @endif
                                @if ($DTR->schedule == 'LEAVE' )
                                <td class="text-center" data-label="Schedule">LEAVE</td>
                                @endif
                                @if ($DTR->schedule == 'HOLIDAY' )
                                <td class="text-center" data-label="Schedule">HOLIDAY</td>
                                @endif
                                @if ($DTR->time)
                                <td class="text-center" data-label="Time">{{ date('h:i A', strtotime($DTR->time)) }}
                                </td>
                                @else
                                <td class="text-center" data-label="Time"></td>
                                @endif
                                @if($DTR->late)
                                <td class="text-center" data-label="Late">{{ date('H:i', strtotime($DTR->late)) }}</td>
                                @else
                                <td class="text-center" data-label="Late"></td>

                                @endif

                                @if($DTR->undertime)

                                <td class="text-center" data-label="Undertime">
                                    {{ date('H:i', strtotime($DTR->undertime)) }}</td>
                                @else
                                <td class="text-center" data-label="Undertime"></td>
                                @endif
                                <td class="text-center" data-label="Remarks">{{ $DTR->remarks }}</td>


                                @if($DTR->encoded_from == true)
                                <td class="text-center  text-muted" data-label="Encoded From"> Biometrics</td>
                                @else
                                <td class="text-center  text-muted" data-label="Encoded From"> Manual</td>
                                @endif


                                <td class="text-center">

                                    @can('update', $DTR)
                                    <div class="btn-group">

                                        <a href="" class="btn btn-sm btn-info mt-1"
                                            wire:click.prevent="editDTR({{$DTR->id}})">Update</a>&nbsp;

                                    </div>
                                    @endcan


                                    @can('delete', $DTR)
                                    <div class="btn-group">

                                        <a href="" class="btn btn-sm btn-danger mt-1"
                                            wire:click.prevent="deleteDTR({{$DTR->id}})">Delete</a> &nbsp;

                                    </div>
                                    @endcan




                                </td>

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
                <div class="card-footer d-flex align-items-center">
                    {{ $DTRs->links('livewire::bootstrap') }}
                </div>
            </div>
        </div>
    </div>


    <div wire:ignore.self class="modal modal-blur fade" id="add_dtr" tabindex="-1" role="dialog" aria-hidden="true"
        data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title"> Add Daily Time Record</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="card">
                        <ul class="nav nav-tabs nav-fill" data-bs-toggle="tabs">
                            <li class="nav-item">
                                <a href="#tabs-on-duty" class="nav-link active" data-bs-toggle="tab" wire:ignore>On Duty
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#tabs-absent" class="nav-link" data-bs-toggle="tab" wire:ignore>Absent
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#tabs-event" class="nav-link" data-bs-toggle="tab" wire:ignore>Event
                                </a>
                            </li>
                        </ul>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane active show" id="tabs-on-duty" wire:ignore.self>
                                    <div>
                                        <form method="POST" wire:submit.prevent="addDTR()">




                                            <div class="modal-body">

                                                <div class="mb-3">
                                                    <label class="form-label"> Date</label>
                                                    <input type="date" class="form-control" wire:model="dtrdate">
                                                    <span class="text-danger">
                                                        @error('dtrdate')
                                                        {{ $message }}
                                                        @enderror
                                                    </span>
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label">Employee Name</label>
                                                    <select class="form-select" wire:model="selectedEmployee">
                                                        <option value="" selected>--- Choose Employee ---</option>

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

                                                <div class="dropdown-divider"></div>


                                                <div class="mb-3">
                                                    <label class="form-label">Time Schedule</label>
                                                    <select class="form-select" wire:model="schedule">
                                                        <option value="" selected>--- Choose Time Schedule ---</option>
                                                        <option value="TimeInM">Time In - Morning</option>
                                                        <option value="TimeOutM">Time Out - Morning</option>
                                                        <option value="TimeInA">Time In - Afternoon</option>
                                                        <option value="TimeOutA">Time Out - Afternoon</option>

                                                    </select>
                                                    <span class="text-danger">
                                                        @error('schedule')
                                                        {{ $message }}
                                                        @enderror
                                                    </span>
                                                </div>



                                                <div class="mb-3">
                                                    <label class="form-label">Time</label>
                                                    <input type="time" class="form-control" wire:model="time">
                                                    <span class="text-danger">
                                                        @error('time')
                                                        {{ $message }}
                                                        @enderror
                                                    </span>
                                                </div>

                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn me-auto"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Save</button>
                                            </div>
                                        </form>


                                    </div>
                                </div>
                                <div class="tab-pane" id="tabs-absent" wire:ignore.self>
                                    <div>
                                        <form method="POST" wire:submit.prevent='addAbsent()'>




                                            <div class="modal-body">

                                                <div class="mb-3">
                                                    <label class="form-label"> Date</label>
                                                    <input type="date" class="form-control" wire:model="dtrdateA">
                                                    <span class="text-danger">
                                                        @error('dtrdateA')
                                                        {{ $message }}
                                                        @enderror
                                                    </span>
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label">Employee Name</label>
                                                    <select class="form-select" wire:model="selectedEmployeeA">
                                                        <option value="" selected>--- Choose Employee ---</option>

                                                        @forelse ($Employees as $Employee)
                                                        <option value="{{ $Employee->id }}">
                                                            {{ $Employee->firstname . ' ' . $Employee->middlename . ' ' . $Employee->lastname}}
                                                        </option>
                                                        @empty

                                                        @endforelse

                                                    </select>
                                                    <span class="text-danger">
                                                        @error('selectedEmployeeA')
                                                        {{ $message }}
                                                        @enderror
                                                    </span>
                                                </div>

                                                <div class="dropdown-divider"></div>


                                                <div class="mb-3">
                                                    <label class="form-label">Time Schedule</label>
                                                    <select class="form-select" wire:model="scheduleA">
                                                        <option value="" selected>--- Choose Time Schedule ---</option>
                                                        <option value="1stShift">1st Shift</option>
                                                        <option value="2ndShift">2nd Shift</option>
                                                        <option value="WholeDay">Whole Day</option>


                                                    </select>
                                                    <span class="text-danger">
                                                        @error('scheduleA')
                                                        {{ $message }}
                                                        @enderror
                                                    </span>
                                                </div>



                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn me-auto"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Save</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tabs-event" wire:ignore.self>
                                    <div>
                                        <form method="POST" wire:submit.prevent='addEvent()'>




                                            <div class="modal-body">

                                                <div class="mb-3">
                                                    <label class="form-label"> Date</label>
                                                    <input type="date" class="form-control" wire:model="dtrdateR">
                                                    <span class="text-danger">
                                                        @error('dtrdateR')
                                                        {{ $message }}
                                                        @enderror
                                                    </span>
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label">Employee Name</label>
                                                    <select class="form-select" wire:model="selectedEmployeeR">
                                                        <option value="" selected>--- Choose Employee ---</option>

                                                        @forelse ($Employees as $Employee)
                                                        <option value="{{ $Employee->id }}">
                                                            {{ $Employee->firstname . ' ' . $Employee->middlename . ' ' . $Employee->lastname}}
                                                        </option>
                                                        @empty

                                                        @endforelse

                                                    </select>
                                                    <span class="text-danger">
                                                        @error('selectedEmployeeR')
                                                        {{ $message }}
                                                        @enderror
                                                    </span>
                                                </div>

                                                <div class="dropdown-divider"></div>

                                                <div class="mb-3">
                                                    <label class="form-label">Event Type</label>
                                                    <select class="form-select" wire:model="eventtype">
                                                        <option value="" selected>--- Choose Event Type ---</option>
                                                        <option value="EVENT">EVENT</option>
                                                        <option value="HOLIDAY">HOLIDAY</option>
                                                        <option value="LEAVE">LEAVE</option>
                                                        <option value="TRAVEL ORDER">TRAVEL ORDER</option>

                                                    </select>
                                                    <span class="text-danger">
                                                        @error('eventtype')
                                                        {{ $message }}
                                                        @enderror
                                                    </span>
                                                </div>



                                                @if ($eventtype == 'HOLIDAY')
                                                <div class="mb-3">
                                                    <label class="form-label">Time Schedule</label>
                                                    <select class="form-select" wire:model="scheduleR">
                                                        <option value="" selected>--- Choose Time Schedule ---</option>
                                                        <option value="HOLIDAY" selected>Whole Day</option>
                                                    </select>
                                                    <span class="text-danger">
                                                        @error('scheduleR')
                                                        {{ $message }}
                                                        @enderror
                                                    </span>
                                                </div>
                                                @endif

                                                @if ($eventtype == 'LEAVE')
                                                <div class="mb-3">
                                                    <label class="form-label">Time Schedule</label>
                                                    <select class="form-select" wire:model="scheduleR">
                                                        <option value="" selected>--- Choose Time Schedule ---</option>
                                                        <option value="LEAVE" selected>Whole Day</option>
                                                    </select>
                                                    <span class="text-danger">
                                                        @error('scheduleR')
                                                        {{ $message }}
                                                        @enderror
                                                    </span>
                                                </div>
                                                @endif

                                                @if ($eventtype == 'TRAVEL ORDER')
                                                <div class="mb-3">
                                                    <label class="form-label">Time Schedule</label>
                                                    <select class="form-select" wire:model="scheduleR">
                                                        <option value="" selected>--- Choose Time Schedule ---</option>
                                                        <option value="TRAVEL ORDER">Whole Day</option>
                                                    </select>
                                                    <span class="text-danger">
                                                        @error('scheduleR')
                                                        {{ $message }}
                                                        @enderror
                                                    </span>
                                                </div>
                                                @endif

                                                @if ($eventtype == 'EVENT')
                                                <div class="mb-3">
                                                    <label class="form-label">Time Schedule</label>
                                                    <select class="form-select" wire:model="scheduleR">
                                                        <option value="" selected>--- Choose Time Schedule ---</option>
                                                        <option value="1stShift">1st Shift</option>
                                                        <option value="2ndShift">2nd Shift</option>
                                                        <option value="WholeDay">Whole Day</option>


                                                    </select>
                                                    <span class="text-danger">
                                                        @error('scheduleR')
                                                        {{ $message }}
                                                        @enderror
                                                    </span>
                                                </div>

                                                @endif
                                                @if ($eventtype == 'LEAVE')
                                                <div class="mb-3">
                                                    <label class="form-label">Leave Type</label>
                                                    <select class="form-select" wire:model="remarks">
                                                        <option value="" selected>--- Choose Leave Type ---</option>
                                                        <option value="Vacation Leave">Vacation Leave</option>
                                                        <option value="Mandatory / Forced Leave">Mandatory / Forced
                                                            Leave</option>
                                                        <option value="Sick Leave">Sick Leave</option>
                                                        <option value="Maternity Leave">Maternity Leave</option>
                                                        <option value="Paternity Leave">Paternity Leave</option>
                                                        <option value="Special Privilege Leave">Special Privilege Leave
                                                        </option>
                                                        <option value="Solo Parent Leave">Solo Parent Leave</option>
                                                        <option value="Study Leave">Study Leave</option>
                                                        <option value="10-Day VAWC Leave">10-Day VAWC Leave</option>
                                                        <option value="Rehabilitation Privilege">Rehabilitation
                                                            Privilege</option>
                                                        <option value="Special Leave Benefits for Women">Special Leave
                                                            Benefits for Women</option>
                                                        <option value="Special Emergency Leave (Calamity) Leave">Special
                                                            Emergency Leave (Calamity) Leave</option>
                                                        <option value="Adoption Leave">Adoption Leave</option>

                                                    </select>
                                                    <span class="text-danger">
                                                        @error('remarks')
                                                        {{ $message }}
                                                        @enderror
                                                    </span>
                                                </div>

                                                @else
                                                <div class="mb-3">
                                                    <label class="form-label">Remarks</label>
                                                    <input type="text" class="form-control" wire:model="remarks">
                                                    <span class="text-danger">
                                                        @error('remarks')
                                                        {{ $message }}
                                                        @enderror
                                                    </span>
                                                </div>
                                                @endif




                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn me-auto"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Save</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>


        </div>
    </div>

    <div wire:ignore.self class="modal modal-blur fade" id="delete_dtr" tabindex="-1" role="dialog" aria-hidden="true"
        data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
            <form class="modal-content" method="POST" wire:submit.prevent='destroyDTR()'>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-status bg-danger"></div>
                <div class="modal-body text-center py-4">
                    <!-- Download SVG icon from http://tabler-icons.io/i/alert-triangle -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-danger icon-lg" width="24" height="24"
                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M12 9v2m0 4v.01" />
                        <path
                            d="M5 19h14a2 2 0 0 0 1.84 -2.75l-7.1 -12.25a2 2 0 0 0 -3.5 0l-7.1 12.25a2 2 0 0 0 1.75 2.75" />
                    </svg>
                    <h3>Are you sure?</h3>
                    <div class="text-muted">Do you really want to delete this DTR Entry.</div>
                </div>
                <div class="modal-footer">
                    <div class="w-100">
                        <div class="row">
                            <div class="col"><a href="#" class="btn w-100" data-bs-dismiss="modal">
                                    Cancel
                                </a></div>
                            <div class="col">
                                <button type="submit" class="btn btn-danger w-100">Delete</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <div wire:ignore.self class="modal modal-blur fade" id="update_dtr" tabindex="-1" role="dialog" aria-hidden="true"
        data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title"> Update Daily Time Record</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="card">
                        <ul class="nav nav-tabs nav-fill" data-bs-toggle="tabs">
                            <li class="nav-item">
                                <a href="#tabs-on-duty" class="nav-link active" data-bs-toggle="tab" wire:ignore>On Duty
                                </a>
                            </li>
                        </ul>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane active show" id="tabs-on-duty" wire:ignore.self>
                                    <div>
                                        <form method="POST" wire:submit.prevent='updateDTR()'>




                                            <div class="modal-body">

                                                <div class="mb-3">
                                                    <label class="form-label"> Date</label>
                                                    <input type="date" class="form-control" wire:model="dtrdate"
                                                        readonly>
                                                    <span class="text-danger">
                                                        @error('dtrdate')
                                                        {{ $message }}
                                                        @enderror
                                                    </span>
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label">Employee Name</label>
                                                    <input type="text" class="form-control"
                                                        wire:model="selectedEmployee" readonly>

                                                </div>

                                                <div class="dropdown-divider"></div>


                                                <div class="mb-3">
                                                    <label class="form-label">Time Schedule</label>
                                                    <select class="form-select" wire:model="schedule">
                                                        <option value="" selected>--- Choose Time Schedule ---</option>
                                                        <option value="TimeInM">Time In - Morning</option>
                                                        <option value="TimeOutM">Time Out - Morning</option>
                                                        <option value="TimeInA">Time In - Afternoon</option>
                                                        <option value="TimeOutA">Time Out - Afternoon</option>

                                                    </select>
                                                    <span class="text-danger">
                                                        @error('schedule')
                                                        {{ $message }}
                                                        @enderror
                                                    </span>
                                                </div>



                                                <div class="mb-3">
                                                    <label class="form-label">Time</label>
                                                    <input type="time" class="form-control" wire:model="time">
                                                    <span class="text-danger">
                                                        @error('time')
                                                        {{ $message }}
                                                        @enderror
                                                    </span>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Late <span class="text-danger text-xs">
                                                            Required Format (HH::MM::SS)</span></label>
                                                    <input type="text" class="form-control" wire:model="UpdateLate">

                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Undertime <span
                                                            class="text-danger text-xs"> Required Format
                                                            (HH::MM::SS)</span></label>
                                                    <input type="text" class="form-control"
                                                        wire:model="UpdateUndertime">

                                                </div>

                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn me-auto"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Update</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>


    </div>
</div>

</div>
