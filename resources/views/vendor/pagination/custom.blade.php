@if ($paginator->hasPages())
<ul class="pagination">
    @if ($paginator->onFirstPage())
    <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
        <span href="#0" class="prev">
            <!-- <i class="bi bi-arrow-left-short"></i> -->
        </span>
    </li>
    @else
    <li>
        <a href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')" class="prev">
            <i class="bi bi-arrow-left-short"></i>
</a>
    </li>
    @endif

    @foreach ($elements as $element)
        {{-- "Three Dots" Separator --}}
        @if (is_string($element))
            <li class="disabled" aria-disabled="true"><a>{{ $element }}</a></li>
        @endif

        {{-- Array Of Links --}}
        @if (is_array($element))
            @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                    <li class="active" aria-current="page"><a class="active">{{ $page }}</a></li>
                @else
                    <li><a href="{{ $url }}">{{ $page }}</a></li>
                @endif
            @endforeach
        @endif
    @endforeach

    @if ($paginator->hasMorePages())
        <li>
            <a class="next" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">
                <i class="bi bi-arrow-right-short"></i>
            </a>
        </li>
    @else
        <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
            <span class="next" aria-hidden="true">
                <!-- <i class="bi bi-arrow-right-short"></i> -->
            </span>
        </li>
    @endif
</ul>
@endif