module.exports = function(grunt) {

    var source_dir = 'javascript/lib/';
    var dest_dir = 'public/javascript/lib';


  // Project configuration.
    grunt.initConfig({

        pkg: grunt.file.readJSON('package.json'),

        watch: {

            scripts: {
                files: 'javascript/lib/*.js',
                exclude: 'javascript/vendor',
                tasks: ['copy', 'jshint','concat','uglify'],
            },
        },

        copy: {

            lib: {
              expand: true,
              cwd: 'javascript',
              src: ['lib/**'],
              dest: 'public/javascript/'
            },

            vendor: {
              expand: true,
              cwd: 'javascript',
              src: ['vendor/**'],
              dest: 'public/javascript/'
            }
        },

        jshint: {

            targets: source_dir+'*.js',

        },

        concat: {
            options: {
                separator: ';',
                dot: true
            },
            dist: {
                src: [
                    'javascript/lib/*?(.js)',
                    '!javascript/lib/datetimepicker.init.js',
                    ],
                dest: dest_dir+'/<%= pkg.name %>.js'
            }
        },

        uglify: {
            options: {
                banner: '/*! <%= pkg.name %> <%= grunt.template.today("yyyy-mm-dd hh:MM:ss") %> */\n'
            },
            build: {
                src: dest_dir+'/<%= pkg.name %>.js',
                dest: dest_dir+'/<%= pkg.name %>.min.js'
            }
        }
    });

    // Load the plugin that provides the "uglify" task.
    grunt.loadNpmTasks('grunt-contrib-jshint');

    grunt.loadNpmTasks('grunt-contrib-concat');

    grunt.loadNpmTasks('grunt-contrib-copy');

    grunt.loadNpmTasks('grunt-contrib-uglify');

    grunt.loadNpmTasks('grunt-contrib-watch');

    grunt.registerTask('default', [ 'jshint', 'concat', 'copy', 'uglify', 'watch']);
    // Default task(s).
    // grunt.registerTask('default', [ 'jshint', 'concat', 'uglify',]);

};