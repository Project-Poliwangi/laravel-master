@if ($paginator->hasPages())
    <nav class="d-flex align-items-center justify-content-end mt-3">
        <ul class="pagination">
            @if($paginator->onFirstPage())
                <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
            @else
                <li class="page-item"><a class="page-link" href="{{ $paginator->previousPageUrl() }}">Previous</a></li>
            @endif
            
            @foreach($elements as $element)
                @if(is_string($element))
                    <li class="page-item disabled"><a class="page-link" href="#">{{ $element }}</a></li>
                @endif

                @if(is_array($element))
                    @foreach($element as $page => $url)
                        @if($page === $paginator->currentPage())
                            <li class="page-item active"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                        @else
                            <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach
            
            @if($paginator->hasMorePages())
                <li class="page-item"><a class="page-link" href="{{ $paginator->nextPageUrl() }}">Next</a></li>
            @else
                <li class="page-item disabled"><a class="page-link" href="#">Next</a></li>
            @endif
        </ul>
    </nav>
@else
    <nav class="d-flex align-items-center justify-content-end mt-3">
        <ul class="pagination">
            <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
            <li class="page-item active"><a class="page-link" href="#">1</a></li>
            <li class="page-item disabled"><a class="page-link" href="#">Next</a></li>
        </ul>
    </nav>
@endif
