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
                            <a href="/admin/media/create" class="btn btn-primary tip" data-toggle="tooltip" title="Create"><i class="fa fa-plus"></i></a>
                        </div>
                        <?php echo form_open('', ['name' => 'formSearch', 'id' => 'formSearch', 'method' => 'GET']); ?>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <select name="per_page" class="form-control" onchange="javascript:document.forms['formSearch']. submit();">
                                            <option value="15" <?php echo ($this->input->get('per_page') == 'i5') ? 'selected' : null; ?>>15</option>
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
                    </div>
                    <br>
                    <?php if ($medias): ?>
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
                                <th style="width:17%">Media Type</th>
                                <th style="width:17%">Media Image</th>
                                <th style="width:10%">Status</th>
                                <th style="width:10%">Manage</th>
                            </tr>
                        </thead>
                         <tbody>
                            <?php foreach ($medias as $media): ?>
                            <tr>
                                <td>
                                    <div class="checkbox check-default">
                                        <input id="checkbox<?php echo $media->id; ?>" name="media_id[]" class="checkParam" type="checkbox" value="<?php echo $media->id; ?>">
                                        <label for="checkbox<?php echo $media->id; ?>"></label>
                                    </div>
                                </td>
                                <td align="left"><?php echo $media->title; ?></td>
                                <td>category name</td>
                                <td align="center">
                                   <?php if ($media->media_img == 'No image found') : ?>
                                        <img src="/assets/admin/img/no.png" width="100" height="100" class="img-thumbnail" alt="No image found">
                                    <?php else: ?>
                                        <img src="/uploads/<?php echo $media->media_img; ?>" width="100" height="100" class="img-thumbnail">
                                    <?php endif ?>
                                </td>
                                <td>
                                <?php if ($media->status == 'DEACTIVE'): ?>
                                    <a href="/admin/media/status/<?php echo $media->id; ?>" class="singleStatus"><span class="label label-important">Deactive!</span></a>
                                <?php else: ?>
                                    <a href="/admin/media/status/<?php echo $media->id; ?>" class="singleStatus"><span class="label label-info">Active!</span></a>
                                <?php endif ?>
                                </td>
                                <td>
                                    <a href="/admin/media/edit/<?php echo $media->id; ?>" class="label label-info"> <i class="fa fa-edit"></i></a>
                                    <a href="/admin/media/delete/<?php echo $media->id; ?>" class="label label-important singleDelete"> <i class="fa fa-trash-o"></i></a>
                                </td>
                            </tr>
                        <?php endforeach ?>
                        </tbody>
                    </table>
                    <?php echo form_close; ?>
                  
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
                $.post('/admin/media/active_all_Status', fromSerials, function(data){
                    if (data > 0 )
                        window.location.href = '/admin/media';
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
                $.post('/admin/media/deactive_all_Status', fromSerials, function(data){
                    if (data > 0 )
                        window.location.href = '/admin/media';
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
                $.post('/admin/media/delete_all', fromSerials, function(data){
                    if (data > 0 )
                        window.location.href = '/admin/media';
                });
            }
            else
                alert("Select atleast One!")
        });
    });
</script>