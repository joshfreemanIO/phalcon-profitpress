module.exports = function(grunt) {

    var source_dir = 'javascript_src/**/';
    var dest_dir = 'public/js';


  // Project configuration.
  grunt.initConfig({

    pkg: grunt.file.readJSON('package.json'),

    watch: {

        scripts: {
            files: source_dir+'*.js',
            tasks: ['jshint','concat','uglify'],
        },
    },
    jshint: {

      targets: source_dir+'*.js',
    },

    concat: {
        options: {
            separator: ';'
        },
        dist: {
                src: source_dir+'*.js',
                dest: dest_dir+'/<%= pkg.name %>.js'
            }
    },

    // uglify: {
    //     options: {
    //         banner: '/*! <%= pkg.name %> <%= grunt.template.today("yyyy-mm-dd") %> */\n'
    //     },
    //     build: {
    //         src: dest_dir+'/<%= pkg.name %>.js',
    //         dest: dest_dir+'/<%= pkg.name %>.min.js'
    //   }
    // }
  });

  // Load the plugin that provides the "uglify" task.
  grunt.loadNpmTasks('grunt-contrib-jshint');

  grunt.loadNpmTasks('grunt-contrib-concat');

  grunt.loadNpmTasks('grunt-contrib-uglify');

  grunt.loadNpmTasks('grunt-contrib-watch');


  grunt.registerTask('default', [ 'jshint', 'concat', 'uglify', 'watch']);
  // Default task(s).
  // grunt.registerTask('default', [ 'jshint', 'concat', 'uglify',]);

};