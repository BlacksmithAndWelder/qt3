/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*************************************!*\
  !*** ./resources/js/layout/main.js ***!
  \*************************************/
$('#menu-btn').on('click', function () {
  if ($('#mySidenav').width() == 0) {
    $('#mySidenav').css('width', '250px');
    $('#content').css('margin-left', '250px');
  } else {
    $('#mySidenav').css('width', '0');
    $('#content').css('margin-left', '0');
  }
});
/******/ })()
;