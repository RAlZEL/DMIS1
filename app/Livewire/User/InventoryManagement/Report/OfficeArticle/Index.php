<?php

namespace App\Livewire\User\InventoryManagement\Report\OfficeArticle;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Admin\AdminPanel\Category\Office as OfficeCategory;
use App\Models\InventoryManagement\property as Property;
use App\Models\InventoryManagement\article\articlename as ArticleName;

class Index extends Component
{
    use WithPagination;


    protected $queryString = [
        'selectedOfficeId', 'selectedArticleId', 'startdate', 'enddate'
    ];

    protected function rules()
    {
        return [
            'selectedOfficeId' => 'nullable|exists:offices,id',
            'selectedArticleId' => 'nullable|exists:im_article_name,id',
            'startdate' => 'nullable|date',
            'enddate' => 'nullable|date|after_or_equal:startdate',
        ];
    }

    public ?int $selectedOfficeId = null;
    public ?int $selectedArticleId = null;
    public ?string $startdate = null;
    public ?string $enddate = null;
    public array $officeOptions = [];
    public array $articleOptions = [];

    public function mount()
    {
        $this->officeOptions  = OfficeCategory::orderBy('office')->get(['id','office'])->toArray();
        $this->articleOptions = ArticleName::orderBy('article_name')->get(['id','article_name'])->toArray();
    }

        private function queryProperties()
        {
            $q = Property::query()
                ->with(['ArticleName','ArticleDescription', 'employee']);

            if ($this->selectedOfficeId) {
                $q->where('officeid', $this->selectedOfficeId);
            }
            if ($this->selectedArticleId) {
                $q->where('article_id', $this->selectedArticleId);
            }
            if ($this->startdate && $this->enddate) {
                $q->whereBetween('date_acquired', [$this->startdate, $this->enddate]);
            } elseif ($this->startdate) {
                $q->whereDate('date_acquired', '>=', $this->startdate);
            } elseif ($this->enddate) {
                $q->whereDate('date_acquired', '<=', $this->enddate);
            }

            $q->orderBy('date_acquired','desc');
            return $q->paginate(20);
        }

        public function exportCsv()
        {
            $q = Property::query()
                ->with(['ArticleName','ArticleDescription', 'employee']);

            if ($this->selectedOfficeId) {
                $q->where('officeid', $this->selectedOfficeId);
            }
            if ($this->selectedArticleId) {
                $q->where('article_id', $this->selectedArticleId);
            }
            if ($this->startdate && $this->enddate) {
                $q->whereBetween('date_acquired', [$this->startdate, $this->enddate]);
            } elseif ($this->startdate) {
                $q->whereDate('date_acquired', '>=', $this->startdate);
            } elseif ($this->enddate) {
                $q->whereDate('date_acquired', '<=', $this->enddate);
            }

            $q->orderBy('date_acquired','desc');
            $rows = $q->get();

            $headers = [
                'Content-Type' => 'text/csv',
                'Content-Disposition' => 'attachment; filename="inventory_report.csv"',
            ];

            $callback = function() use ($rows) {
                $out = fopen('php://output', 'w');
                fputcsv($out, [
                    'Article Name', 'Description', 'Property No', 'Unit', 'Unit Value', 'Accountable Officer', 'Date Acquired'
                ]);
                foreach ($rows as $row) {
                    fputcsv($out, [
                        optional($row->ArticleName)->article_name ?? '-',
                        optional($row->ArticleDescription)->articledescription ?? '-',
                        $row->property_no ?? '-',
                        $row->unit ?? '-',
                        isset($row->unit_value) ? number_format($row->unit_value, 2) : '-',
                        optional($row->employee)->employeename ?? '-',
                        $row->date_acquired ?? '-',
                    ]);
                }
                fclose($out);
            };

            return response()->stream($callback, 200, $headers);
        }

        public function render()
        {
            $this->validate();
            return view('livewire.user.inventory-management.report.office-article.index', [
                'rows' => $this->queryProperties()
            ]);
        }
    }
