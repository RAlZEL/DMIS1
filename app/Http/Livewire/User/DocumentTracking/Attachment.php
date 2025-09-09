<?php

namespace App\Http\Livewire\User\DocumentTracking;

use App\Models\DocumentTracking\Attachment as DocumentTrackingAttachment;
use Livewire\Component;

class Attachment extends Component
{

    public $attachments;

    protected $listeners = [
        'updateAttachmentList' => '$refresh',
    ];

    
    public function mount($id)
  {
    $this->attachments = DocumentTrackingAttachment::where('documentid', $id)->get();
  }

    public function render()
    {

        // return view('livewire.user.document-tracking.index', [
        //     'Documents' => document::orderby('created_at','desc')->paginate($this->perPage),
        // ]);
        return view('livewire.user.document-tracking.attachment',[
            // 'attachments' =>DocumentTrackingAttachment::where('documentid', $id)->get(),
        ]);
    }
}
