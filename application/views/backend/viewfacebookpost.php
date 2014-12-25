
<div class=" row" style="padding:1% 0;">
	<div class="col-md-12">
	
<!--		<a class="btn btn-primary pull-right"  href="<?php echo site_url('site/createcollege'); ?>"><i class="icon-plus"></i>Create </a> &nbsp; -->
	</div>
	
</div>
<div class="row">
	<div class="col-lg-12">
		<section class="panel">
			<header class="panel-heading">
                Facebook Post Details
            </header>
			<div class="drawchintantable">
                <?php $this->chintantable->createsearch("Facebook Post List");?>
                <table class="table table-striped table-hover" id="" cellpadding="0" cellspacing="0" >
                <thead>
                    <tr>
                        <th data-field="id">Id</th>
                        <th data-field="post">post</th>
                        <th data-field="likes">likes</th>
                        <th data-field="share">share</th>
                        <th data-field="text">text</th>
                        <th data-field="timestamp">timestamp</th>
<!--                        <th data-field="action"> Actions </th>-->
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
                
                return "<tr><td>" + resultrow.id + "</td><td>" + resultrow.post + "</td><td>" + resultrow.likes + "</td><td>" + resultrow.share + "</td><td>" + resultrow.text + "</td><td>" + resultrow.timestamp + "</td><tr>";
            }
            generatejquery('<?php echo $base_url;?>');
        </script>
	</div>
</div>
