
<div class="row">
	<div class="col-lg-12">
		<section class="panel">
			<header class="panel-heading">
                Post Details<a class="btn btn-round pull-right mdm"  href="<?php echo site_url('site/createpost'); ?>"><i class="icon-plus"></i></a>
            </header>
			<div class="drawchintantable">
                <?php $this->chintantable->createsearch("Post List");?>
                <table class="table table-striped table-hover" id="" cellpadding="0" cellspacing="0" >
                <thead>
                    <tr>
                        <th data-field="id">Id</th>
                        <th data-field="text">text</th>
                        <th data-field="timestamp">Timestamp</th>
                        <th data-field="action"> Actions </th>
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
                
                return "<tr><td>" + resultrow.id + "</td><td>" + resultrow.text + "</td><td>" + resultrow.timestamp + "</td><td><a class='btn btn-round btn-xs' href='<?php echo site_url('site/editpost?id=');?>"+resultrow.id +"'><i class='icon-pencil'></i></a><a class='btn btn-round btn-xs' href='<?php echo site_url('site/deletepost?id='); ?>"+resultrow.id +"'><i class='icon-trash '></i></a></td><tr>";
            }
            generatejquery('<?php echo $base_url;?>');
        </script>
	</div>
</div>