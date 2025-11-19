@if ($paginator->hasPages())
    <div class="sec-btn text-center mt-3">
        <ul class="wg-pagination justify-content-center">

            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li>
                    <a class="pagination-item text-button disabled"><i class="icon-arrLeft"></i></a>
                </li>
            @else
                <li>
                    <a href="{{ $paginator->previousPageUrl() }}" class="pagination-item text-button">
                        <i class="icon-arrLeft"></i>
                    </a>
                </li>
            @endif

            {{-- Custom Pagination --}}
            @php
                $start = max($paginator->currentPage() - 1, 1);  
                $end = min($start + 2, $paginator->lastPage());

                // fix start when at the end
                if ($end - $start < 2) {
                    $start = max($end - 2, 1);
                }
            @endphp

            @for ($i = $start; $i <= $end; $i++)
                @if ($i == $paginator->currentPage())
                    <li class="active">
                        <div class="pagination-item text-button">{{ $i }}</div>
                    </li>
                @else
                    <li>
                        <a href="{{ $paginator->url($i) }}" class="pagination-item text-button">{{ $i }}</a>
                    </li>
                @endif
            @endfor

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li>
                    <a href="{{ $paginator->nextPageUrl() }}" class="pagination-item text-button">
                        <i class="icon-arrRight"></i>
                    </a>
                </li>
            @else
                <li>
                    <a class="pagination-item text-button disabled"><i class="icon-arrRight"></i></a>
                </li>
            @endif

        </ul>
    </div>
@endif
