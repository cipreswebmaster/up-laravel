/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./resources/js/profession-events.js":
/*!*******************************************!*\
  !*** ./resources/js/profession-events.js ***!
  \*******************************************/
/***/ (() => {

var actualPhase = document.getElementById("actual_phase");
var phases = document.querySelectorAll(".phases_list .phase");
phases.forEach(function (el, i) {
  el.addEventListener("click", function (e) {
    var actualActive = document.querySelector(".phase.active");
    var nextActive = phases[i];
    actualActive.classList.remove("active");
    nextActive.classList.add("active");
    var newImg = nextActive.querySelector(".img img").src;
    var newTitle = nextActive.getElementsByClassName("title")[0].innerHTML;
    var newContent = nextActive.getElementsByClassName("description")[0].innerHTML;
    actualPhase.querySelector(".p_img img").src = newImg;
    actualPhase.getElementsByClassName("p_title")[0].innerHTML = newTitle;
    actualPhase.getElementsByClassName("p_descrip")[0].innerHTML = newContent;
  });
});
var actualReq = document.getElementById("actual_req");
var reqs = document.querySelectorAll("#reqs_list #req");
reqs.forEach(function (el, i) {
  el.addEventListener("click", function (e) {
    var actualActive = document.querySelector("#req.active");
    var nextActive = reqs[i];
    actualActive.classList.remove("active");
    nextActive.classList.add("active");
    var newImg = nextActive.querySelector(".img img").src;
    var newTitle = nextActive.getElementsByClassName("title")[0].innerHTML;
    var newContent = nextActive.getElementsByClassName("description")[0].innerHTML;
    actualReq.querySelector(".p_img img").src = newImg;
    actualReq.getElementsByClassName("p_title")[0].innerHTML = newTitle;
    actualReq.getElementsByClassName("p_descrip")[0].innerHTML = newContent;
  });
});
/**
 * Menú lateral
 */

(function () {
  var sections = document.querySelectorAll(".single_section");
  var sectionsPos = [];
  sections.forEach(function (sec) {
    var id = sec.id;
    var documentOffset = window.pageYOffset;
    var sectionData = sec.getBoundingClientRect();
    var absolutePos = documentOffset + sectionData.top - 150;
    sectionsPos[id] = absolutePos;
  });
  var menuSections = document.querySelectorAll(".career_menu_section");
  menuSections.forEach(function (sec) {
    sec.addEventListener("click", function () {
      var id = sec.dataset.id;
      window.scrollTo({
        top: sectionsPos[id]
      });
      changeSelected(id);
    });
  });
  var sectionPosKeys = Object.keys(sectionsPos);
  var sectionPosVals = Object.values(sectionsPos);
  window.addEventListener("scroll", function (e) {
    var index = sectionPosVals.findIndex(function (val, idx, arr) {
      var pos = window.pageYOffset + 150;
      return !idx && pos < val || idx == sectionPosVals.length - 1 && pos > val || pos > val && pos < arr[idx + 1];
    });
    var found = this.document.querySelector("[data-id=".concat(sectionPosKeys[index], "]"));
    if (!found.classList.contains("active")) changeSelected(sectionPosKeys[index]);
  });
})();

function changeSelected(id) {
  var newSelected = document.querySelector("[data-id=".concat(id, "]"));
  var actualSelected = document.querySelector(".career_menu_section.active");
  actualSelected.classList.remove("active");
  newSelected.classList.add("active");
}

/***/ }),

