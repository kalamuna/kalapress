(()=>{"use strict";var e,a={795:(e,a,r)=>{const t=window.React,n=window.wp.blocks,l=window.wp.blockEditor,o=JSON.parse('{"$schema":"https://schemas.wp.org/trunk/block.json","apiVersion":3,"name":"native/cards-grid","version":"0.1.0","title":"Cards Grid","category":"kalapress","parent":["native/cards-section"],"icon":"grid-view","description":"Display a set of cards in a grid, and add blocks within each card.","keywords":["cards","cards grid","cards section","featured cards"],"supports":{"html":false,"align":["wide","full"],"spacing":{"margin":["top","bottom"],"padding":true}},"attributes":{"blockId":{"type":"string","default":""},"borderRadius":{"type":"string","default":"8px"},"cardColumns":{"type":"number","default":3},"cardContentPadding":{"type":"string","default":"1rem"},"cardPadding":{"type":"string","default":"0"},"cardBackgroundColor":{"type":"string","default":"#fff"},"cardTextColor":{"type":"string","default":"#000"},"columnGap":{"type":"string","default":"1rem"},"rowGap":{"type":"string","default":"1rem"}},"example":{"viewportWidth":960},"textdomain":"native","editorScript":"file:./index.js","editorStyle":"file:./index.css","style":"file:./style-index.css","render":"file:./render.php"}'),i=window.wp.i18n,s=window.wp.domReady;r.n(s)()((function(){(0,n.registerBlockStyle)("native/cards-grid",{name:"cover",label:"Cover"}),(0,n.registerBlockStyle)("native/cards-grid",{name:"horizontal",label:"Horizontal"})}));const d=window.wp.components,c=e=>{const{attributes:a,setAttributes:r}=e;return(0,t.createElement)(t.Fragment,null,(0,t.createElement)(l.InspectorControls,null,(0,t.createElement)(d.PanelBody,{title:(0,i.__)("Layout","kalapress"),initialOpen:!0},(0,t.createElement)(d.RangeControl,{allowReset:!0,label:(0,i.__)("Columns","kalapress"),min:1,max:4,onChange:e=>r({cardColumns:e}),value:a.cardColumns,initialPosition:3,resetFallbackValue:3}),(0,t.createElement)(d.RangeControl,{allowReset:!0,label:(0,i.__)("Column Gap","kalapress"),min:.25,max:4.25,onChange:e=>r({columnGap:`${e}rem`}),value:a.columnGap,initialPosition:1,resetFallbackValue:1}),(0,t.createElement)(d.RangeControl,{allowReset:!0,label:(0,i.__)("Row Gap","kalapress"),min:.25,max:4.25,onChange:e=>r({rowGap:`${e}rem`}),value:a.rowGap,initialPosition:1,resetFallbackValue:1}))),(0,t.createElement)(l.InspectorControls,{group:"color",className:"panel__color"},(0,t.createElement)("div",{className:"full-width-control-wrapper panel__color"},(0,t.createElement)(l.PanelColorSettings,{enableAlpha:!0,clearable:!1,colorSettings:[{value:a.cardTextColor,onChange:e=>r({cardTextColor:e}),label:(0,i.__)("Card Text","kalapress"),isShownByDefault:!0},{value:a.cardBackgroundColor,onChange:e=>r({cardBackgroundColor:e}),label:(0,i.__)("Card Background","kalapress"),isShownByDefault:!0}]}),(0,t.createElement)(l.ContrastChecker,{fontSize:13,textColor:a.cardTextColor,backgroundColor:a.cardBackgroundColor}))),(0,t.createElement)(l.InspectorControls,{group:"dimensions"},(0,t.createElement)("div",{className:"full-width-control-wrapper"},(0,t.createElement)(d.RangeControl,{allowReset:!0,label:(0,i.__)("Card Padding","kalapress"),min:0,max:3,onChange:e=>r({cardPadding:`${e}rem`}),value:a.cardPadding,initialPosition:0,resetFallbackValue:0,step:.25,__nextHasNoMarginBottom:!0}),(0,t.createElement)(d.RangeControl,{allowReset:!0,label:(0,i.__)("Card Text Padding","kalapress"),min:1,max:3,onChange:e=>r({cardContentPadding:`${e}rem`}),value:a.cardContentPadding,initialPosition:1,resetFallbackValue:1,step:.25,__nextHasNoMarginBottom:!0}))),(0,t.createElement)(l.InspectorControls,{group:"border"},(0,t.createElement)("div",{className:"full-width-control-wrapper"},(0,t.createElement)(d.RangeControl,{allowReset:!0,label:(0,i.__)("Border Radius","kalapress"),min:0,max:8,onChange:e=>r({borderRadius:`${e}rem`}),value:a.borderRadius,initialPosition:0,resetFallbackValue:1,step:.25,__nextHasNoMarginBottom:!0}))))},{name:p}=o;(0,n.registerBlockType)(p,{...o,edit:e=>{const{clientId:a,attributes:r,setAttributes:n}=e,o={"--card-columns":r.cardColumns,"--row-gap":r.rowGap,"--column-gap":r.columnGap,"--card-text-color":r.cardTextColor,"--card-background-color":r.cardBackgroundColor,"--border-radius":r.borderRadius,"--card-padding":r.cardPadding,"--card-content-padding":r.cardContentPadding},i=(0,l.useBlockProps)({className:"cards-grid",style:o}),{children:s,...d}=(0,l.useInnerBlocksProps)(i,{allowedBlocks:[["native/card"]],template:[["native/card"],["native/card"],["native/card"]],orientation:"horizontal",templateLock:!1});return(0,t.createElement)(t.Fragment,null,(0,t.createElement)(c,{attributes:r,setAttributes:n}),(0,t.createElement)("div",{...d},s,(0,t.createElement)("div",{className:"cards-grid__appender"},(0,t.createElement)(l.ButtonBlockAppender,{rootClientId:a}))))},save:()=>(0,t.createElement)(l.InnerBlocks.Content,null)})}},r={};function t(e){var n=r[e];if(void 0!==n)return n.exports;var l=r[e]={exports:{}};return a[e](l,l.exports,t),l.exports}t.m=a,e=[],t.O=(a,r,n,l)=>{if(!r){var o=1/0;for(c=0;c<e.length;c++){for(var[r,n,l]=e[c],i=!0,s=0;s<r.length;s++)(!1&l||o>=l)&&Object.keys(t.O).every((e=>t.O[e](r[s])))?r.splice(s--,1):(i=!1,l<o&&(o=l));if(i){e.splice(c--,1);var d=n();void 0!==d&&(a=d)}}return a}l=l||0;for(var c=e.length;c>0&&e[c-1][2]>l;c--)e[c]=e[c-1];e[c]=[r,n,l]},t.n=e=>{var a=e&&e.__esModule?()=>e.default:()=>e;return t.d(a,{a}),a},t.d=(e,a)=>{for(var r in a)t.o(a,r)&&!t.o(e,r)&&Object.defineProperty(e,r,{enumerable:!0,get:a[r]})},t.o=(e,a)=>Object.prototype.hasOwnProperty.call(e,a),(()=>{var e={960:0,993:0};t.O.j=a=>0===e[a];var a=(a,r)=>{var n,l,[o,i,s]=r,d=0;if(o.some((a=>0!==e[a]))){for(n in i)t.o(i,n)&&(t.m[n]=i[n]);if(s)var c=s(t)}for(a&&a(r);d<o.length;d++)l=o[d],t.o(e,l)&&e[l]&&e[l][0](),e[l]=0;return t.O(c)},r=globalThis.webpackChunkkalapress=globalThis.webpackChunkkalapress||[];r.forEach(a.bind(null,0)),r.push=a.bind(null,r.push.bind(r))})();var n=t.O(void 0,[993],(()=>t(795)));n=t.O(n)})();