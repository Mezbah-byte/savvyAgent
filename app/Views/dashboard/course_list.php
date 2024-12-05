<?php include('header.php')?>

<?php include('topbar.php')?>










<div class="content-wrapper">

        <!-- Content -->
        
          <div class="container-xxl flex-grow-1 container-p-y">
            

<!-- Hoverable Table rows -->
<div class="card">
  <h5 class="card-header">Course List</h5>
  <div class="table-responsive text-nowrap">
    <table class="table table-hover">
      <thead>
        <tr>
          <th>Product</th>
          <th>Main Price</th>
          <th>Offer Price</th>
          <!-- <th>Unit</th> -->
          <th>Actions</th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">

      <?php foreach($courses as $course){ ?>
        <tr>
          <td><img src="<?php echo $course['img_path'].$course['img'];?>" height="50px" width="50px" /> <span class="fw-medium"><?php echo $course['title']?></span></td>
          <td><?php echo $course['full_price'].' ৳';?></td>
          <td><?php echo $course['price'].' ৳';?></td>
          <!-- <td><?php echo $course['stock'];?></td> -->
          <td>
            <div class="dropdown">
              <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
              <div class="dropdown-menu">
                <!-- <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i> Delete</a> -->
              </div>
            </div>
          </td>
        </tr>
      <?php }?>
        
      </tbody>
    </table>
  </div>
</div>
<!--/ Hoverable Table rows -->



          </div>
          <!-- / Content -->

          
          




















<?php include('footer.php')?>