/***/ "./resources/scss/showcase-filter.scss":
/*!*********************************************!*\
  !*** ./resources/scss/showcase-filter.scss ***!
  \*********************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./resources/scss/results.scss":
/*!*************************************!*\
  !*** ./resources/scss/results.scss ***!
  \*************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./resources/scss/becas.scss":
/*!***********************************!*\
  !*** ./resources/scss/becas.scss ***!
  \***********************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./resources/scss/profesion.scss":
/*!***************************************!*\
  !*** ./resources/scss/profesion.scss ***!
  \***************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./resources/scss/demas-noticias.scss":
/*!********************************************!*\
  !*** ./resources/scss/demas-noticias.scss ***!
  \********************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./resources/scss/contact.scss":
/*!*************************************!*\
  !*** ./resources/scss/contact.scss ***!
  \*************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./resources/scss/universidades.scss":
/*!*******************************************!*\
  !*** ./resources/scss/universidades.scss ***!
  \*******************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./resources/scss/university-card.scss":
/*!*********************************************!*\
  !*** ./resources/scss/university-card.scss ***!
  \*********************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./resources/scss/footer.scss":
/*!************************************!*\
  !*** ./resources/scss/footer.scss ***!
  \************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./resources/scss/universidad.profesion.scss":
/*!***************************************************!*\
  !*** ./resources/scss/universidad.profesion.scss ***!
  \***************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./resources/scss/header.scss":
/*!************************************!*\
  !*** ./resources/scss/header.scss ***!
  \************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./resources/scss/general.scss":
/*!*************************************!*\
  !*** ./resources/scss/general.scss ***!
  \*************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./resources/scss/post.scss":
/*!**********************************!*\
  !*** ./resources/scss/post.scss ***!
  \**********************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./resources/scss/extranjero.scss":
/*!****************************************!*\
  !*** ./resources/scss/extranjero.scss ***!
  \****************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = __webpack_modules__;
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/chunk loaded */
/******/ 	(() => {
/******/ 		var deferred = [];
/******/ 		__webpack_require__.O = (result, chunkIds, fn, priority) => {
/******/ 			if(chunkIds) {
/******/ 				priority = priority || 0;
/******/ 				for(var i = deferred.length; i > 0 && deferred[i - 1][2] > priority; i--) deferred[i] = deferred[i - 1];
/******/ 				deferred[i] = [chunkIds, fn, priority];
/******/ 				return;
/******/ 			}
/******/ 			var notFulfilled = Infinity;
/******/ 			for (var i = 0; i < deferred.length; i++) {
/******/ 				var [chunkIds, fn, priority] = deferred[i];
/******/ 				var fulfilled = true;
/******/ 				for (var j = 0; j < chunkIds.length; j++) {
/******/ 					if ((priority & 1 === 0 || notFulfilled >= priority) && Object.keys(__webpack_require__.O).every((key) => (__webpack_require__.O[key](chunkIds[j])))) {
/******/ 						chunkIds.splice(j--, 1);
/******/ 					} else {
/******/ 						fulfilled = false;
/******/ 						if(priority < notFulfilled) notFulfilled = priority;
/******/ 					}
/******/ 				}
/******/ 				if(fulfilled) {
/******/ 					deferred.splice(i--, 1)
/******/ 					var r = fn();
/******/ 					if (r !== undefined) result = r;
/******/ 				}
/******/ 			}
/******/ 			return result;
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/jsonp chunk loading */
/******/ 	(() => {
/******/ 		// no baseURI
/******/ 		
/******/ 		// object to store loaded and loading chunks
/******/ 		// undefined = chunk not loaded, null = chunk preloaded/prefetched
/******/ 		// [resolve, reject, Promise] = chunk loading, 0 = chunk loaded
/******/ 		var installedChunks = {
/******/ 			"/js/profession-events": 0,
/******/ 			"css/extranjero": 0,
/******/ 			"css/post": 0,
/******/ 			"css/general": 0,
/******/ 			"css/header": 0,
/******/ 			"css/universidad.profesion": 0,
/******/ 			"css/footer": 0,
/******/ 			"css/university-card": 0,
/******/ 			"css/universidades": 0,
/******/ 			"css/contact": 0,
/******/ 			"css/demas-noticias": 0,
/******/ 			"css/profesion": 0,
/******/ 			"css/becas": 0,
/******/ 			"css/results": 0,
/******/ 			"css/showcase-filter": 0
/******/ 		};
/******/ 		
/******/ 		// no chunk on demand loading
/******/ 		
/******/ 		// no prefetching
/******/ 		
/******/ 		// no preloaded
/******/ 		
/******/ 		// no HMR
/******/ 		
/******/ 		// no HMR manifest
/******/ 		
/******/ 		__webpack_require__.O.j = (chunkId) => (installedChunks[chunkId] === 0);
/******/ 		
/******/ 		// install a JSONP callback for chunk loading
/******/ 		var webpackJsonpCallback = (parentChunkLoadingFunction, data) => {
/******/ 			var [chunkIds, moreModules, runtime] = data;
/******/ 			// add "moreModules" to the modules object,
/******/ 			// then flag all "chunkIds" as loaded and fire callback
/******/ 			var moduleId, chunkId, i = 0;
/******/ 			for(moduleId in moreModules) {
/******/ 				if(__webpack_require__.o(moreModules, moduleId)) {
/******/ 					__webpack_require__.m[moduleId] = moreModules[moduleId];
/******/ 				}
/******/ 			}
/******/ 			if(runtime) var result = runtime(__webpack_require__);
/******/ 			if(parentChunkLoadingFunction) parentChunkLoadingFunction(data);
/******/ 			for(;i < chunkIds.length; i++) {
/******/ 				chunkId = chunkIds[i];
/******/ 				if(__webpack_require__.o(installedChunks, chunkId) && installedChunks[chunkId]) {
/******/ 					installedChunks[chunkId][0]();
/******/ 				}
/******/ 				installedChunks[chunkIds[i]] = 0;
/******/ 			}
/******/ 			return __webpack_require__.O(result);
/******/ 		}
/******/ 		
/******/ 		var chunkLoadingGlobal = self["webpackChunkup"] = self["webpackChunkup"] || [];
/******/ 		chunkLoadingGlobal.forEach(webpackJsonpCallback.bind(null, 0));
/******/ 		chunkLoadingGlobal.push = webpackJsonpCallback.bind(null, chunkLoadingGlobal.push.bind(chunkLoadingGlobal));
/******/ 	})();
/******/ 	
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module depends on other loaded chunks and execution need to be delayed
/******/ 	__webpack_require__.O(undefined, ["css/extranjero","css/post","css/general","css/header","css/universidad.profesion","css/footer","css/university-card","css/universidades","css/contact","css/demas-noticias","css/profesion","css/becas","css/results","css/showcase-filter"], () => (__webpack_require__("./resources/js/profession-events.js")))
/******/ 	__webpack_require__.O(undefined, ["css/extranjero","css/post","css/general","css/header","css/universidad.profesion","css/footer","css/university-card","css/universidades","css/contact","css/demas-noticias","css/profesion","css/becas","css/results","css/showcase-filter"], () => (__webpack_require__("./resources/scss/universidad.profesion.scss")))
/******/ 	__webpack_require__.O(undefined, ["css/extranjero","css/post","css/general","css/header","css/universidad.profesion","css/footer","css/university-card","css/universidades","css/contact","css/demas-noticias","css/profesion","css/becas","css/results","css/showcase-filter"], () => (__webpack_require__("./resources/scss/header.scss")))
/******/ 	__webpack_require__.O(undefined, ["css/extranjero","css/post","css/general","css/header","css/universidad.profesion","css/footer","css/university-card","css/universidades","css/contact","css/demas-noticias","css/profesion","css/becas","css/results","css/showcase-filter"], () => (__webpack_require__("./resources/scss/general.scss")))
/******/ 	__webpack_require__.O(undefined, ["css/extranjero","css/post","css/general","css/header","css/universidad.profesion","css/footer","css/university-card","css/universidades","css/contact","css/demas-noticias","css/profesion","css/becas","css/results","css/showcase-filter"], () => (__webpack_require__("./resources/scss/post.scss")))
/******/ 	__webpack_require__.O(undefined, ["css/extranjero","css/post","css/general","css/header","css/universidad.profesion","css/footer","css/university-card","css/universidades","css/contact","css/demas-noticias","css/profesion","css/becas","css/results","css/showcase-filter"], () => (__webpack_require__("./resources/scss/extranjero.scss")))
/******/ 	__webpack_require__.O(undefined, ["css/extranjero","css/post","css/general","css/header","css/universidad.profesion","css/footer","css/university-card","css/universidades","css/contact","css/demas-noticias","css/profesion","css/becas","css/results","css/showcase-filter"], () => (__webpack_require__("./resources/scss/showcase-filter.scss")))
/******/ 	__webpack_require__.O(undefined, ["css/extranjero","css/post","css/general","css/header","css/universidad.profesion","css/footer","css/university-card","css/universidades","css/contact","css/demas-noticias","css/profesion","css/becas","css/results","css/showcase-filter"], () => (__webpack_require__("./resources/scss/results.scss")))
/******/ 	__webpack_require__.O(undefined, ["css/extranjero","css/post","css/general","css/header","css/universidad.profesion","css/footer","css/university-card","css/universidades","css/contact","css/demas-noticias","css/profesion","css/becas","css/results","css/showcase-filter"], () => (__webpack_require__("./resources/scss/becas.scss")))
/******/ 	__webpack_require__.O(undefined, ["css/extranjero","css/post","css/general","css/header","css/universidad.profesion","css/footer","css/university-card","css/universidades","css/contact","css/demas-noticias","css/profesion","css/becas","css/results","css/showcase-filter"], () => (__webpack_require__("./resources/scss/profesion.scss")))
/******/ 	__webpack_require__.O(undefined, ["css/extranjero","css/post","css/general","css/header","css/universidad.profesion","css/footer","css/university-card","css/universidades","css/contact","css/demas-noticias","css/profesion","css/becas","css/results","css/showcase-filter"], () => (__webpack_require__("./resources/scss/demas-noticias.scss")))
/******/ 	__webpack_require__.O(undefined, ["css/extranjero","css/post","css/general","css/header","css/universidad.profesion","css/footer","css/university-card","css/universidades","css/contact","css/demas-noticias","css/profesion","css/becas","css/results","css/showcase-filter"], () => (__webpack_require__("./resources/scss/contact.scss")))
/******/ 	__webpack_require__.O(undefined, ["css/extranjero","css/post","css/general","css/header","css/universidad.profesion","css/footer","css/university-card","css/universidades","css/contact","css/demas-noticias","css/profesion","css/becas","css/results","css/showcase-filter"], () => (__webpack_require__("./resources/scss/universidades.scss")))
/******/ 	__webpack_require__.O(undefined, ["css/extranjero","css/post","css/general","css/header","css/universidad.profesion","css/footer","css/university-card","css/universidades","css/contact","css/demas-noticias","css/profesion","css/becas","css/results","css/showcase-filter"], () => (__webpack_require__("./resources/scss/university-card.scss")))
/******/ 	var __webpack_exports__ = __webpack_require__.O(undefined, ["css/extranjero","css/post","css/general","css/header","css/universidad.profesion","css/footer","css/university-card","css/universidades","css/contact","css/demas-noticias","css/profesion","css/becas","css/results","css/showcase-filter"], () => (__webpack_require__("./resources/scss/footer.scss")))
/******/ 	__webpack_exports__ = __webpack_require__.O(__webpack_exports__);
/******/ 	
/******/ })()
;