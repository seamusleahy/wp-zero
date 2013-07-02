/**
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 * Things like site title, description, and background color changes.
 *
 * Learn more: https://codex.wordpress.org/Theme_Customization_API#Step_2:_Create_a_Javascript_File
 */
( function( $ ) {

	wp.customize( 'setting_name', function( value ) {
		value.bind( function( newval ) {
			// Update the display for a setting using the passed in value
		});
	});

} )( jQuery );