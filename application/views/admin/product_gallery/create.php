<div class="page-content"> 
    <div class="content">  
      <!-- BEGIN PAGE TITLE -->
      <div class="page-title">  
        <h2><?php echo $title; ?></h2>   
      </div>
      <!-- END PAGE TITLE -->
      <!-- BEGIN PlACE PAGE CONTENT HERE -->
      <?php 
      $attributes = ['name' => 'formCreate', 'id' => 'formCreate', 'class' => 'dropzone'];
      echo form_open_multipart('', $attributes);
      ?>
        <div class="col-md-14">
              <div class="grid simple">
                <div class="grid-body no-border">
                  <div class="row">
        <div class="col-md-12">
          <div class="grid simple">
            <div class="grid-title no-border">
              &nbsp;
            </div>
            <div class="grid-body no-border">
              <div class="row column-seperation">
                <div class="col-md-6">
                  <h4>Basic Information</h4>            
                  <div class="row form-row">
                    <div class="col-md-12">
                      <input name="gallery_img" id="gallery_img" type="file"  class="form-control">
                    </div>
                  </div>  
                 
                 </div>
                <div class="col-md-6">
                 &nbsp;   
                </div>
              </div>
      
            </div>
          </div>
       <div class="form-actions">
          <button class="btn btn-danger btn-cons" type="submit"><i class="fa fa-save"></i> Save </button>
          <a href="" class="btn btn-primary btn-cons" type="button"><i class="fa fa-times"></i> Cancel </a>
        </div>
        </div>
      </div>
        </div>
          </div>
        </div>
        <?php echo form_close(); ?>
      <!-- END PLACE PAGE CONTENT HERE -->
    </div>
  </div>