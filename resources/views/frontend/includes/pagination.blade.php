@if ($paginator->hasPages())

    <div class="divSecMain dSMPagination">
        <div class="divPagination">
            <ul class="list-unstyled listPagination">
                <!-- Previous Page Link -->
                @if ($paginator->onFirstPage())
                    <li id="pagNavLeft" class="listItemPagination">
                        <i class="fas fa-chevron-left" id="pagNavLeftIcon"></i>
                    </li>
                @else
                    <li id="pagNavLeft" class="listItemPagination">
                        <a href="{{ $paginator->previousPageUrl() }}">
                            <i class="fas fa-chevron-left" id="pagNavLeftIcon"></i>
                        </a>
                    </li>
                @endif


            <!-- Pagination Elements -->
                @foreach ($elements as $element)

                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            <li class="listItemPagination @if($page == $paginator->currentPage()) LIPActive @endif">
                                <a href="{{ $url }}">{{$page}}</a>
                            </li>
                        @endforeach
                    @endif

                @endforeach

            <!-- Next Page Link -->
                @if ($paginator->hasMorePages())
                    <li id="pagNavRight" class="listItemPagination">
                        <a href="{{ $paginator->nextPageUrl() }}">
                            <i class="fa fa-chevron-right" id="pagNavRightIcon"></i>
                        </a>
                    </li>
                @else
                    <li id="pagNavRight" class="listItemPagination">
                        <i class="fa fa-chevron-right" id="pagNavRightIcon"></i>
                    </li>
                @endif

            </ul>
        </div>
    </div>

@endif
