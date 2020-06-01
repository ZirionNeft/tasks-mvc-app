import 'jquery';
import '@popperjs/core';
import 'bootstrap';
import 'bootstrap/dist/css/bootstrap.min.css';

window._ = require('lodash');

try {
  window.$ = window.jQuery = require('./../../node_modules/jquery/dist/jquery.min.js');
  window.Cookies = require('js-cookie')
} catch (e) {
  console.log(e);
}