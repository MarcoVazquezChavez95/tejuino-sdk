/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 1);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/admin/default.js":
/*!***************************************!*\
  !*** ./resources/js/admin/default.js ***!
  \***************************************/
/*! no static exports found */
/***/ (function(module, exports) {

/*
Template Name: Color Admin - Responsive Admin Dashboard Template build with Twitter Bootstrap 3 & 4
Version: 4.0.0
Author: Sean Ngu
Website: http://www.seantheme.com/color-admin-v4.0/admin/
*/
var FONT_COLOR = '#2d353c';
var FONT_FAMILY = 'Open Sans, Helvetica Neue,Helvetica,Arial,sans-serif';
var FONT_WEIGHT = '600';
var FONT_SIZE = '12px';
var COLOR_BLUE = '#348fe2';
var COLOR_BLUE_LIGHTER = '#5da5e8';
var COLOR_BLUE_DARKER = '#2a72b5';
var COLOR_BLUE_TRANSPARENT_1 = 'rgba(52, 143, 226, 0.1)';
var COLOR_BLUE_TRANSPARENT_2 = 'rgba(52, 143, 226, 0.2)';
var COLOR_BLUE_TRANSPARENT_3 = 'rgba(52, 143, 226, 0.3)';
var COLOR_BLUE_TRANSPARENT_4 = 'rgba(52, 143, 226, 0.4)';
var COLOR_BLUE_TRANSPARENT_5 = 'rgba(52, 143, 226, 0.5)';
var COLOR_BLUE_TRANSPARENT_6 = 'rgba(52, 143, 226, 0.6)';
var COLOR_BLUE_TRANSPARENT_7 = 'rgba(52, 143, 226, 0.7)';
var COLOR_BLUE_TRANSPARENT_8 = 'rgba(52, 143, 226, 0.8)';
var COLOR_BLUE_TRANSPARENT_9 = 'rgba(52, 143, 226, 0.9)';
var COLOR_AQUA = '#5AC8FA';
var COLOR_AQUA_LIGHTER = '#6dc5de';
var COLOR_AQUA_DARKER = '#3a92ab';
var COLOR_AQUA_TRANSPARENT_1 = 'rgba(73, 182, 214, 0.1)';
var COLOR_AQUA_TRANSPARENT_2 = 'rgba(73, 182, 214, 0.2)';
var COLOR_AQUA_TRANSPARENT_3 = 'rgba(73, 182, 214, 0.3)';
var COLOR_AQUA_TRANSPARENT_4 = 'rgba(73, 182, 214, 0.4)';
var COLOR_AQUA_TRANSPARENT_5 = 'rgba(73, 182, 214, 0.5)';
var COLOR_AQUA_TRANSPARENT_6 = 'rgba(73, 182, 214, 0.6)';
var COLOR_AQUA_TRANSPARENT_7 = 'rgba(73, 182, 214, 0.7)';
var COLOR_AQUA_TRANSPARENT_8 = 'rgba(73, 182, 214, 0.8)';
var COLOR_AQUA_TRANSPARENT_9 = 'rgba(73, 182, 214, 0.9)';
var COLOR_GREEN = '#00ACAC';
var COLOR_GREEN_LIGHTER = '#33bdbd';
var COLOR_GREEN_DARKER = '#008a8a';
var COLOR_GREEN_TRANSPARENT_1 = 'rgba(0, 172, 172, 0.1)';
var COLOR_GREEN_TRANSPARENT_2 = 'rgba(0, 172, 172, 0.2)';
var COLOR_GREEN_TRANSPARENT_3 = 'rgba(0, 172, 172, 0.3)';
var COLOR_GREEN_TRANSPARENT_4 = 'rgba(0, 172, 172, 0.4)';
var COLOR_GREEN_TRANSPARENT_5 = 'rgba(0, 172, 172, 0.5)';
var COLOR_GREEN_TRANSPARENT_6 = 'rgba(0, 172, 172, 0.6)';
var COLOR_GREEN_TRANSPARENT_7 = 'rgba(0, 172, 172, 0.7)';
var COLOR_GREEN_TRANSPARENT_8 = 'rgba(0, 172, 172, 0.8)';
var COLOR_GREEN_TRANSPARENT_9 = 'rgba(0, 172, 172, 0.9)';
var COLOR_YELLOW = '#ffd900';
var COLOR_YELLOW_LIGHTER = '#fde248';
var COLOR_YELLOW_DARKER = '#bfa300';
var COLOR_YELLOW_TRANSPARENT_1 = 'rgba(255, 217, 0, 0.1)';
var COLOR_YELLOW_TRANSPARENT_2 = 'rgba(255, 217, 0, 0.2)';
var COLOR_YELLOW_TRANSPARENT_3 = 'rgba(255, 217, 0, 0.3)';
var COLOR_YELLOW_TRANSPARENT_4 = 'rgba(255, 217, 0, 0.4)';
var COLOR_YELLOW_TRANSPARENT_5 = 'rgba(255, 217, 0, 0.5)';
var COLOR_YELLOW_TRANSPARENT_6 = 'rgba(255, 217, 0, 0.6)';
var COLOR_YELLOW_TRANSPARENT_7 = 'rgba(255, 217, 0, 0.7)';
var COLOR_YELLOW_TRANSPARENT_8 = 'rgba(255, 217, 0, 0.8)';
var COLOR_YELLOW_TRANSPARENT_9 = 'rgba(255, 217, 0, 0.9)';
var COLOR_ORANGE = '#f59c1a';
var COLOR_ORANGE_LIGHTER = '#f7b048';
var COLOR_ORANGE_DARKER = '#c47d15';
var COLOR_ORANGE_TRANSPARENT_1 = 'rgba(245, 156, 26, 0.1)';
var COLOR_ORANGE_TRANSPARENT_2 = 'rgba(245, 156, 26, 0.2)';
var COLOR_ORANGE_TRANSPARENT_3 = 'rgba(245, 156, 26, 0.3)';
var COLOR_ORANGE_TRANSPARENT_4 = 'rgba(245, 156, 26, 0.4)';
var COLOR_ORANGE_TRANSPARENT_5 = 'rgba(245, 156, 26, 0.5)';
var COLOR_ORANGE_TRANSPARENT_6 = 'rgba(245, 156, 26, 0.6)';
var COLOR_ORANGE_TRANSPARENT_7 = 'rgba(245, 156, 26, 0.7)';
var COLOR_ORANGE_TRANSPARENT_8 = 'rgba(245, 156, 26, 0.8)';
var COLOR_ORANGE_TRANSPARENT_9 = 'rgba(245, 156, 26, 0.9)';
var COLOR_PURPLE = '#727cb6';
var COLOR_PURPLE_LIGHTER = '#8e96c5';
var COLOR_PURPLE_DARKER = '#5b6392';
var COLOR_PURPLE_TRANSPARENT_1 = 'rgba(114, 124, 182, 0.1)';
var COLOR_PURPLE_TRANSPARENT_2 = 'rgba(114, 124, 182, 0.2)';
var COLOR_PURPLE_TRANSPARENT_3 = 'rgba(114, 124, 182, 0.3)';
var COLOR_PURPLE_TRANSPARENT_4 = 'rgba(114, 124, 182, 0.4)';
var COLOR_PURPLE_TRANSPARENT_5 = 'rgba(114, 124, 182, 0.5)';
var COLOR_PURPLE_TRANSPARENT_6 = 'rgba(114, 124, 182, 0.6)';
var COLOR_PURPLE_TRANSPARENT_7 = 'rgba(114, 124, 182, 0.7)';
var COLOR_PURPLE_TRANSPARENT_8 = 'rgba(114, 124, 182, 0.8)';
var COLOR_PURPLE_TRANSPARENT_9 = 'rgba(114, 124, 182, 0.9)';
var COLOR_RED = '#ff5b57';
var COLOR_RED_LIGHTER = '#ff7c79';
var COLOR_RED_DARKER = '#cc4946';
var COLOR_RED_TRANSPARENT_1 = 'rgba(255, 91, 87, 0.1)';
var COLOR_RED_TRANSPARENT_2 = 'rgba(255, 91, 87, 0.2)';
var COLOR_RED_TRANSPARENT_3 = 'rgba(255, 91, 87, 0.3)';
var COLOR_RED_TRANSPARENT_4 = 'rgba(255, 91, 87, 0.4)';
var COLOR_RED_TRANSPARENT_5 = 'rgba(255, 91, 87, 0.5)';
var COLOR_RED_TRANSPARENT_6 = 'rgba(255, 91, 87, 0.6)';
var COLOR_RED_TRANSPARENT_7 = 'rgba(255, 91, 87, 0.7)';
var COLOR_RED_TRANSPARENT_8 = 'rgba(255, 91, 87, 0.8)';
var COLOR_RED_TRANSPARENT_9 = 'rgba(255, 91, 87, 0.9)';
var COLOR_GREY = '#b6c2c9';
var COLOR_GREY_LIGHTER = '#c5ced4';
var COLOR_GREY_DARKER = '#929ba1';
var COLOR_GREY_TRANSPARENT_1 = 'rgba(182, 194, 201, 0.1)';
var COLOR_GREY_TRANSPARENT_2 = 'rgba(182, 194, 201, 0.2)';
var COLOR_GREY_TRANSPARENT_3 = 'rgba(182, 194, 201, 0.3)';
var COLOR_GREY_TRANSPARENT_4 = 'rgba(182, 194, 201, 0.4)';
var COLOR_GREY_TRANSPARENT_5 = 'rgba(182, 194, 201, 0.5)';
var COLOR_GREY_TRANSPARENT_6 = 'rgba(182, 194, 201, 0.6)';
var COLOR_GREY_TRANSPARENT_7 = 'rgba(182, 194, 201, 0.7)';
var COLOR_GREY_TRANSPARENT_8 = 'rgba(182, 194, 201, 0.8)';
var COLOR_GREY_TRANSPARENT_9 = 'rgba(182, 194, 201, 0.9)';
var COLOR_SILVER = '#f0f3f4';
var COLOR_SILVER_LIGHTER = '#f4f6f7';
var COLOR_SILVER_DARKER = '#b4b6b7';
var COLOR_SILVER_TRANSPARENT_1 = 'rgba(240, 243, 244, 0.1)';
var COLOR_SILVER_TRANSPARENT_2 = 'rgba(240, 243, 244, 0.2)';
var COLOR_SILVER_TRANSPARENT_3 = 'rgba(240, 243, 244, 0.3)';
var COLOR_SILVER_TRANSPARENT_4 = 'rgba(240, 243, 244, 0.4)';
var COLOR_SILVER_TRANSPARENT_5 = 'rgba(240, 243, 244, 0.5)';
var COLOR_SILVER_TRANSPARENT_6 = 'rgba(240, 243, 244, 0.6)';
var COLOR_SILVER_TRANSPARENT_7 = 'rgba(240, 243, 244, 0.7)';
var COLOR_SILVER_TRANSPARENT_8 = 'rgba(240, 243, 244, 0.8)';
var COLOR_SILVER_TRANSPARENT_9 = 'rgba(240, 243, 244, 0.9)';
var COLOR_BLACK = '#2d353c';
var COLOR_BLACK_LIGHTER = '#575d63';
var COLOR_BLACK_DARKER = '#242a30';
var COLOR_BLACK_TRANSPARENT_1 = 'rgba(45, 53, 60, 0.1)';
var COLOR_BLACK_TRANSPARENT_2 = 'rgba(45, 53, 60, 0.2)';
var COLOR_BLACK_TRANSPARENT_3 = 'rgba(45, 53, 60, 0.3)';
var COLOR_BLACK_TRANSPARENT_4 = 'rgba(45, 53, 60, 0.4)';
var COLOR_BLACK_TRANSPARENT_5 = 'rgba(45, 53, 60, 0.5)';
var COLOR_BLACK_TRANSPARENT_6 = 'rgba(45, 53, 60, 0.6)';
var COLOR_BLACK_TRANSPARENT_7 = 'rgba(45, 53, 60, 0.7)';
var COLOR_BLACK_TRANSPARENT_8 = 'rgba(45, 53, 60, 0.8)';
var COLOR_BLACK_TRANSPARENT_9 = 'rgba(45, 53, 60, 0.9)';
var COLOR_WHITE = '#FFFFFF';
var COLOR_WHITE_TRANSPARENT_1 = 'rgba(255, 255, 255, 0.1)';
var COLOR_WHITE_TRANSPARENT_2 = 'rgba(255, 255, 255, 0.2)';
var COLOR_WHITE_TRANSPARENT_3 = 'rgba(255, 255, 255, 0.3)';
var COLOR_WHITE_TRANSPARENT_4 = 'rgba(255, 255, 255, 0.4)';
var COLOR_WHITE_TRANSPARENT_5 = 'rgba(255, 255, 255, 0.5)';
var COLOR_WHITE_TRANSPARENT_6 = 'rgba(255, 255, 255, 0.6)';
var COLOR_WHITE_TRANSPARENT_7 = 'rgba(255, 255, 255, 0.7)';
var COLOR_WHITE_TRANSPARENT_8 = 'rgba(255, 255, 255, 0.8)';
var COLOR_WHITE_TRANSPARENT_9 = 'rgba(255, 255, 255, 0.9)';

/***/ }),

/***/ 1:
/*!*********************************************!*\
  !*** multi ./resources/js/admin/default.js ***!
  \*********************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /Applications/XAMPP/xamppfiles/htdocs/tejuino/resources/js/admin/default.js */"./resources/js/admin/default.js");


/***/ })

/******/ });