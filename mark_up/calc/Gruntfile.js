module.exports = function(grunt) {
	grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        time: grunt.template.today("yyyy-mm-dd"), //new Date().toJSON().slice(0,10),
		uglify: {
            options: {
                banner: '//<%= pkg.name %> <%= pkg.version %> <%=time%>\n'
            },
			minifyJS: {
				files: [{
					src: [
                        'node_modules/jquery/dist/jquery.min.js', //Comment jQuery for Debug
                        'node_modules/bootstrap/dist/js/bootstrap.min.js',
                        'js/calc.js'
					],
					dest: 'dist/<%= pkg.name %>.all.min.js'
				}]
			},
			minifyIESupport: {
				files: [{
					src: [
                        'js/ie7.js'
					],
					dest: 'dist/ie7.min.js'
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
                        'node_modules/bootstrap/dist/css/bootstrap.css',
                        'css/calc-icons.css',
                        'css/styles.css'
                    ],
                    dest: 'dist/<%= pkg.name %>.all.min.css'
                }]
            }
		},
        clean: ["dist/"],
	});

    grunt.loadNpmTasks('grunt-contrib-clean');
	grunt.loadNpmTasks('grunt-contrib-uglify');
	grunt.loadNpmTasks('grunt-contrib-cssmin');
	grunt.registerTask('default', ['clean', 'uglify', 'cssmin']);
}