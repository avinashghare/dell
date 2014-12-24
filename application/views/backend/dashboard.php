<?php 
if($facebook)
{    ?>
<a href="<?php echo site_url('hauth/login/Facebook');?>" class="btn btn-primary facebooklogin">Facebook Login</a>
<?php } ?>

<?php 
if($twitter)
{    ?>
<a href="<?php echo site_url('hauth/login/Twitter');?>" class="btn btn-primary twitterlogin">Twitter Login</a>
<?php } ?>

<a href="<?php echo site_url('hauth/posttweet');?>" class="btn btn-success">Tweet "Testing"</a>
<a href="<?php echo site_url('hauth/postfb');?>" class="btn btn-warning">Share "Testing"</a>




