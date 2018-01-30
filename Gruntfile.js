// jshint node:true

module.exports = function( grunt ) {
	'use strict';

	var loader = require( 'load-project-config' ),
		config = require( 'grunt-theme-fleet' );
	config     = config();
	config.files.php.push( '!inc/admin/**/*.php' );
	config.files.js.push( '!inc/admin/**/*.js' );
	config.files.js.push( '!js/bootstrap.js' );
	config.files.js.push( '!js/bootstrap.min.js' );
	config.files.js.push( '!js/skip-link-focus-fix.js' );
	loader( grunt, config ).init();
};
