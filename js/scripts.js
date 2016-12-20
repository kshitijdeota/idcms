jQuery(function($) {
  $(document).ready(function(e) {
    var tab = $(".subnav").prev();

    $(".subnav").prev().before("<span class='gear'>+</span>");
    $(".subnav").hide();

    tab.click( function(e) {
      e.preventDefault();
      var thisSubnav = $(this).next(".subnav");
      var thisGear = $(this).prev(".gear");

      thisSubnav.slideToggle();

      if (  thisGear.css( "transform" ) == 'none' ){
        thisGear.css("transform","rotate(45deg)");
      } else {
        thisGear.css("transform","" );
      }
      $(".subnav").not(thisSubnav).slideUp();
      $(".gear").not(thisGear).css("transform","" );
    });

    // FADE OUT MESSAGES
    var ePresent = $( ".message" ).length;
    if ( ePresent ) {
      $( ".message" ).on('click', function() {
          $( this ).fadeOut( 500 );
      } );
    }

  });

});


var inputs = document.querySelectorAll( '.input-file' );
Array.prototype.forEach.call( inputs, function( input ) {
  var label  = input.nextElementSibling,
    labelVal = label.innerHTML;

  input.addEventListener( 'change', function( e ) {
    var fileName = '';
    if( this.files && this.files.length > 1 ) {
      fileName = ( this.getAttribute( 'data-multiple-caption' ) || '' ).replace( '{count}', this.files.length );
    } else {
      fileName = e.target.value.split( '\\' ).pop();
    }

    if( fileName ) {
      label.querySelector( 'span' ).innerHTML = fileName;
    } else {
      label.innerHTML = labelVal;
    }
  });
});