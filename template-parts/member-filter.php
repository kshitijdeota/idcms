<?php global $filter ?>
<div class="member-filter">
  <form action="<?php echo site_url( '/members/', null ); ?>" method="POST" enctype="multipart/form-data" name="filter-form">
    <label for="designation-filter-select">Show :
    <select name="designation-filter-select" id="designation-filter">
      <option value="">ALL</option>
      <?php designation_options($filter); ?>
    </select>
    <button type="submit" name="filter">Filter</button>
    </label>
  </form>
</div>