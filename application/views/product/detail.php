<?php $this->load->view('partials/header'); ?> 

<div id="container">
    <div class="container">
      <!-- Breadcrumb Start-->
      <ul class="breadcrumb">
        <li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="index.html" itemprop="url"><span itemprop="title"><i class="fa fa-home"></i></span></a></li>
        <li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="category.html" itemprop="url"><span itemprop="title">Electronics</span></a></li>
        <li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="product.html" itemprop="url"><span itemprop="title">Laptop Silver black</span></a></li>
      </ul>
      <!-- Breadcrumb End-->
      <div class="row">
        <!--Middle Part Start-->
        <div id="content" class="col-sm-9">
          <div itemscope itemtype="http://schema.org/Product">
            <h1 class="title" itemprop="name"><?php echo $product->title; ?></h1>
            <div class="row product-info">
              <div class="col-sm-6">
                <div class="image"><img class="img-responsive"  src="/uploads/<?php echo $product->product_img; ?>" title="Laptop Silver black" alt="Laptop Silver black"  /> </div>
                
                <div class="image-additional" id="gallery_01">
                  <?php $getGalleries = $this->gallery->get_gallery_by($product->id); ?>
                  <?php foreach ($getGalleries as $gallery): ?>
                    <a class="thumbnail" href="#" > <img src="/uploads/<?php echo $gallery->gallery_img ?>" width="66" height="66" title="<?php echo $product->title; ?>" alt = "<?php echo $product->title; ?>"/></a>
                  <?php endforeach ?>
                  </div>
              </div>
              <div class="col-sm-6">
                <ul class="list-unstyled description">
                  <li><b>Brand:</b> <a href="#"><span itemprop="brand">Apple</span></a></li>
                  <li><b>Product Code:</b> <span itemprop="mpn"><?php echo $product->code; ?></span></li>
                  <li><b>Views:</b> <?php echo $product->views; ?></li>
                </ul>
                <ul class="price-box">
                  <li class="price" itemprop="offers" itemscope itemtype="http://schema.org/Offer"> <span itemprop="price"><?php echo number_format($product->price); ?></span></li>
                </ul>
              
                
                <hr>
                
              </div>
            </div>
            <ul class="nav nav-tabs">
              <li class="active"><a href="#tab-description" data-toggle="tab">Description</a></li>
              <li><a href="#tab-specification" data-toggle="tab">Specification</a></li>
              <li><a href="#tab-review" data-toggle="tab">Reviews (2)</a></li>
            </ul>
            <div class="tab-content">
              <div itemprop="description" id="tab-description" class="tab-pane active">
                <div>
                  <p><?php echo $product->description; ?></p>
         
                </div>
              </div>
              <div id="tab-specification" class="tab-pane">
                <table class="table table-bordered">
                <tr>
                  <td><strong>Processor Type</strong></td>
                  <td><?php echo $product->processor_type ?></td>
                  </tr>
                  <tr>
                  <td><strong>Processor Speed</strong></td>
                  <td><?php echo $product->processor_speed ?></td>
                  </tr>
                  <tr>
                  <td><strong>Hard Drive Size</strong></td>
                  <td><?php echo $product->hard_drive_size ?></td>
                  </tr>
                  <tr>
                  <td><strong>Installed Ram</strong></td>
                  <td><?php echo $product->installed_ram ?></td>
                  </tr>
                  <tr>
                  <td><strong>Screen Size</strong></td>
                  <td><?php echo $product->screen_size ?></td>
                  </tr>
                  <tr>
                  <td><strong>Operating System</strong></td>
                  <td><?php echo $product->operating_system ?></td>
                  </tr>
                  <tr>
                  <td><strong>Colors</strong></td>
                  <td><?php echo $product->colors ?></td>
                  </tr>
                  <tr>
                  <td><strong>Lan</strong></td>
                  <td><?php echo $product->lan ?></td>
                  </tr>
                  <tr>
                  <td><strong>Bluetooth</strong></td>
                  <td><?php echo $product->bluetooth ?></td>
                  </tr>
                  <tr>
                  <td><strong>Modem</strong></td>
                  <td><?php echo $product->modem ?></td>
                  </tr>
                  <tr>
                  <td><strong>Camera</strong></td>
                  <td><?php echo $product->camera ?></td>
                  </tr>
                  <tr>
                  <td><strong>WiFi</strong></td>
                  <td><?php echo $product->wifi ?></td>
                  </tr>
                 </table>
              </div>
              <div id="tab-review" class="tab-pane">
                <form class="form-horizontal">
                  <div id="review">
                    <div>
                      <table class="table table-striped table-bordered">
                        <tbody>
                          <tr>
                            <td style="width: 50%;"><strong><span>harvey</span></strong></td>
                            <td class="text-right"><span>20/01/2016</span></td>
                          </tr>
                          <tr>
                            <td colspan="2"><p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                              <div class="rating"> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> </div></td>
                          </tr>
                        </tbody>
                      </table>
                      <table class="table table-striped table-bordered">
                        <tbody>
                          <tr>
                            <td style="width: 50%;"><strong><span>Andrson</span></strong></td>
                            <td class="text-right"><span>20/01/2016</span></td>
                          </tr>
                          <tr>
                            <td colspan="2"><p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                              <div class="rating"> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span> </div></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    <div class="text-right"></div>
                  </div>
                  <h2>Write a review</h2>
                  <div class="form-group required">
                    <div class="col-sm-12">
                      <label for="input-name" class="control-label">Your Name</label>
                      <input type="text" class="form-control" id="input-name" value="" name="name">
                    </div>
                  </div>
                  <div class="form-group required">
                    <div class="col-sm-12">
                      <label for="input-review" class="control-label">Your Review</label>
                      <textarea class="form-control" id="input-review" rows="5" name="text"></textarea>
                      <div class="help-block"><span class="text-danger">Note:</span> HTML is not translated!</div>
                    </div>
                  </div>
                  <div class="form-group required">
                    <div class="col-sm-12">
                      <label class="control-label">Rating</label>
                      &nbsp;&nbsp;&nbsp; Bad&nbsp;
                      <input type="radio" value="1" name="rating">
                      &nbsp;
                      <input type="radio" value="2" name="rating">
                      &nbsp;
                      <input type="radio" value="3" name="rating">
                      &nbsp;
                      <input type="radio" value="4" name="rating">
                      &nbsp;
                      <input type="radio" value="5" name="rating">
                      &nbsp;Good</div>
                  </div>
                  <div class="buttons">
                    <div class="pull-right">
                      <button class="btn btn-primary" id="button-review" type="button">Continue</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
            <h3 class="subtitle">Related Products</h3>
            <div class="owl-carousel related_pro">
              <?php foreach ($relatedProducts as $relatedProduct) : ?>                

              <div class="product-thumb">
                <div class="image"><a href="<?php echo '/product/' . $relatedProduct->slug; ?>"><img src="/uploads/<?php echo $relatedProduct->product_img ?>" width="200" height="200" alt="<?php echo $relatedProduct->title; ?>" title="<?php echo $relatedProduct->title; ?>" class="img-responsive" /></a></div>
                <div class="caption">
                  <h4><a href="<?php echo '/product/' . $relatedProduct->slug; ?>"><?php echo $relatedProduct->title; ?></a></h4>
                  <p class="price"> <span class="price-new"><?php echo number_format($relatedProduct->price); ?></span></p>
                 
                </div>
                
              </div>
            <?php endforeach ?>
            </div>
          </div>
              </div>
              
                
        <!--Middle Part End -->
        <!--Right Part Start -->
<?php $this->load->view('partials/sidebar'); ?> 
      
        <!--Right Part End -->
      </div>
    </div>
  </div>
  <!--Footer Start-->
<?php $this->load->view('partials/footer'); ?> 
  