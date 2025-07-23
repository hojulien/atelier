@if ($paginator->hasPages())
    <nav class="flex g-10">
        <ul class="pagination flex flex-f-center g-10">

            <!-- first page link -->
            @if ($paginator->onFirstPage())
                <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <span aria-hidden="true">&lsaquo;&lsaquo;</span>
                </li>
            @else
                <li>
                    <a class="no-link" href="{{ $paginator->url(1) }}" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;&lsaquo;</a>
                </li>
            @endif

            <!-- previous page link -->
            @if ($paginator->onFirstPage())
                <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <span aria-hidden="true">&lsaquo;</span>
                </li>
            @else
                <li>
                    <a class="no-link" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</a>
                </li>
            @endif

            <!-- pagination elements -->
            @foreach ($elements as $element)
                <!-- (...) separator -->
                @if (is_string($element))
                    <li class="disabled" aria-disabled="true"><span>{{ $element }}</span></li>
                @endif

                <!-- array of links -->
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-hover active no-link" aria-current="page"><span>{{ $page }}</span></li>
                        @else
                            <li><a class="no-link" href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            <!-- next page link -->
            @if ($paginator->hasMorePages())
                <li>
                    <a class="no-link" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>
                </li>
            @else
                <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <span aria-hidden="true">&rsaquo;</span>
                </li>
            @endif

            <!-- last page link -->
            @if ($paginator->hasMorePages())
                <li>
                    <a class="no-link" href="{{ $paginator->url($paginator->lastPage()) }}" rel="next" aria-label="@lang('pagination.next')">&rsaquo;&rsaquo;</a>
                </li>
            @else
                <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <span aria-hidden="true">&rsaquo;&rsaquo;</span>
                </li>
            @endif

            <form method="GET" action="{{ url()->current() }}">
                <!-- make all search inputs persist between forms -->
                <input type="hidden" name="search" value="{{ request('search') }}">
                <input type="hidden" name="filter" value="{{ request('filter') }}">
                <input type="hidden" name="sortby" value="{{ request('sortby') }}">
                <input type="hidden" name="order" value="{{ request('order') }}">

                <select name="maps_per_page" class="per_page" id="maps_per_page" onchange="this.form.submit()">
                    <option value="10" @if(request('maps_per_page') == 10) selected @endif>10</option>
                    <option value="25" @if(request('maps_per_page') == 25) selected @endif>25</option>
                    <option value="50" @if(request('maps_per_page') == 50) selected @endif>50</option>
                </select>
                <label for="maps_per_page">maps per page</label>
            </form>
        </ul>
    </nav>
@endif
