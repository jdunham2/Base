<link rel="stylesheet" href="/css/results.css">
<script src="/js/results.js"></script>

<div id="results_info" class="panel panel-default results-info">

    <div class="number-results">

        Total Results: <span id="numResults">{{ count($total_listings) }}</span>,
        Sort By:

        &nbsp<a class="underline-link black-text"
                  href="{{ currentPage(["order_by" => old("order_by") == "date_old" ? "date" : "date_old"]) }}">
            Date
        </a>
        @if (in_array(old('order_by'), ["date_old", "date"]))
        <img src="/images/{{ old('order_by') == "date_old" ? "up" : "down" }}.png" width="14" height="14" alt=""/>
        @endif

        &nbsp<a class="underline-link black-text"
                  href="{{ currentPage(['order_by' => old("order_by") == "price" ? "price_max" : "price"]) }}">
            Price
        </a>
        @if (in_array(old('order_by'), ["price_max", "price"]))
        <img src="/images/{{ old('order_by') == "price_max" ? "up" : "down" }}.png" width="14" height="14" alt=""/>
        @endif

    </div>

    <form class="results_per_page" method="get" id="pagination">
        <span>
            Results per page:
            <select id="per_page" name="per_page" onchange="modifyPagination(this, '{{ currentPage() }}')">
                <option <?= isSelected('per_page', 10) ?>>10</option>
                <option <?= isSelected('per_page', 25); ?>>25</option>
                <option <?= isSelected('per_page', 50); ?>>50</option>
            </select>
        </span>
    </form>
    <script type="text/javascript">
        $(document).ready(function () {
            var resultNum = $('#numResults')[0].innerText;
            $('#numResults')[0].innerText = resultNum;
        });
    </script>

    <div class="clear"></div>
</div>

