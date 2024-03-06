<?php $this->load->view('partials/header'); ?>
  <div id="container">
    <div class="container">
      <!-- Breadcrumb Start-->
      <ul class="breadcrumb">
        <li><a href="index.html"><i class="fa fa-home"></i></a></li>
        <li><a href="category.html">DELL</a></li>
      </ul>
      <!-- Breadcrumb End-->
      <div class="row">
        <!--Left Part Start -->
         <?php $this->load->view('partials/sidebar'); ?>
        
        <!--Left Part End -->
        <!--Middle Part Start-->
         <div id="content" class="col-sm-9">
          <h1 class="title"><?php echo $title; ?></h1>
          <div class="row products-category">
            <?php if ($products): ?>
            <?php foreach ($products as $product): ?>              
            <div class="product-layout product-list col-xs-12">
              <div class="product-thumb">
                <div class="image"><a href="<?php echo '/product/' . $products->slug; ?>"><img src="/uploads/<?php echo $product->product_img ?>" width="200" height="200" alt="<?php echo $products->title; ?>" title="<?php echo $product->title; ?>" class="img-responsive" /></a></div>
                <div>
                  <div class="caption">
                    <h4><a href="<?php echo '/product/' . $product->slug; ?>"><?php echo $product->title; ?></a></h4>
                    <p class="description"><?php echo substr($product->description, 0, 120); ?>...</p>
                    <p class="price"><span class="price-new">Rs/ <?php echo number_format($product->price); ?></span></p>
                  </div>
                </div>
              </div>
            </div>
            <?php endforeach ?>
            <?php else: ?>
              <div class="alert alert-danger">
                No record found!
              </div>
            <?php endif ?>
              </div>
            </div>
            
        <!--Middle Part End -->
      </div>
    </div>
  </div>
  <!--Footer Start-->
<?php $this->load->view('partials/footer'); ?>
  