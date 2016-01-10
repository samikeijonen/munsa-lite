module.exports = function(grunt) {

// Load multiple grunt tasks using globbing patterns
require('load-grunt-tasks')(grunt);

// Project configuration.
grunt.initConfig({
  pkg: grunt.file.readJSON('package.json'),

    makepot: {
      target: {
        options: {
          domainPath: '/languages/',     // Where to save the POT file.
          exclude: ['build/.*'],         // Exlude build folder.
          potFilename: 'munsa-lite.pot', // Name of the POT file.
          type: 'wp-theme',              // Type of project (wp-plugin or wp-theme).
          updateTimestamp: false,        // Whether the POT-Creation-Date should be updated without other changes.
          processPot: function( pot, options ) {
            pot.headers['report-msgid-bugs-to'] = 'https://foxland.fi/contact/';
			pot.headers['language'] = 'en_US';
            return pot;
          }
        }
      }
    },

	// Right to left styles
	rtlcss: {
		options: {
			// rtlcss options  
			config:{
				swapLeftRightInUrl: false,
				swapLtrRtlInUrl: false,
				autoRename: false,
				preserveDirectives: true,
				stringMap: [
					{
						name: 'import-rtl-stylesheet',
						search: [ '.css' ],
						replace: [ '-rtltest.css' ],
						options: {
							scope: 'url',
							ignoreCase: false
						}
					}
				]
			},
			// extend rtlcss rules
			//rules:[],
			// extend rtlcss declarations
			//declarations:[],
			// extend rtlcss properties
			//properties:[],
			// generate source maps
			//map: false,
			// save unmodified files
			saveUnmodified: true,
		},
		theme: {
			expand : true,
			//cwd    : '/',
			//dest   : '/',
			ext    : '-rtl.css',
			src    : [
				'style.css'
			]
		}
	},
	
	// Minify files
	uglify: {
		settigns: {
			files: {
				'js/settings.min.js': ['js/settings.js'],
				'js/smooth-scroll.min.js': ['js/smooth-scroll.js'],
				'js/skip-link-focus-fix.min.js': ['js/skip-link-focus-fix.js']
			}
		}
	},
	
	// Minify css
	cssmin : {
		css: {
			src: 'style.css',
			dest: 'style.min.css'
		},
	},
	
	postcss: {
		options: {
		map: false, // inline sourcemaps

		processors: [
			require('autoprefixer')({browsers: 'last 3 versions'}), // add vendor prefixes
		]
		},
		dist: {
			src: 'style.css'
		}
	},

    // Clean up build directory
    clean: {
      main: ['build/<%= pkg.name %>']
    },

    // Copy the theme into the build directory
    copy: {
      main: {
        src:  [
          '**',
          '!node_modules/**',
          '!build/**',
          '!.git/**',
          '!Gruntfile.js',
          '!package.json',
          '!.gitignore',
          '!.gitmodules',
          '!.tx/**',
          '!**/Gruntfile.js',
          '!**/package.json',
          '!**/*~',
		  '!style-rtl.css'
        ],
        dest: 'build/<%= pkg.name %>/'
      }
    },
	
	// Replace text
	replace: {
		styleVersion: {
			src: [
				'style.css',
			],
			overwrite: true,
			replacements: [ {
				from: /^.*Version:.*$/m,
				to: 'Version: <%= pkg.version %>'
			} ]
		},
		functionsVersion: {
			src: [
				'functions.php'
			],
			overwrite: true,
			replacements: [ {
				from: /^define\( 'MUNSA_LITE_VERSION'.*$/m,
				to: 'define( \'MUNSA_LITE_VERSION\', \'<%= pkg.version %>\' );'
			} ]
		}
	},

    // Compress build directory into <name>.zip and <name>-<version>.zip
    compress: {
      main: {
        options: {
          mode: 'zip',
          archive: './build/<%= pkg.name %>_v<%= pkg.version %>.zip'
        },
        expand: true,
        cwd: 'build/<%= pkg.name %>/',
        src: ['**/*'],
        dest: '<%= pkg.name %>/'
      }
    },

});

// Default task.
grunt.registerTask( 'default', [ 'makepot', 'postcss', 'cssmin', 'uglify' ] );

// Build task(s).
grunt.registerTask( 'build', [ 'clean', 'replace', 'copy', 'compress' ] );

};