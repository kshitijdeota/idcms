jQuery( function($) {
    // REPLACE BROKEN IMAGES ///////////////////////////////////////////
    window.onload = function () {
      var missingUrl = templateUrl;
      $( 'img' ).error( function(e) {
        $( this ).attr( 'src', missingUrl + 'missing.png' );
      });
    }

  var $document = $( document );
  $document.ready( function(e) {

    // NAVIGATION SLIDE OUTS //////////////////////////////////////////
    var subnav = $(".subnav");
    var tab = $(".subnav").prev();

    subnav.prev().before("<span class='gear'>+</span>");
    subnav.hide();

    tab.click( function(e) {
      e.preventDefault();
      var thisSubnav = $(this).next(".subnav"),
          thisGear = $(this).prev(".gear");

      thisSubnav.slideToggle();

      if (  thisGear.css( "transform" ) == 'none' ){
        thisGear.css("transform","rotate(45deg)");
      } else {
        thisGear.css("transform","" );
      }
      subnav.not(thisSubnav).slideUp();
      $(".gear").not(thisGear).css("transform","" );
    });

    // PROFILE PAGE INFO CARDS /////////////////////////////////////////
      $( '.member-grid .row' ).addClass( 'row__closed' );
      $( '.member-grid .member' ).addClass( 'hide' );

    $document.on('click', '.member', function() {
      $( '.member-grid .row' ).removeClass( 'row__open' ).addClass( 'row__closed' );
      $( '.member-grid .member' ).removeClass( 'show' ).addClass( 'hide' );
      $( this ).closest( '.row' ).removeClass( 'row__closed' ).addClass( 'row__open' );
      $( this ).removeClass( 'hide' ).addClass( 'show' );
    });

    // IMAGE CROP /////////////////////////////////////////////////
    var $image      = $('#picture-profile img'),
        $inputImage = $('#picture-input'),
        $controls   = $('#picture-controls'),
        $dataX      = $('#dataX'),
        $dataY      = $('#dataY'),
        $dataHeight = $('#dataHeight'),
        $dataWidth  = $('#dataWidth'),
        $dataScaleX = $('#dataScaleX'),
        $dataScaleY = $('#dataScaleY'),
        $dataAngle  = $('#dataAngle'),
        $dataUpload = $('#dataUpload');

    $inputImage.on('change', function() {

      var file = this.files[0];
      var fileType = file["type"];
      var ValidImageTypes = ["image/gif", "image/jpeg", "image/png"];

      if ($.inArray(fileType, ValidImageTypes) < 0) {

           alert("Please select only a JPEG or PNG file.");
      } else {

        var picture = $('#picture-profile img');
        picture.cropper({
          aspectRatio: 1 / 1,
          viewMode: 1,
          strict: true,
          guides:false,
          minCropBoxWidth:50,
          minCropBoxHeight:50,
          minContainerWidth: 100,
          crop: function(e) {

            // Output the result data for cropping image.
            $dataX.val(Math.round(e.x));
            $dataY.val(Math.round(e.y));
            $dataHeight.val(Math.round(e.height));
            $dataWidth.val(Math.round(e.width));
            $dataAngle.val(e.rotate);
            $dataScaleX.val(e.scaleX);
            $dataScaleY.val(e.scaleY);
          }
        });

        $('#rotate-left').click(function(){ picture.cropper('rotate', -90); });
        $('#zoom-out').click(function(){ picture.cropper('zoom', -0.1); });
        $('#fit').click(function(){ picture.cropper('reset'); });
        $('#zoom-in').click(function(){ picture.cropper('zoom', 0.1); });
        $('#rotate-right').click(function(){ picture.cropper('rotate', 90); });
      }
    });

    // IMPORT UPLOADED IMAGE BLOB ////////////////////////////////////////
    var URL = window.URL || window.webkitURL;
    var blobURL;

    if (URL) {
      $inputImage.on('change', function () {
        var files = this.files;
        var file;

        if (!$image.data('cropper')) {
          return;
        }

        if (files && files.length) {
          file = files[0];

          if (/^image\/\w+$/.test(file.type)) {
            blobURL = URL.createObjectURL(file);
            $image.one('built.cropper', function () {
              // Revoke when load complete
              URL.revokeObjectURL(blobURL);
            }).cropper('reset').cropper('replace', blobURL);

            $controls.show();

          } else {
            window.alert('Please choose an image file.');
          }
        }
      });
    } else {
      $inputImage.prop('disabled', true).parent().addClass('disabled');
    }

    var grid = document.getElementsByClassName( 'grid' );
    if( 0 < grid.length ) {
      $( '.grid' ).imagesLoaded( function() {
        $( function() {
          var gridImages = $( '.grid-item img' );
          gridImages.each( function(i) {
            $( this ).delay( ( i++ ) * 100 ).fadeTo( 1000, 1 );
          });
          $( '.grid' ).lightGallery({
            selector: '.grid-item',
            mode: 'lg-fade',
            cssEasing: 'ease-out',
            download: false,
          });
        });
      });
    }

  }); // $(document).ready();

});



// UPLOAD BUTTON ///////////////////////////////////////////////////
'use strict';

;( function ( document, window, index )
{
  var inputs = document.querySelectorAll( '.input-file' );
  Array.prototype.forEach.call( inputs, function( input )
  {
    var label  = input.nextElementSibling,
      labelVal = label.innerHTML;

    input.addEventListener( 'change', function( e )
    {
      var fileName = '';
      if( this.files && this.files.length > 1 )
        fileName = ( this.getAttribute( 'data-multiple-caption' ) || '' ).replace( '{count}', this.files.length );
      else
        fileName = e.target.value.split( '\\' ).pop();

      if( fileName )
        label.querySelector( 'span' ).innerHTML = fileName;
      else
        label.innerHTML = labelVal;
    });

    // Firefox bug fix
    input.addEventListener( 'focus', function(){ input.classList.add( 'has-focus' ); });
    input.addEventListener( 'blur', function(){ input.classList.remove( 'has-focus' ); });
  });
}( document, window, 0 ));