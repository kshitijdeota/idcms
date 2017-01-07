<?php global $member; ?>

<form id="picture-form" method="POST" action="" enctype="multipart/form-data">

  <div id="picture-profile">
    <img src="<?php echo $member['image_url']; ?>" alt="Profile Picture">
  </div>

  <div id="picture-controls">
    <span id="rotate-left" class="icon-undo" title="Rotate Left"></span>
    <span id="zoom-out" class="icon-zoom-out" title="Zoom Out"></span>
    <span id="fit" class="icon-enlarge" title="Fit Image to Window"></span>
    <span id="zoom-in" class="icon-zoom-in" title="Zoom In"></span>
    <span id="rotate-right" class="icon-redo" title="Rotate Right"></span>
  </div>

  <input id="picture-input" class="input-file u-full-width" type="file" name="picture-input" data-multiple-caption="{count} files selected" accept=".jpg,.jpeg,.png,.gif,.bmp,.tiff">

  <label class="button button-secondary" for="picture-input" title="Choose an image file to upload">
    <i class="icon-upload3"></i><span>Select A Picture</span>
  </label>

  <input type="hidden" id="dataX" name="dataX">
  <input type="hidden" id="dataY" name="dataY">
  <input type="hidden" id="dataWidth" name="dataWidth">
  <input type="hidden" id="dataHeight" name="dataHeight">
  <input type="hidden" id="dataScaleX" name="dataScaleX">
  <input type="hidden" id="dataScaleY" name="dataScaleY">
  <input type="hidden" id="dataAngle" name="dataAngle">

  <input type="hidden" name="member-id" value="<?php echo $member['ID']; ?>">
  <div class="row">
    <a href="<?php site_url( '/member-profile/', null ); ?>" class="button"><i class="icon-cancel-circle"></i>Cancel</a/>
    <button id="dataUpload" type="submit" name="dataUpload" class="button-primary"><i class="icon-floppy-disk"></i>Save</button>
  </div>

</form>