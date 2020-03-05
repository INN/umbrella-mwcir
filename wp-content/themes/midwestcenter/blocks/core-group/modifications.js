wp.hooks.addFilter(
	'blocks.registerBlockType',
	'ipbs/core-group',
	function( settings, name ) {
		if ( name !== 'core/group' ) {
			return settings;
		}

		return lodash.assign( {}, settings, {
			supports: lodash.assign( {}, settings.supports, {
				align: [ 'left', 'wide', 'full', 'right' ],
			} ),
		} );
	}
);
