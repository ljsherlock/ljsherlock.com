module.exports = function(grunt) {

  // Project configuration.
  grunt.initConfig({

    // Task configuration.
        // SASS
        sass: {
            build: {
                files: {
                 'View/CSS/style.css': 'View/main.scss'
                }
            }
        },

        requirejs:
        {
            compile:
            {
                options:
                {
                    dir: 'Assets/Build',
                    baseUrl: 'Assets/Scripts',
                    mainConfigFile: 'Assets/Scripts/Lib/requireConfig.js',
                    include: [ 'Main.js' ],
                    modules: [
                    //First set up the common build layer.
                    {
                        //module names are relative to baseUrl
                        name: 'Lib/requireConfig',
                        //List common dependencies here. Only need to list
                        //top level dependencies, "include" will find
                        //nested dependencies.
                        include: ['Core',
                                  'App',
                        ]
                    }],
                }
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
                   'View/CSS/style.min.css' : 'View/CSS/style.css'
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
                    cwd: 'View/Assets/svg/svg-use/',
                    src: ['*.svg', '*/*.svg'],
                    dest: 'View/Assets/svg/svg-use-optimized/',
                    rename: function (dest, src)
                    {
                        // return only the filename from the source
                        // this prevents the tasks preserving the
                        // directory structure here.

                        var out = dest + src;

                        if(src.indexOf("/") > -1) {
                            out = dest + src.split('/')[1];
                        }

                        return out;
                    }
                }]
            }
        },

        // SVG SYMBOLS CREATION
       svgstore: {
           build: {
               files: {
                     'View/Assets/icons/icons.svg': 'View/Assets/svg/svg-final/*.svg',
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
             'View/_components/*.twig',
             'View/_app/*.twig',
             'View/_macros/*.twig',
             'View/_components/**/*.twig',
             'View/_components/***/*.twig',
             'View/_app/**/*.twig',
             'View/_app/***/*.twig',
           ],
           options: {
             spawn: false,
             livereload: true
           }
         },

         // Run build to compile SCSS and minify result
         styles: {
            files: [
              'View/_components/*.scss',
              'View/_components/**/*.scss',
              'View/_components/**/**/*.scss',
              'View/_components/**/**/**/*.scss',
              'View/_components/*.scss',
              'View/_app/**/*.scss',
              'View/_app/**/**/*.scss',
              'View/_app/**/**/**/*.scss',
            ],
            tasks: [ 'build' ],
            options: {
                spawn: false,
                livereload: true
            }
        },

        // Run Uglify to minify JS
        // js:
        // {
        //    files:
        //    [
        //         'View/Assets/Scripts/*.js',
        //         'View/Assets/Scripts/*/*.js',
        //         'View/_components/*/*/*.js'
        //    ],
        //    tasks: [ 'requirejs' ],
        //     options:
        //     {
        //         spawn: false,
        //         livereload: true
        //     }
        // },

        // optimize SVG
        svg:
        {
            files:
            [
                'View/Assets/svg/svg-use/*.svg',
                'View/Assets/svg/svg-use/*/*.svg',
            ],
            tasks: ['svgmin'],
            options:
            {
                spawn: false,
                livereload: true,
            }
        },

        // Create symbol SVG
        svgs: {
            files: [
                'View/Assets/svg/svg-final/*.svg',
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
  grunt.loadNpmTasks('grunt-contrib-requirejs');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-contrib-sass');
  grunt.loadNpmTasks('grunt-contrib-cssmin');
  grunt.loadNpmTasks('grunt-shell');
  grunt.loadNpmTasks('grunt-svgstore');
  grunt.loadNpmTasks('grunt-svgmin');

  grunt.registerTask('default', ['build']);
  grunt.registerTask('build', [ 'sass', 'cssmin']);

};
