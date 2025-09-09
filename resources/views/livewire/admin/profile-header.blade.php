<div>
    <div class="page-header">
        <div class="row align-items-center">
          <div class="col-auto">
            <span class="avatar avatar-md" style="background-image: url({{ asset('/images/user.png')}})"></span>
          </div>
          <div class="col-md-6">
            <h2 class="page-title">{{ $employee->username }}</h2>
            <div class="page-subtitle">
              <div class="row">
                <div class="col-auto">
                  <!-- Download SVG icon from http://tabler-icons.io/i/building-skyscraper -->
                  <!-- SVG icon code -->
                  <a href="#" class="text-reset">Administrator</a>
                </div>
    
              </div>
            </div>
          </div>
          {{-- <div class="col-auto d-md-flex">
            <a href="#" class="btn btn-primary" @disabled(true)>
              <!-- Download SVG icon from http://tabler-icons.io/i/message -->
              <!-- SVG icon code -->
              Change Profile Picture
            </a>
          </div> --}}
        </div>
      </div>
</div>
