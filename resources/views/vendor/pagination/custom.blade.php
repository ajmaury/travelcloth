@if ($paginator->hasPages())
@if ($paginator->onFirstPage())
  <div class="col-auto">
    <a href="javascript:void(0)" class="button -blue-1 size-40 rounded-full border-light"> <i class="icon-chevron-left text-12"></i> </a>
  </div>
  @else
  <div class="col-auto">
    <a href="{{ $paginator->previousPageUrl() }}" class="button -blue-1 size-40 rounded-full border-light"> <i class="icon-chevron-left text-12"></i> </a>
  </div>
  @endif
  <div class="col-auto">
    <div class="row x-gap-20 y-gap-20 items-center">
    @foreach ($elements as $element)
        @if (is_string($element))
        <div class="col-auto">
          <div class="size-40 flex-center rounded-full">{{ $element }}</div>
        </div>
        @endif
  
        @if (is_array($element))
        @foreach ($element as $page => $url)
        @if ($page == $paginator->currentPage())
        
        <div class="col-auto">
          <div class="size-40 flex-center rounded-full bg-dark-1 text-white"><a>{{ $page }}</a></div>
        </div>
        @else
        <div class="col-auto">
          <div class="size-40 flex-center rounded-full"><a href="{{ $url }}">{{ $page }}</a></div>
        </div>
        @endif
        @endforeach
        @endif
        @endforeach
      
    </div>
  </div>
  @if ($paginator->hasMorePages())
  <div class="col-auto">
    <a href="{{ $paginator->nextPageUrl() }}" class="button -blue-1 size-40 rounded-full border-light"> <i class="icon-chevron-right text-12"></i> </a>
  </div>
  @else
  <div class="col-auto">
    <a href="javascript:void(0)" class="button -blue-1 size-40 rounded-full border-light"> <i class="icon-chevron-right text-12"></i> </a>
  </div>
  @endif
  @endif