<div class="calculator">
    <div class="calculator-loan">
        <div class="thirty form">
            <label>Loan Amount:</label><input type="text" class="amount" value="{{ isset($listing) ? $listing['price'] : '' }}">
            <label>Down Payment:</label><input type="text" class="down" name="down">
            <label>Trade In Price:</label><input type="text" class="trade" name="trade">
        </div>

        <div class="thirty">
            <p><label>Results:</label></p>
            <div class="results"></div>
        </div>
    </div>
</div>


<script src="/js/loan_calculator.js" type="text/javascript"></script>
<script>
    $(document).ready(function () {
        $(".calculator").accrue({'amount': 3000});

    });
</script>