<a href="<?php echo site_url('hauth/login/Facebook');?>" class="btn btn-primary facebooklogin">Facebook Login</a>
<a href="<?php echo site_url('hauth/login/Twitter');?>" class="btn btn-primary twitterlogin">Twitter Login</a>





<script>
    var totalauthneeded = 2;

    function reduceauthneeded() {
        totalauthneeded--;
        if (totalauthneeded == 0) {
            console.log("Both way user is logged in");
        }
    }
    $(document).ready(function () {
        console.log("Test");
        $.getJSON("<?php echo site_url('hauth/login/Facebook');?>", function (data) {
            if (data.identifier && data.identifier > 0) {
                $("a.facebooklogin").hide();
                console.log("Users is loggedin using facebook");
                reduceauthneeded();
            } else {
                $("a.facebooklogin").show();
            }
        }).error(function() {
            $("a.facebooklogin").show();
        });
        $.getJSON("<?php echo site_url('hauth/login/Twitter');?>", function (data) {
            if (data.identifier && data.identifier > 0) {
                $("a.twitterlogin").hide();
                console.log("Users is loggedin using Twitter");
                reduceauthneeded();
            } else {
                $("a.twitterlogin").show();
            }
        }).error(function() {
            $("a.twitterlogin").show();
        });;
    });
</script>
