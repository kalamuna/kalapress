!function(){"use strict";var e=window.React,t=window.wp.richText,a=window.wp.blockEditor,r=window.wp.i18n;(0,t.registerFormatType)("kalapress/screen-reader-text",{title:(0,r.__)("Screen Reader Text"),tagName:"span",className:"screen-reader-text-fe",edit:s=>{const{onChange:c,value:i,isActive:n}=s;return(0,e.createElement)(a.RichTextToolbarButton,{icon:"universal-access-alt",title:(0,r.__)("Screen Reader Text"),onClick:()=>{c((0,t.toggleFormat)(i,{type:"kalapress/screen-reader-text",attributes:{class:"dashicons-before dashicons-universal-access-alt"}}))},isActive:n})}})}();