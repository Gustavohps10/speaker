/*
 * ATTENTION: An "eval-source-map" devtool has been used.
 * This devtool is neither made for production nor for readable output files.
 * It uses "eval()" calls to create a separate source file with attached SourceMaps in the browser devtools.
 * If you are trying to read the output file, select a different devtool (https://webpack.js.org/configuration/devtool/)
 * or disable the default devtool with "devtool: false".
 * If you are looking for production-ready output files, see mode: "production" (https://webpack.js.org/configuration/mode/).
 */
/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./resources/js/search.js":
/*!********************************!*\
  !*** ./resources/js/search.js ***!
  \********************************/
/***/ (() => {

eval("var bootstrap = window.bootstrap;\nvar soundList = [];\n$(\".addToPlaylist\").on(\"click\", function () {\n  var soundCard = $(this).closest(\".card\");\n  var soundId = soundCard.attr('id');\n\n  if (soundList.indexOf(soundId) === -1) {\n    soundList.push(soundId);\n  }\n\n  console.log(soundCard);\n  console.log(soundId);\n  console.log(soundList);\n});\n$(\"#playlistsModal\").on(\"hidden.bs.modal\", function () {\n  soundList = [];\n  var playlists = $(\"#playlistsModal input[data-action]\");\n  $.map(playlists, function (playlist) {\n    playlist.checked = false;\n  });\n});\n$(\"#playlistsModal .save\").on(\"click\", function () {\n  console.log(soundList);\n  var playlists = $(\"#playlistsModal input[data-action]\");\n  $.map(playlists, function (playlist) {\n    if (playlist.checked) {\n      addSoundsToPlaylist(soundList, playlist.getAttribute(\"data-action\"));\n    }\n  });\n});\nvar playlistsModal = new bootstrap.Modal(document.getElementById('playlistsModal'), {\n  keyboard: false\n});\n\nfunction addSoundsToPlaylist(soundList, playlistUrl) {\n  $.ajax({\n    url: playlistUrl,\n    type: \"POST\",\n    dataType: \"json\",\n    headers: {\n      'X-CSRF-TOKEN': $('meta[name=\"csrf-token\"]').attr('content')\n    },\n    data: {\n      soundList: soundList\n    },\n    success: function success(data) {\n      if (data.error) {\n        var toastErrorElement = document.querySelector('.toast-error');\n        toastErrorElement.children[0].children[0].innerText = data.error.msg;\n        var toastError = new bootstrap.Toast(toastErrorElement);\n        toastError.show();\n        return;\n      }\n\n      playlistsModal.hide();\n      var toastSuccessElement = document.querySelector('.toast-success');\n      toastSuccessElement.children[0].children[0].innerText = data.success;\n      var toastSuccess = new bootstrap.Toast(toastSuccessElement);\n      toastSuccess.show();\n    }\n  });\n}//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvanMvc2VhcmNoLmpzP2Q0YjMiXSwibmFtZXMiOlsiYm9vdHN0cmFwIiwid2luZG93Iiwic291bmRMaXN0IiwiJCIsIm9uIiwic291bmRDYXJkIiwiY2xvc2VzdCIsInNvdW5kSWQiLCJhdHRyIiwiaW5kZXhPZiIsInB1c2giLCJjb25zb2xlIiwibG9nIiwicGxheWxpc3RzIiwibWFwIiwicGxheWxpc3QiLCJjaGVja2VkIiwiYWRkU291bmRzVG9QbGF5bGlzdCIsImdldEF0dHJpYnV0ZSIsInBsYXlsaXN0c01vZGFsIiwiTW9kYWwiLCJkb2N1bWVudCIsImdldEVsZW1lbnRCeUlkIiwia2V5Ym9hcmQiLCJwbGF5bGlzdFVybCIsImFqYXgiLCJ1cmwiLCJ0eXBlIiwiZGF0YVR5cGUiLCJoZWFkZXJzIiwiZGF0YSIsInN1Y2Nlc3MiLCJlcnJvciIsInRvYXN0RXJyb3JFbGVtZW50IiwicXVlcnlTZWxlY3RvciIsImNoaWxkcmVuIiwiaW5uZXJUZXh0IiwibXNnIiwidG9hc3RFcnJvciIsIlRvYXN0Iiwic2hvdyIsImhpZGUiLCJ0b2FzdFN1Y2Nlc3NFbGVtZW50IiwidG9hc3RTdWNjZXNzIl0sIm1hcHBpbmdzIjoiQUFBQSxJQUFNQSxTQUFTLEdBQUdDLE1BQU0sQ0FBQ0QsU0FBekI7QUFFQSxJQUFJRSxTQUFTLEdBQUcsRUFBaEI7QUFFQUMsQ0FBQyxDQUFDLGdCQUFELENBQUQsQ0FBb0JDLEVBQXBCLENBQXVCLE9BQXZCLEVBQWdDLFlBQVk7QUFDeEMsTUFBSUMsU0FBUyxHQUFHRixDQUFDLENBQUMsSUFBRCxDQUFELENBQVFHLE9BQVIsQ0FBZ0IsT0FBaEIsQ0FBaEI7QUFDQSxNQUFJQyxPQUFPLEdBQUdGLFNBQVMsQ0FBQ0csSUFBVixDQUFlLElBQWYsQ0FBZDs7QUFDQSxNQUFHTixTQUFTLENBQUNPLE9BQVYsQ0FBa0JGLE9BQWxCLE1BQStCLENBQUMsQ0FBbkMsRUFBcUM7QUFDakNMLElBQUFBLFNBQVMsQ0FB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bUJBQXBCLENBQW5CO0FBQ0FDLE1BQUFBLFlBQVksQ0FBQ0gsSUFBYjtBQUNIO0FBdEJFLEdBQVA7QUF3QkgiLCJzb3VyY2VzQ29udGVudCI6WyJjb25zdCBib290c3RyYXAgPSB3aW5kb3cuYm9vdHN0cmFwO1xyXG5cclxudmFyIHNvdW5kTGlzdCA9IFtdO1xyXG5cclxuJChcIi5hZGRUb1BsYXlsaXN0XCIpLm9uKFwiY2xpY2tcIiwgZnVuY3Rpb24gKCkge1xyXG4gICAgbGV0IHNvdW5kQ2FyZCA9ICQodGhpcykuY2xvc2VzdChcIi5jYXJkXCIpO1xyXG4gICAgbGV0IHNvdW5kSWQgPSBzb3VuZENhcmQuYXR0cignaWQnKTtcclxuICAgIGlmKHNvdW5kTGlzdC5pbmRleE9mKHNvdW5kSWQpID09PSAtMSl7XHJcbiAgICAgICAgc291bmRMaXN0LnB1c2goc291bmRJZCk7XHJcbiAgICB9XHJcbiAgICBjb25zb2xlLmxvZyhzb3VuZENhcmQpO1xyXG4gICAgY29uc29sZS5sb2coc291bmRJZCk7XHJcbiAgICBjb25zb2xlLmxvZyhzb3VuZExpc3QpO1xyXG59KTtcclxuXHJcbiQoXCIjcGxheWxpc3RzTW9kYWxcIikub24oXCJoaWRkZW4uYnMubW9kYWxcIiwgZnVuY3Rpb24gKCkge1xyXG4gICAgc291bmRMaXN0ID0gW107XHJcbiAgICBsZXQgcGxheWxpc3RzID0gJChcIiNwbGF5bGlzdHNNb2RhbCBpbnB1dFtkYXRhLWFjdGlvbl1cIik7XHJcbiAgICAkLm1hcChwbGF5bGlzdHMsIGZ1bmN0aW9uKHBsYXlsaXN0KSB7XHJcbiAgICAgICAgcGxheWxpc3QuY2hlY2tlZCA9IGZhbHNlO1xyXG4gICAgfSk7XHJcbn0pO1xyXG5cclxuJChcIiNwbGF5bGlzdHNNb2RhbCAuc2F2ZVwiKS5vbihcImNsaWNrXCIsIGZ1bmN0aW9uICgpIHtcclxuICAgIGNvbnNvbGUubG9nKHNvdW5kTGlzdCk7XHJcbiAgICBsZXQgcGxheWxpc3RzID0gJChcIiNwbGF5bGlzdHNNb2RhbCBpbnB1dFtkYXRhLWFjdGlvbl1cIik7XHJcbiAgICAkLm1hcChwbGF5bGlzdHMsIGZ1bmN0aW9uKHBsYXlsaXN0KSB7XHJcbiAgICAgICAgaWYocGxheWxpc3QuY2hlY2tlZCl7XHJcbiAgICAgICAgICAgIGFkZFNvdW5kc1RvUGxheWxpc3Qoc291bmRMaXN0LCBwbGF5bGlzdC5nZXRBdHRyaWJ1dGUoXCJkYXRhLWFjdGlvblwiKSk7XHJcbiAgICAgICAgfVxyXG4gICAgfSk7XHJcbn0pO1xyXG5cclxudmFyIHBsYXlsaXN0c01vZGFsID0gbmV3IGJvb3RzdHJhcC5Nb2RhbChkb2N1bWVudC5nZXRFbGVtZW50QnlJZCgncGxheWxpc3RzTW9kYWwnKSwge1xyXG4gICAga2V5Ym9hcmQ6IGZhbHNlXHJcbn0pXHJcblxyXG5mdW5jdGlvbiBhZGRTb3VuZHNUb1BsYXlsaXN0KHNvdW5kTGlzdCwgcGxheWxpc3RVcmwpIHtcclxuICAgICQuYWpheCh7XHJcbiAgICAgICAgdXJsOiBwbGF5bGlzdFVybCxcclxuICAgICAgICB0eXBlOiBcIlBPU1RcIixcclxuICAgICAgICBkYXRhVHlwZTogXCJqc29uXCIsXHJcbiAgICAgICAgaGVhZGVyczogeydYLUNTUkYtVE9LRU4nOiAkKCdtZXRhW25hbWU9XCJjc3JmLXRva2VuXCJdJykuYXR0cignY29udGVudCcpfSxcclxuICAgICAgICBkYXRhOiB7XHJcbiAgICAgICAgICAgIHNvdW5kTGlzdDogc291bmRMaXN0XHJcbiAgICAgICAgfSxcclxuICAgICAgICBzdWNjZXNzKGRhdGEpe1xyXG4gICAgICAgICAgICBpZihkYXRhLmVycm9yKXtcclxuICAgICAgICAgICAgICAgIGxldCB0b2FzdEVycm9yRWxlbWVudCA9IGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3IoJy50b2FzdC1lcnJvcicpO1xyXG4gICAgICAgICAgICAgICAgdG9hc3RFcnJvckVsZW1lbnQuY2hpbGRyZW5bMF0uY2hpbGRyZW5bMF0uaW5uZXJUZXh0ID0gZGF0YS5lcnJvci5tc2c7XHJcbiAgICAgICAgICAgICAgICBsZXQgdG9hc3RFcnJvciA9IG5ldyBib290c3RyYXAuVG9hc3QodG9hc3RFcnJvckVsZW1lbnQpO1xyXG4gICAgICAgICAgICAgICAgdG9hc3RFcnJvci5zaG93KCk7XHJcbiAgICAgICAgICAgICAgICByZXR1cm47XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgcGxheWxpc3RzTW9kYWwuaGlkZSgpO1xyXG5cclxuICAgICAgICAgICAgbGV0IHRvYXN0U3VjY2Vzc0VsZW1lbnQgPSBkb2N1bWVudC5xdWVyeVNlbGVjdG9yKCcudG9hc3Qtc3VjY2VzcycpO1xyXG4gICAgICAgICAgICB0b2FzdFN1Y2Nlc3NFbGVtZW50LmNoaWxkcmVuWzBdLmNoaWxkcmVuWzBdLmlubmVyVGV4dCA9IGRhdGEuc3VjY2VzcztcclxuICAgICAgICAgICAgbGV0IHRvYXN0U3VjY2VzcyA9IG5ldyBib290c3RyYXAuVG9hc3QodG9hc3RTdWNjZXNzRWxlbWVudCk7XHJcbiAgICAgICAgICAgIHRvYXN0U3VjY2Vzcy5zaG93KCk7XHJcbiAgICAgICAgfVxyXG4gICAgfSk7XHJcbn0iXSwiZmlsZSI6Ii4vcmVzb3VyY2VzL2pzL3NlYXJjaC5qcy5qcyIsInNvdXJjZVJvb3QiOiIifQ==\n//# sourceURL=webpack-internal:///./resources/js/search.js\n");

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module can't be inlined because the eval-source-map devtool is used.
/******/ 	var __webpack_exports__ = {};
/******/ 	__webpack_modules__["./resources/js/search.js"]();
/******/ 	
/******/ })()
;