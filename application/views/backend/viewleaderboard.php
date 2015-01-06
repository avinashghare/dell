<div class="row">
	<div class="col-lg-12">
		<section class="panel">
			<header class="panel-heading">
                Campassadors Details
            </header>
			<div class="drawchintantable">
                <?php $this->chintantable->createsearch("Campassadors List");?>
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
