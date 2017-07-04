module.exports = function(grunt) {

  // Project configuration.
  grunt.initConfig({

    // Task configuration.
        // SASS
       sass: {
         build: {
           files: {
             'assets/css/style.css': 'sass/main.scss'
           }
         }
       },

       // MINIFY JS
        uglify: {
            options: {
                mangle: {
                    reserved: ['Util', 'App', 'Core', 'Mustard', 'Initialize'],
                }
            },
            buildLib: {
                src : 'assets/js/lib/*.js',
                dest : 'assets/js/min/lib.min.js'
            },
            buildApp: {
                // src: 'assets/js/*.js',
                // dest: 'assets/js/min/app.min.js'
                files: {
                    'assets/js/min/app.min.js' : [ 'assets/js/mustard.js', 'assets/js/utility.js', 'assets/js/core.js', 'assets/js/app.js', 'assets/js/main.js' ]
                    // 'assets/js/mustard.js' : 'assets/js/min/app.min.js',
                    // 'assets/js/utility.js' : 'assets/js/min/app.min.js',
                    // 'assets/js/core.js' : 'assets/js/min/app.min.js',
                    // 'assets/js/app.js' : 'assets/js/min/app.min.js',
                    // 'assets/js/main.js' : 'assets/js/min/app.min.js'
                },
            }
        },

       // MINIFY CSS
       cssmin: {
           options: {
               shorthandCompacting: false,
               roundingPrecision: -1
           },
           target: {
               files: {
                   'assets/css/style.min.css' : 'assets/css/style.css'
               }
           }
       },

       // SVG OPTIMIZATION
       svgmin: {
           options: {
               plugins: [
                   {
                       removeDimensions: true
                   }
               ]
           },
           dist: {
               files: [{
                    expand: true,
                    cwd: 'assets/media/svg/svg-use/',
                    src: ['*.svg', '*/*.svg'],
                    dest: 'assets/media/svg/svg-use-optimized/',
                    rename: function (dest, src)
                    {
                        // return only the filename from the source
                        // this prevents the tasks preserving the
                        // directory structure here.
                        var split = src.split('/')[1];
                        return dest + split;
                    }
                }]
            }
        },

        // SVG SYMBOLS CREATION
       svgstore: {
           build: {
               files: {
                     'assets/media/icons/icons.svg': 'assets/media/svg/svg-final/*.svg',
               },
           },
           options: {
               prefix: 'icon-',
               svg: {
                    xmlns: 'http://www.w3.org/2000/svg',
                   style: 'display:none;'
               }
           }

       },


       // DO TASK ON CHANGE
       watch: {

           // No task. Just reload.
         html: {
           files: [
             '*.php',
             '_patterns/*.twig',
             '_patterns/**/*.twig',
             '_patterns/***/*.twig',
           ],
           options: {
             spawn: false,
             livereload: true
           }
         },

         // Run build to compile SCSS and minify result
         styles: {
           files: [
              'sass/main.scss',
              'sass/**/*.scss',
            ],
           tasks: [ 'build' ],
           options: {
             spawn: false,
             livereload: true
           }
        },

        // Run Uglify to minify JS
        js: {
           files: [
                'assets/js/*.js',
                'assets/js/**/*.js',
           ],
           tasks: [ 'uglify' ],
            options: {
                spawn: false,
                livereload: true
            }
        },

        // optimize SVG
        svg: {
            files: [
                'assets/media/svg/svg-use/*.svg',
                'assets/media/svg/svg-use/*/*.svg',
            ],
            tasks: ['svgmin'],
            options: {
                spawn: false,
                livereload: true,
            }
        },

        // Create symbol SVG
        svgs: {
            files: [
                'assets/media/svg/svg-final/*.svg',
            ],
            tasks: ['svgstore'],
            cleanup: true,
            options: {
                spawn: false,
                livereload: true,
            },
        },

      }

  });

  // These plugins provide necessary tasks.
  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-contrib-sass');
  grunt.loadNpmTasks('grunt-contrib-cssmin');
  grunt.loadNpmTasks('grunt-shell');
  grunt.loadNpmTasks('grunt-svgstore');
  grunt.loadNpmTasks('grunt-svgmin');

  grunt.registerTask('default', ['build']);
  grunt.registerTask('build', [ 'sass', 'cssmin']);

};
