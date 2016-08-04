#!/usr/bin/env node

'use strict';

// Installation:
// npm install --save-dev gulp gulp-livereload

// Usage:
// gulp livereload

var gulp = require('gulp');
var livereload = require('gulp-livereload');

var host = 'http://localhost';
var port = 3000;
var assetPrefix = '/';
var larassetUrl = host + (port ? ':' + port : '') + assetPrefix;


gulp.task('serve', function () {
    var spawn = require('child_process').spawn,
        child = spawn('php', [ 'artisan', 'serve' ], { cwd: process.cwd() }),
        log = function (data) { console.log(data.toString()) };
    child.stdout.on('data', log);
    child.stderr.on('data', log);
    process.on('exit', function () {
        child.kill();
    });
    process.on('uncaughtException', function () {
        child.kill();
    });
});

gulp.task('livereload', function() {

  livereload({start: true});

  var livereloadPage = function () {
    // Reload the whole page
    livereload.reload();
  };

  gulp.watch('app/views/**/*.blade.php', livereloadPage);
  gulp.watch('app/helpers.php', livereloadPage);
  gulp.watch('app/lang/**/*.php', livereloadPage);

  // Static files
  gulp.watch('public/**/*.+(css|js|html|gif|ico|jpg|jpeg|png)', function(event) {
    var filePath = event.path.replace(/\\/g, '/').replace(new RegExp('^(.*/)?public(/(.+))$'), '$2');
    livereload.changed(filePath);
  });

  // Images files in assets paths
  gulp.watch('{{app,lib,provider},{vendor,workbench}/*/*/{app,lib,provider}}/assets/images/**/*.+(gif|ico|jpg|jpeg|png)', function(event) {
    var filePath = event.path.replace(/\\/g, '/').replace(new RegExp('^(.*)?' + assetPrefix + '/images(/(.+))$'), '$2');
    livereload.changed(larassetUrl + filePath);
  });

  // JavaScript files in assets paths
  gulp.watch('{{app,lib,provider},{vendor,workbench}/*/*/{app,lib,provider}}/assets/javascripts/**/*.+(js|coffee|es6|ts|ejs)', function(event) {
    var filePath = event.path.replace(/\\/g, '/');
    var pattern = new RegExp('app/assets/(.+?)((\.js)?(\.(coffee|es6|ts))?)(\.ejs)?$');
    var m = filePath.match(pattern);
    if (m && m[1] && m[2]) {
      livereload.changed(larassetUrl + '/application.js');
    }
  });

  // StyleSheets files in assets paths
  gulp.watch('{{app,lib,provider},{vendor,workbench}/*/*/{app,lib,provider}}/assets/stylesheets/**/*.+(css|less|sass|scss|styl|ejs)', function(event) {
    var filePath = event.path.replace(/\\/g, '/');
    var pattern = new RegExp('app/assets/(.+?)((\.css)?(\.(less|s[ac]ss|styl))?)(\.ejs)?$');
    var m = filePath.match(pattern);
    if (m && m[1] && m[2]) {
      livereload.changed(larassetUrl + '/application.css');
    }
  });
});

gulp.task('watch',function(){
    gulp.start('serve');
    gulp.start('livereload');
});