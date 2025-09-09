<div>
    @forelse ($attachments as $attachment)
                                <div>
                                  {{ $attachment->attachmentdetails}} - <a href="{{ route('document-tracking.attachmentview', [$attachment->id]) }}" target="_blank">{{ $attachment->attachment}}</a>
                                </div>
                     
       
                            @empty
                        
                                <span class="text-danger">No Attachment</span>
                     
        @endforelse
</div>
