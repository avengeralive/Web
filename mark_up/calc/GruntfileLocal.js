module.exports = function(grunt) {
	grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        time: grunt.template.today('yyyy-mm-dd'), //new Date().toJSON().slice(0,10),
		uglify: {
            options: {
                banner: '//<%= pkg.name %> <%= pkg.version %> <%=time%>\n'
            },
			minifyJS: {
				files: [{
					src: [
                        'js/calc.js'
					],
					dest: 'dist/tmp/calc.min.js'
				}]
			},
			minifyIESupport: {
				files: [{
					src: [
                        'js/ie7.js'
					],
					dest: 'js/ie7.min.js'
				}]
			},
            //ie8: true
		},
		cssmin: {
            options: {
                compatibility: 'ie7',
                mergeIntoShorthands: false
            },
            target: {
                files: [{
                    src: [
                        'css/styles.css'
                    ],
                    dest: 'dist/tmp/calc.min.css'
                }]
            }
		},
        concat: {
            options: {
                separator: '\n',
            },
            dist: {
                src: [
                    'js/jquery.bootstrap.js',
                    'dist/tmp/calc.min.js'
                ],
                dest: 'js/<%= pkg.name %>.all.min.js',
            },
            css: {
                src: [
                    'css/bootstrap.calc-icons.css',
                    'dist/tmp/calc.min.css'
                ],
                dest: 'css/<%= pkg.name %>.all.min.css',
            },
        },
        clean: ['dist/'],
	});

    grunt.loadNpmTasks('grunt-contrib-clean');
	grunt.loadNpmTasks('grunt-contrib-uglify');
	grunt.loadNpmTasks('grunt-contrib-cssmin');
	grunt.loadNpmTasks('grunt-contrib-concat');
    grunt.loadNpmTasks('grunt-contrib-clean');
	grunt.registerTask('default', ['clean', 'uglify', 'cssmin', 'concat', 'clean']);
}