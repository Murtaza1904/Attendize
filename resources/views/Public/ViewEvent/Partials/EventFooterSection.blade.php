<style>
    #footer {
        background: #000 !important;
    }
</style>
<footer id="footer" class="container-fluid">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                Copyrights &copy; by
                <a class="adminLink " href="{{ route('home') }}">Halal Ribfest</a>. All rights reserved
            </div>
        </div>
    </div>
</footer>
<a href="#intro" style="display:none;" class="totop"><i class="ico-angle-up"></i>
    <span style="font-size:11px;">TOP</span></a>

<script>
    function lang(key, params) {
        /* Line below will generate localization helpers warning, that it will not be included in search.
         * It is understandable, but I have no idea how to turn it off.*/
        var data = {
            "processing": "Just a second...",
            "time_run_out": "You have run out of time! You will have to restart the order process.",
            "just_2_minutes": "You only have 2 minutes left to complete this order!",
            "whoops": "Whoops!, it looks like the server returned an error.\r\n                   Please try again, or contact the webmaster if the problem persists.",
            "whoops2": "Something went wrong! Refresh the page and try again",
            "whoops_and_error": "Whoops!, something has gone wrong.<br><br>:code :error",
            "at_least_one_option": "You must have at least one option.",
            "credit_card_error": "The credit card number appears to be invalid.",
            "expiry_error": "The expiration date appears to be invalid.",
            "cvc_error": "The CVC number appears to be invalid.",
            "card_validation_error": "Please check your card details and try again.",
            "checkin_init_error": "There was an error while initializing scanner. Check if you're connecting through secure page (https) and that your browser supports the scanner."
        };
        var string = data[key];
        if (typeof string == 'undefined')
            return key;
        for (var k in params) {
            string = string.split(":" + k).join(params[k]);
        }
        return string;
    }
</script>
<script src="{{ asset('assets/javascript/frontend.js') }}"></script>
