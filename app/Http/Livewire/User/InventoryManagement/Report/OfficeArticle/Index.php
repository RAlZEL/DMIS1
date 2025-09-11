<?php
namespace App\Http\Livewire\User\InventoryManagement\Report\OfficeArticle;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Response;
use App\Models\InventoryManagement\property as Property;
use App\Models\Admin\AdminPanel\Category\Office as Office;
use App\Models\InventoryManagement\article\articlename as ArticleName;

class Index extends Component
{
    use WithPagination;

    public ?int $selectedOfficeId = null;
    public ?int $selectedArticleId = null;
    public ?string $startdate = null;
    public ?string $enddate = null;
    public array $officeOptions = [];
    public array $articleOptions = [];

    public function mount()
    {
        $this->officeOptions = Office::orderBy('office')->pluck('office', 'id')->toArray();
        $this->articleOptions = ArticleName::orderBy('article_name')->pluck('article_name', 'id')->toArray();
    }

    public function render()
    {
        $rows = Property::query()
            ->when($this->selectedOfficeId, fn($q) => $q->where('officeid', $this->selectedOfficeId))
            ->when($this->selectedArticleId, fn($q) => $q->where('article_id', $this->selectedArticleId))
            ->when($this->startdate, fn($q) => $q->whereDate('date_acquired', '>=', $this->startdate))
            ->when($this->enddate, fn($q) => $q->whereDate('date_acquired', '<=', $this->enddate))
            ->with(['Office', 'ArticleName', 'ArticleDescription'])
            ->paginate(10);

        return view('livewire.user.inventory-management.report.office-article.index', [
            'rows' => $rows,
        ]);
    }
}
