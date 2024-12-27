  <div class="flex items-center gap-2 tooltip-content">
      <img src="{{ $img }}" class="w-32" />
      <div class="flex flex-col gap-2 text-left">
          <p class="mt-2 text-sm font-medium">{{ $title }}</p>

          <div class="flex gap-1">
              <div class="flex flex-col items-center">
                  <div class="text-sm font-medium text-white badge bg-primary">RANK</div>
                  <p class="text-base font-medium ">#{{ $rank }}</p>
              </div>
              <div class="flex flex-col items-center self-end justify-around">
                  <div class="font-medium text-white badge bg-primary">SCORE</div>
                  <p class="font-medium">{{ $score }}</p>
              </div>
          </div>
          <p class="text-sm font-medium">Available on</p>
          @foreach ($services as $service)
              <div class="flex items-center gap-1 ml-2">
                  <img src="{{ asset('images/streaming_services/' . strtolower(str_replace('+', '', $service)) . '-logo.png') }}"
                      class="w-4">
                  <p class="text-sm">{{ $service }}</p>
              </div>
          @endforeach
      </div>
  </div>
