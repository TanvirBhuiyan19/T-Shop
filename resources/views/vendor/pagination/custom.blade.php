@if ($paginator->hasPages())
<ul class="pagination" role="navigation" style="margin-top: 0px !important">
    {{-- Previous Page Link --}}
    @if ($paginator->onFirstPage())
        <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
            <span class="page-link" aria-hidden="true">&lsaquo;</span>
        </li>
    @else
        <li class="page-item">
            <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</a>
        </li>
    @endif

    <?php
        $start = $paginator->currentPage() - 1; // show 2 pagination links before current
        $end = $paginator->currentPage() + 1; // show 2 pagination links after current
        if($start < 1) {
            $start = 1; // reset start to 1
            $end += 1;
        } 
        if($end >= $paginator->lastPage() ) $end = $paginator->lastPage(); // reset end to last page
    ?>

    @if($start > 1)
        <li class="page-item">
            <a class="page-link" href="{{ $paginator->url(1) }}">{{1}}</a>
        </li>
        @if($paginator->currentPage() != 3)
            {{-- "Three Dots" Separator --}}
            <li class="page-item disabled" aria-disabled="true"><span class="page-link">...</span></li>
        @endif
    @endif
        @for ($i = $start; $i <= $end; $i++)
            <li class="page-item {{ ($paginator->currentPage() == $i) ? ' active' : '' }}">
                <a class="page-link" href="{{ $paginator->url($i) }}">{{$i}}</a>
            </li>
        @endfor
    @if($end < $paginator->lastPage())
        @if($paginator->currentPage() + 3  != $paginator->lastPage())
            {{-- "Three Dots" Separator --}}
            <li class="page-item disabled" aria-disabled="true"><span class="page-link">...</span></li>
        @endif
        <li class="page-item">
            <a class="page-link" href="{{ $paginator->url($paginator->lastPage()) }}">{{$paginator->lastPage()}}</a>
        </li>
    @endif

    {{-- Next Page Link --}}
    @if ($paginator->hasMorePages())
        <li class="page-item">
            <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>
        </li>
    @else
        <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
            <span class="page-link" aria-hidden="true">&rsaquo;</span>
        </li>
    @endif
</ul>
@endif