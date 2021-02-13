<div class="bs-stepper">
    <div class="bs-stepper-header" role="tablist">
        @foreach($steps as $key => $label)
            @if($key != 0)
                <div class="line"></div>
            @endif
            <div class="step" data-target="#{{\Str::slug($label)}}">
              <button type="button" class="step-trigger" role="tab" aria-controls="{{\Str::slug($label)}}" id="{{\Str::slug($label)}}-trigger">
                <span class="bs-stepper-circle">{{ $key+1 }}</span>
                <span class="bs-stepper-label">{{ $label }}</span>
              </button>
            </div>
        @endforeach
    </div>
    <div class="bs-stepper-content">
        {{ $slot }}
        @if($buttons)
            <div class="d-flex flex-row justify-content-between">
                 <button class="btn btn-primary {{ \AdminSeven::accentSkin() }}btn-stepper-previous" data-stepper="previous">Previous</button>
                 <button class="btn btn-primary {{ \AdminSeven::accentSkin() }}btn-stepper-next" data-stepper="next">Next</button>
            </div>
        @endif
    </div>
</div>
@push('js')
    <script type="text/javascript">
        if($('.bs-stepper').length > 0){
          var stepper = new Stepper($('.bs-stepper')[0]);
          checkbutton();

          $('.bs-stepper button[data-stepper]').on("click",function(e){
              let step = $(this).data('stepper');
              if(step == 'next'){
                stepper.next();
              }else if(step == 'previous'){
                stepper.previous();
              }else{
                stepper.to(step);
              }
              checkbutton();
          })

          function checkbutton()
          {
            steps = stepper._steps.length;
            current = stepper._currentIndex;
            $(".bs-stepper .btn").removeAttr('disabled');
            if(current <= 0){
                $(".btn-stepper-previous").attr('disabled','disabled');
            }else if(current >= steps-1){
                $(".btn-stepper-next").attr('disabled','disabled');
            }
          }
        }
    </script>
@endpush