( function( api ) {

	// Extends our custom "munsa-lite-pro-link" section.
	api.sectionConstructor['munsa-lite-pro-link'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

} )( wp.customize );
