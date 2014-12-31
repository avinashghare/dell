<div class=" row" style="padding:1% 0;">
	<div class="col-md-10">
	
		<a class="btn btn-round pull-right mdm"  href="<?php echo site_url('site/createuser'); ?>"><i class="icon-plus"></i></a>
	</div>
	<div class="col-md-2">
	
		<a class="btn btn-default"  href="<?php echo site_url('site/uploadusercsv'); ?>"><i class="icon-upload"></i>Upload Users</a> &nbsp; 
	</div>
</div>
<div class="row">
	<div class="col-lg-12">
		<section class="panel">
			
			<div class="drawchintantable">
                <?php $this->chintantable->createsearch("User List");?>
                <table class="table table-striped table-hover" id="" cellpadding="0" cellspacing="0" >
                <thead>
                    <tr>
                        <th data-field="id">Id</th>
                        <th data-field="name">Name</th>
<!--                        <th data-field="username">Username</th>-->
                        <th data-field="email">Email</th>
                        <th data-field="contact">contact</th>
                        <th data-field="dob">dob</th>
                        <th data-field="accesslevelname">accesslevel</th>
<!--                        <th data-field="status">status</th>-->
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
                if(!resultrow.username)
                {
                    resultrow.username="";
                }
                if(!resultrow.accesslevelname)
                {
                    resultrow.accesslevelname="";
                }
                if(!resultrow.json)
                {
                    resultrow.json="";
                }
                return "<tr><td>" + resultrow.id + "</td><td>" + resultrow.name + "</td><td>" + resultrow.email + "</td><td>" + resultrow.contact + "</td><td>" + resultrow.dob + "</td><td>" + resultrow.accesslevelname + "</td><td><a class='btn btn-round btn-xs' href='<?php echo site_url('site/edituser?id=');?>"+resultrow.id +"'><i class='icon-pencil'></i></a><a class='btn btn-round btn-xs' href='<?php echo site_url('site/deleteuser?id='); ?>"+resultrow.id +"'><i class='icon-trash '></i></a></td><tr>";
            }
            generatejquery('<?php echo $base_url;?>');
        </script>
	</div>
</div>
