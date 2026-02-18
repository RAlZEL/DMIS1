<div>
    <div class="table-responsive">
        <table class="table table-sm table-striped">
            <thead class="table-light sticky-top" style="top: 0; z-index: 100;">
                <tr>
                    <th style="width: 5%;">
                        <a href="#" wire:click.prevent="sortBy('id')" class="text-decoration-none">
                            # 
                            @if($sortField === 'id')
                                <i class="fa-solid fa-arrow-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
                            @endif
                        </a>
                    </th>
                    <th style="width: 12%;">
                        <a href="#" wire:click.prevent="sortBy('article_id')" class="text-decoration-none">
                            Article 
                            @if($sortField === 'article_id')
                                <i class="fa-solid fa-arrow-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
                            @endif
                        </a>
                    </th>
                    <th style="width: 15%;">
                        <a href="#" wire:click.prevent="sortBy('property_no')" class="text-decoration-none">
                            Property No. 
                            @if($sortField === 'property_no')
                                <i class="fa-solid fa-arrow-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
                            @endif
                        </a>
                    </th>
                    <th style="width: 12%;">
                        <a href="#" wire:click.prevent="sortBy('unit_value')" class="text-decoration-none">
                            Unit Value 
                            @if($sortField === 'unit_value')
                                <i class="fa-solid fa-arrow-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
                            @endif
                        </a>
                    </th>
                    <th style="width: 15%;">
                        <a href="#" wire:click.prevent="sortBy('accountable_officer')" class="text-decoration-none">
                            Officer 
                            @if($sortField === 'accountable_officer')
                                <i class="fa-solid fa-arrow-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
                            @endif
                        </a>
                    </th>
                    <th style="width: 12%;">
                        <a href="#" wire:click.prevent="sortBy('remarks')" class="text-decoration-none">
                            Remarks 
                            @if($sortField === 'remarks')
                                <i class="fa-solid fa-arrow-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
                            @endif
                        </a>
                    </th>
                    <th style="width: 10%;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($properties as $prop)
                    <tr>
                        <td class="text-muted">{{ $prop->id }}</td>
                        <td>
                            <small class="badge bg-info">
                                {{ $prop->ArticleName->article_name ?? 'N/A' }}
                            </small>
                        </td>
                        <td class="fw-500">{{ $prop->property_no ?? 'N/A' }}</td>
                        <td class="text-end">
                            @if($prop->unit_value)
                                <span class="badge bg-success">₱ {{ number_format($prop->unit_value, 2) }}</span>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td><small>{{ $prop->accountable_officer ?? 'N/A' }}</small></td>
                        <td><small>{{ $prop->remarks ?? 'N/A' }}</small></td>
                        <td>
                            <div class="btn-group btn-group-sm" role="group">
                                <button type="button" class="btn btn-outline-primary" wire:click="editProperty({{ $prop->id }})" title="Edit">
                                    <i class="fa-solid fa-edit"></i>
                                </button>
                                <button type="button" class="btn btn-outline-danger" wire:click="deleteProperty({{ $prop->id }})" title="Delete">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted py-4">
                            <i class="fa-solid fa-inbox"></i> No properties found
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-between align-items-center mt-3">
        <div class="text-muted small">
            Showing {{ $properties->firstItem() ?? 0 }} to {{ $properties->lastItem() ?? 0 }} of {{ $filteredCount }} entries
            @if($totalUnitValue > 0)
                | Total Value: <strong>₱ {{ number_format($totalUnitValue, 2) }}</strong>
            @endif
        </div>
        <nav>
            {{ $properties->links('pagination::bootstrap-4') }}
        </nav>
    </div>
</div>
