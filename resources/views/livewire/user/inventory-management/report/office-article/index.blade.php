
<div class="container">
    <form class="mb-4 row g-2 align-items-end">
        <div class="col-md-3">
            <label for="office" class="form-label">Office</label>
            <select wire:model="selectedOfficeId" id="office" class="form-select">
                <option value="">All Offices</option>
                @foreach($officeOptions as $office)
                    <option value="{{ $office['id'] }}">{{ $office['office'] }}</option>
                @endforeach
            </select>
            @error('selectedOfficeId')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-3">
            <label for="article" class="form-label">Article</label>
            <select wire:model="selectedArticleId" id="article" class="form-select">
                <option value="">All Articles</option>
                @foreach($articleOptions as $article)
                    <option value="{{ $article['id'] }}">{{ $article['article_name'] }}</option>
                @endforeach
            </select>
            @error('selectedArticleId')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-2">
            <label for="startdate" class="form-label">Start Date</label>
            <input type="date" wire:model="startdate" id="startdate" class="form-control">
            @error('startdate')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-2">
            <label for="enddate" class="form-label">End Date</label>
            <input type="date" wire:model="enddate" id="enddate" class="form-control">
            @error('enddate')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-2 d-flex flex-column gap-2">
            <button type="button" class="btn btn-primary w-100" wire:click="$refresh">Filter</button>
            <button type="button" class="btn btn-outline-success w-100" wire:click="exportCsv">Export CSV</button>
        </div>
    </form>

    @if($rows->count())
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Article Name</th>
                        <th>Description</th>
                        <th>Property No</th>
                        <th>Unit</th>
                        <th>Unit Value</th>
                        <th>Accountable Officer</th>
                        <th>Date Acquired</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($rows as $row)
                        <tr>
                            <td>{{ optional($row->ArticleName)->article_name ?? '-' }}</td>
                            <td>{{ optional($row->ArticleDescription)->articledescription ?? '-' }}</td>
                            <td>{{ $row->property_no ?? '-' }}</td>
                            <td>{{ $row->unit ?? '-' }}</td>
                            <td>{{ isset($row->unit_value) ? number_format($row->unit_value, 2) : '-' }}</td>
                            <td>{{ optional($row->employee)->employeename ?? '-' }}</td>
                            <td>{{ $row->date_acquired ?? '-' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-3">
            {{ $rows->links() }}
        </div>
    @else
        <div class="alert alert-info text-center">
            No inventory records found for the selected filters.
        </div>
    @endif
</div>
