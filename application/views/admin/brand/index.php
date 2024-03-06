<div class="page-content">
    <div class="content">
        <!-- BEGIN PAGE TITLE -->
        <div class="page-title">
            <h2><?php echo $title; ?></h2>
        </div>
        <!-- END PAGE TITLE -->
        <!-- BEGIN PlACE PAGE CONTENT HERE -->
        <div class="col-md-14">
            <div class="grid simple ">
                <div class="grid-body no-border">
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <a href="#" id="activeAllStatus" class="btn btn-primary tip" data-toggle="tooltip" title="Active Selected"><i class="fa fa-eye"></i></a>
                            <a href="#" id="deactiveAllStatus" class="btn btn-primary tip" data-toggle="tooltip" title="Deactive Selected"><i class="fa fa-eye-slash"></i></a>
                            <a href="#" id="deleteAll" class="btn btn-primary tip" data-toggle="tooltip" title="Delete Selected"><i class="fa fa-trash"></i></a>
                            <a href="/admin/brand/create" class="btn btn-primary tip" data-toggle="tooltip" title="Create"><i class="fa fa-plus"></i></a>
                        </div>
                        <?php echo form_open('', ['name' => 'formSearch', 'id' => 'formSearch', 'method' => 'GET']); ?>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <select name="per_page" class="form-control" onchange="javascript:document.forms['formSearch'].submit();">
                                            <option value="15" <?php echo ($this->input->get('per_page') == '15') ? 'selected' : null; ?>>15</option>
                                            <option value="25" <?php echo ($this->input->get('per_page') == '25') ? 'selected' : null; ?>>25</option>
                                            <option value="50" <?php echo ($this->input->get('per_page') == '50') ? 'selected' : null; ?>>50</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <input type="text" name="q" class="form-control" placeholder="Search" value="<?php echo $this->input->get('q'); ?>">
                                        <span class="input-group-btn">
                                            <button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-search" aria-hidden="true"></i></button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                        
                    <br>
                        <?php if ($brands): ?>
                      <?php echo form_open('', ['name' => 'formView', 'id' => 'formView']); ?>
                      <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th style="width:1%">
                                    <div class="checkbox check-default">
                                        <input id="checkbox" type="checkbox" value="1" class="checkall">
                                        <label for="checkbox"></label>
                                    </div>
                                </th>
                                <th style="width:40%">Title</th>
                                <th style="width:10%">Brand Image</th>
                                <th style="width:10%">Status</th>
                                <th style="width:10%">Manage</th>
                            </tr>
                            </thead>
                        <tbody>
                            <?php foreach ($brands as $brand): ?>
                            <tr>
                                <td>
                                    <div class="checkbox check-default">
                                        <input id="checkbox<?php echo $brand->id; ?>" name="brand_id[]" class="checkParam" type="checkbox" value="<?php echo $brand->id; ?>">
                                        <label for="checkbox<?php echo $brand->id; ?>"></label>
                                    </div>
                                </td>
                                <td><?php echo $brand->title; ?></td>
                                <td align="center">
                                    <?php if ($brand->brand_img == 'No image found') : ?>
                                        <img src="/assets/admin/img/no-img.jpg" width="100" height="100" class="img-thumbnail" alt="No image found">
                                    <?php else: ?>
                                        <img src="/uploads/<?php echo $brand->brand_img; ?>" width="100" height="100" class="img-thumbnail" alt="<?php echo $brand->title; ?>">
                                    <?php endif ?>
                                </td>
                                <td>
                                    <?php if ($brand->status == 'DEACTIVE'): ?>
                                        <a href="/admin/brand/status/<?php echo $brand->id; ?>" class="singleStatus"><span class="label label-important">Deactive</span></a>
                                    <?php else: ?>
                                        <a href="/admin/brand/status/<?php echo $brand->id; ?>" class="singleStatus"><span class="label label-info">Active</span></a>
                                    <?php endif ?>
                                 </td>
                                <td>
                                    <a href="/admin/brand/edit/<?php echo $brand->id; ?>" class="label label-info"> <i class="fa fa-edit"></i></a>
                                    <a href="/admin/brand/delete/<?php echo $brand->id; ?>" class="label label-important singleDelete"> <i class="fa fa-trash-o"></i></a>    
                                </td>
                            </tr>
                            <?php endforeach ?>

                        </tbody>
                        </table>
                        <?php echo form_close(); ?>
                    
                    <?php echo $this->pagination->create_links(); ?>

                    <?php else: ?>
                        <div class="alert alert-info">
                            <strong>Info!</strong> No Record Found!
                        </div>
                    <?php endif ?>

                </div>
            </div>
        </div>
        <!-- END PLACE PAGE CONTENT HERE -->
    </div>
</div>

<script>
    $(document).ready(function() {
        // SINGLE STATUS
        $(".singleStatus").on('click', function(event) {
            event.preventDefault(); // disable link functionality.
            
            var self = $(this);
            var href = self.attr('href');
            
            self.html('<img src="/assets/admin/img/ajax-loader.jpg" width="36">');

            $.get(href, function(response) {
                if (response == 'ACTIVE') 
                    self.html('<span class="label label-info">Active</span>');
                else
                    self.html('<span class="label label-important">Deactive</span>');
            });
        });
        
        // SINGLE DELETE
        $(".singleDelete").on('click', function(event) {
            event.preventDefault();

            if (confirm('Are you sure you want to delete this?')) 
            {
                var self = $(this);
                var href = self.attr('href');

                self.html('<img src="/assets/admin/img/ajax-loader.jpg" width="36">');

                $.get(href, function(response) {
                    if (response > 0) 
                    {
                        self.closest('tr').css('background-color', '#e6efe7').fadeOut(1000);
                        self.remove();      
                    }
                });
            }
            else
                return false;
        });

        $("#activeAllStatus").on('click', function(event) {
            event.preventDefault();

            if($(".checkParam:checked").length > 0)
            {
                var fromSerials = $("#formView").serialize();
                $.post('/admin/brand/active_all_Status', fromSerials, function(data){
                    if (data > 0 )
                        window.location.href = '/admin/brand';
                });
            }
            else
                alert("Select atleast One!")
        });

         $("#deactiveAllStatus").on('click', function(event) {
            event.preventDefault();

            if($(".checkParam:checked").length > 0)
            {
                var fromSerials = $("#formView").serialize();
                $.post('/admin/brand/deactive_all_Status', fromSerials, function(data){
                    if (data > 0 )
                        window.location.href = '/admin/brand';
                });
            }
            else
                alert("Select atleast One!")
        });

          $("#deleteAll").on('click', function(event) {
            event.preventDefault();

            if($(".checkParam:checked").length > 0)
            {
                var fromSerials = $("#formView").serialize();
                $.post('/admin/brand/delete_all', fromSerials, function(data){
                    if (data > 0 )
                        window.location.href = '/admin/brand';
                });
            }
            else
                alert("Select atleast One!")
        });
    });
</script>