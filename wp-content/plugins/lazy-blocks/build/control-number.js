!function(){var e={1991:function(e,t){var n;!function(){"use strict";var a=function(){function e(){}function t(e,t){for(var n=t.length,a=0;a<n;++a)l(e,t[a])}e.prototype=Object.create(null);var n={}.hasOwnProperty,a=/\s+/;function l(e,l){if(l){var r=typeof l;"string"===r?function(e,t){for(var n=t.split(a),l=n.length,r=0;r<l;++r)e[n[r]]=!0}(e,l):Array.isArray(l)?t(e,l):"object"===r?function(e,t){if(t.toString===Object.prototype.toString||t.toString.toString().includes("[native code]"))for(var a in t)n.call(t,a)&&(e[a]=!!t[a]);else e[t.toString()]=!0}(e,l):"number"===r&&function(e,t){e[t]=!0}(e,l)}}return function(){for(var n=arguments.length,a=Array(n),l=0;l<n;l++)a[l]=arguments[l];var r=new e;t(r,a);var o=[];for(var c in r)r[c]&&o.push(c);return o.join(" ")}}();e.exports?(a.default=a,e.exports=a):void 0===(n=function(){return a}.apply(t,[]))||(e.exports=n)}()}},t={};function n(a){var l=t[a];if(void 0!==l)return l.exports;var r=t[a]={exports:{}};return e[a](r,r.exports,n),r.exports}n.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return n.d(t,{a:t}),t},n.d=function(e,t){for(var a in t)n.o(t,a)&&!n.o(e,a)&&Object.defineProperty(e,a,{enumerable:!0,get:t[a]})},n.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},function(){"use strict";var e=window.wp.element,t=window.wp.i18n,a=window.wp.hooks,l=window.wp.components,r=n(1991),o=n.n(r);function c(t){const{label:n,help:a,className:l,children:r,...c}=t;return(0,e.createElement)("div",{...c,className:o()("lazyblocks-component-base-control",l)},n?(0,e.createElement)("div",{className:"lazyblocks-component-base-control__label"},n):null,r,a?(0,e.createElement)("div",{className:"lazyblocks-component-base-control__help"},a):null)}const{controls:s={}}=window.lazyblocksConstructorData||window.lazyblocksGutenberg;function i(e,{className:t,...n}={}){const a=(l=e.data.type)&&s[l]?s[l]:!!s.undefined&&s.undefined;var l;return{label:!!a.restrictions.label_settings&&e.data.label,help:!!a.restrictions.help_settings&&e.data.help,className:o()(`lazyblocks-control lazyblocks-control-${e.data.type}`,t),"data-lazyblocks-control-name":e.data.name,...n}}(0,a.addFilter)("lzb.editor.control.number.render","lzb.editor",((t,n)=>{const a=n.data.characters_limit?parseInt(n.data.characters_limit,10):"";return(0,e.createElement)(c,{...i(n,{label:!1})},(0,e.createElement)(l.TextControl,{type:"number",label:n.data.label,maxLength:a,min:n.data.min,max:n.data.max,step:n.data.step,placeholder:n.data.placeholder,value:n.getValue(),onChange:e=>{n.onChange(parseFloat(e))}}))})),(0,a.addFilter)("lzb.constructor.control.number.settings","lzb.constructor",((n,a)=>{const{updateData:r,data:o}=a;return(0,e.createElement)(e.Fragment,null,(0,e.createElement)(l.PanelBody,null,(0,e.createElement)(l.TextControl,{label:(0,t.__)("Minimum Value","lazy-blocks"),type:"number",step:o.step,value:o.min,onChange:e=>r({min:e})})),(0,e.createElement)(l.PanelBody,null,(0,e.createElement)(l.TextControl,{label:(0,t.__)("Maximum Value","lazy-blocks"),type:"number",step:o.step,value:o.max,onChange:e=>r({max:e})})),(0,e.createElement)(l.PanelBody,null,(0,e.createElement)(l.TextControl,{label:(0,t.__)("Step Size","lazy-blocks"),type:"number",value:o.step,onChange:e=>r({step:e})})),(0,e.createElement)(l.PanelBody,null,(0,e.createElement)(l.TextControl,{label:(0,t.__)("Placeholder","lazy-blocks"),value:o.placeholder,onChange:e=>r({placeholder:e})})))}))}()}();