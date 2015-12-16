(function ($, root, undefined) {
	
$(function () {

// pull plan data
$( '#edgemm_pull_plan_data' ).click(function(e){

	e.preventDefault();

    // notification that progress has started
    $( this ).after( '<p class="pull-status">Pulling data...</p>' );

	var plan_id = $( '#acf-field-home_plan' ).val();

    // get base url
    if (!location.origin) location.origin = location.protocol + "//" + location.host;

	$.ajax({
		type: "post",
		dataType: "json",
		url: location.origin + '/wp-admin/admin-ajax.php',
		data: {
			action: 'pull_plan_data',
			plan_id: plan_id
		},
		success: function( response ) {

			if ( response ) {
                
                // ensure text editor is visible before adding post content
                $( '.wp-editor-tabs' ).find( '#content-html' ).trigger( 'click' );

                // add content (if empty)
                if(  $( '#content.wp-editor-area' ).val() == '' ) $( '#content.wp-editor-area' ).val( response.plan_content );
                if( $( '#acf-field-homes_beds' ).val() == '' ) $( '#acf-field-homes_beds' ).val(response.plans_beds[0] );
                if( $( '#acf-field-homes_baths' ).val() == '' ) $( '#acf-field-homes_baths' ).val(response.plans_baths[0] );
                if( $( '#acf-field-homes_sqft' ).val() == '' ) $( '#acf-field-homes_sqft' ).val(response.plans_sqft[0] );
                if( $( '#acf-field-homes_features' ).val() == '' ) $( '#acf-field-homes_features' ).val(response.plans_features[0] );
                
                $( '.pull-status' ).text( 'Home updated!' );

			} else {

				$( '.pull-status' ).text( 'There was an error' );

			}

		},
		error: function(jqXHR, textStatus, errorThrown) {
			console.log(jqXHR + " :: " + textStatus + " :: " + errorThrown);
		}
	});

});

});

})(jQuery, this);
