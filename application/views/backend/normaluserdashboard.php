<div class="row state-overview fit5"  >
    <div class="col-lg-2 col-sm-2">
        <section class="panel">
            <div class="symbol terques">
                <i class="fa fa-user"></i>
            </div>
            <div class="value">
               <p>Rank </p>
                <h1><?php  echo $studentdash->rank; ?></h1>
                
            </div>
        </section>
    </div>
    <div class="col-lg-2 col-sm-2">
        <section class="panel">
            <div class="symbol terques">
                <i class="fa fa-check-circle"></i>
            </div>
            <div class="value">
               <p>Action Done </p>
                <h1><?php  echo $studentdash->score; ?></h1>
                
            </div>
        </section>
    </div>
   
    <div class="col-lg-2 col-sm-2">
        <section class="panel">
            <div class="symbol terques">
                <i class="fa fa-exclamation-circle"></i>
            </div>
            <div class="value">
               <p>Action Remaining </p>
                <h1><?php  echo $studentdash->remaining; ?></h1>
                
            </div>
        </section>
    </div>
   
    
    <div class="col-lg-2 col-sm-2">
        <section class="panel">
            <div class="symbol terques">
                <i class="fa fa-facebook-square"></i>
            </div>
            <div class="value">
               <p>Facebook</p>
                Likes: <?php echo $studentdash->totallikes; ?><br>
                Share: <?php echo $studentdash->totalshare; ?><br>
                Comments: <?php echo $studentdash->totalcomment; ?><br>
                
            </div>
        </section>
    </div>
    <div class="col-lg-2 col-sm-2">
        <section class="panel">
            <div class="symbol terques">
                <i class="fa fa-twitter"></i>
            </div>
            <div class="value">
               <p>Twitter</p>
                Favourites: <?php echo $studentdash->totalfavourites; ?><br>
                Retweets: <?php echo $studentdash->totalretweet; ?><br>
                
            </div>
        </section>
    </div>
</div>



<div class="row">
	<div class="col-lg-12">
		<section class="panel">
			<div class="drawchintantable">
                <?php $this->chintantable->createsearch("Compassedors List");?>
                <table class="table table-striped table-hover" id="" cellpadding="0" cellspacing="0" >
                <thead>
                    <tr>
<!--                        <th data-field="id">Id</th>-->
                        <th data-field="name">Name</th>
                        <th data-field="score">score</th>
                        <th data-field="rank">rank</th>
                        <th data-field="college">college</th>
                        <th data-field="facebook">facebook</th>
                        <th data-field="twitter">twitter</th>
                    </tr>
                </thead>
                <tbody>
                   
                </tbody>
                </table>
                   <?php $this->chintantable->createpagination();?>
            </div>
		</section>
		<script>
            function drawtable(resultrow) {
                
                return "<tr><td>" + resultrow.name + "</td><td>" + resultrow.score + "</td><td>" + resultrow.rank + "</td><td>" + resultrow.college + "</td><td>" + resultrow.facebook + "</td><td>" + resultrow.twitter + "</td><tr>";
            }
            generatejquery('<?php echo $base_url;?>');
        </script>
	</div>
</div>
