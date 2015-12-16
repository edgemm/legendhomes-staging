(function($){

// *** MODALS
var mActive = "target"; // class name for active modal
var mAlpha = "complete"; // class name for completed front-page of modal

// add agent contact email to hidden field in modal ( m )
function addAgentEmail( t, m ){ // t: element to garner contact address
	var eLoc = t.attr( "data-eLoc" );
	var eDom = t.attr( "data-eDom" );

	m.find( ".contact-agent" ).attr( "value", eLoc + "@" + eDom );
}

// vertically center based on modal height
$( ".modal-container" ).each(function(){
	var c = $( this ).children( ".modal-content" );
	var h = c.outerHeight();
	
	c.css({ "margin-top": "-" + ( h / 2 ) + "px" });
});

// display modals
$( ".trig-modal" ).click(function(e){
	e.preventDefault();
	var t = $( this );
	var modalID = t.attr( "data-modal" );
	var modal = $( "[data-modalID=" + modalID + "]" );
	
	$( ".modal-container" ).removeClass( mActive );
	modal.addClass( mActive );
	
	if ( t.hasClass( "modal-contact-agent" ) ) {
		addAgentEmail( t, modal );
	}
});

// hide modals
function modalClose( m ) {
	modal = m.parents( ".modal-container" );
	modal.removeClass( mActive );
	modal.find( ".modal-alpha" ).removeClass( mAlpha );
	modal.find( ".wpcf7-response-output" ).hide();
}

$( ".modal-close" ).click(function(e){
	e.preventDefault();
	modalClose( $( this ) );	
});

// hide modal first page, show back page then close
function modalRevealOmega() {
	var alpha = $( ".modal-container." + mActive ).find( ".modal-alpha" );
	alpha.addClass( "complete" );
	var closeModal = window.setTimeout( function(){
		modalClose( alpha );
	}, 10000 );
}


// *** CONTACT FORM
// auto-fill
$( 'form.wpcf7-form' ).find( "input, select" ).change(function(){
    var id = $(this).attr( "id" );
    $( "#autoFill-" + id ).val( $(this).val() );
});

$( ".form-autoFill" ).each(function(){

	var f = $(this).attr( "data-autoFill" );

	if ( f ) {
		var v = $.cookie( f );
		if ( v ) $(this).val( v );
	}

});

console.log( "name: " + $.cookie( "contactForm-name" ) );
console.log( "email: " + $.cookie( "contactForm-email" ) );


})(jQuery);