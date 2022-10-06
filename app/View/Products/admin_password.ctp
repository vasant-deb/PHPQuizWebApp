<div class="container-fluid main-content">
  <div class="page-title">
    <h1> Change Password
      <?php //echo $title_for_layout?>
    </h1>
  </div>
  <div class="row">
    <div class="col-lg-12">
      <div class="widget-container fluid-height clearfix">
        <div class="heading"> <i class="icon-table"></i>Change Password</div>
        <div class="widget-content padded clearfix">
		 <?php echo $this->Form->create('User', array( "class" => "form-horizontal" )); ?>
		 <?php echo $this->Form->input('id');?>
          <div class="form-group">
           
            <label for="user_password" class="col-sm-2 control-label">Password</label>
            <div class="col-sm-4">
              <?php	echo $this->Form->input('password', array('class'=>'form-control col-md-3','label'=>'','value' => ''));?>
            </div>
          </div>
          
           
           
           
          <div class="form-group text-left">
            <div class="col-sm-offset-2 col-sm-7">
              <button class="btn btn-success" type="submit"><span class="fa fa-refresh"></span>&nbsp;Save</button>
            </div>
          </div>
          <?php echo $this->Form->end(); ?> </div>
      </div>
    </div>
  </div>
</div>
<script>
$('#flashMessage').addClass('alert alert-success');
</script>
