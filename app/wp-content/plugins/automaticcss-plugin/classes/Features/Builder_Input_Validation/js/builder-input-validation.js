!function(){let d=[{regex:/: *([^;]*?)(?=;|$)/g,prefix:": ",replaceWith:"<group1>"}],u=[{regex:/(var\(|var\( )(--[^\s\(\)\+\*\/]+)(\)| \))?/g,replaceWith:"<group2>"},{regex:/^calc\( *(.*?[^\)]) *$/g,replaceWith:"calc(<group1>)"},{regex:/--[^\s\(\)\+\*\/]+/g,replaceWith:"var(<match>)"},{regex:/^(?!calc\()([^\s]+ +[\*\+\/\-] +[^\s]+)/g,replaceWith:"calc(<match>)"},{regex:/^(?!calc\()(var\(\S+|\d+\.?\d*[a-z]{0,3}|\d+) *([\*\+]) *(var\(\S+|\d+\.?\d*[a-z]{0,3}|\d+)/g,replaceWith:"calc(<group1> <group2> <group3>)"},{regex:/^(calc\([^\s]+) *([\*\+\/]) *([^\s]+)/g,replaceWith:"<group1> <group2> <group3>"},{regex:/(\d[a-z]{2,3}|\d) (\-) (\d[a-z]{2,3}|\d)/g,replaceWith:"calc(<group1> <group2> <group3>)"}],t=()=>{let e,a="input[type='text']",n,c=".CodeMirror",r=()=>{};if(document.querySelector(".ng-scope"))e="#oxygen-sidebar",n=".oxygen-classes-dropdown-input, .custom-attributes, .custom-js, .code-php",r=e=>{var t=e.getAttribute("data-option");e.parentElement.querySelector(".oxygen-measure-box-units")&&$scope.iframeScope.setOptionUnit(t," ")};else{if(!document.querySelector(".brx-body.main"))return;e="#bricks-panel",n="#bricks-panel-element-classes input"}let s=(e,t,r)=>!e.closest(r)&&!!e.closest(t),l=(e,t,a)=>(e.forEach(o=>{t=t.replace(o.regex,(e,...t)=>{let r="";for(r=o.replaceWith.replace("<match>",e),i=0;i<t.length;i++)r=r.replace(`<group${i+1}>`,t[i]);return a&&(r=l(a,r)),r=""+(o.prefix??"")+r+(o.suffix??"")})}),t);var t;document.querySelector(e).addEventListener("keydown",e=>{let t=e.target;var r,o;s(t,a,n)&&")"===e.key&&((r=(o=t.value).match(/\(/g))?r.length:0)===((r=o.match(/\)/g))?r.length:0)&&(e.preventDefault(),o=t.selectionStart,")"==t.value.charAt(o)&&(t.selectionStart=t.selectionStart+1),t.classList.add("acss-input-error"),setTimeout(()=>{t.classList.remove("acss-input-error")},500))}),document.querySelector(e).addEventListener("keydown",e=>{var t=e.target;s(t,a,n)&&"Enter"===e.key&&(e=l(u,t.value),t.value=e,t.dispatchEvent(new Event("input",{bubbles:!0})),r(t))}),document.querySelector(e).addEventListener("keydown",e=>{var t,r,o,a,n=document.querySelector(c);n&&n.contains(e.target)&&";"==e.key&&(t=n.CodeMirror.doc.getValue(),o={...r=n.CodeMirror.doc.getCursor(),ch:0},a=n.CodeMirror.doc.indexFromPos(r),o=n.CodeMirror.doc.indexFromPos(o),o=t.slice(o,a),";"===t.charAt(a)&&e.preventDefault(),(a=l(d,o,u))!==o)&&(e=t.replace(o,a),n.CodeMirror.doc.setValue(e),n.CodeMirror.doc.setCursor(r.line,9999))}),document.querySelector(e).addEventListener("input",function(t,r){let o;return(...e)=>{clearTimeout(o),o=setTimeout(()=>{t.apply(this,e)},r)}}(t=>{let r=null,e=null;var o=document.querySelector(c);if(o?(r=o,e=r.CodeMirror.doc.getValue()):(r=t.target,s(r,a,n)&&(e=r.value)),null!==e){var o=e.match(/\(/g),t=o?o.length:0,o=e.match(/\)/g);if(t!==(o?o.length:0)){t="Your input contains unbalanced brackets.",o=r;console.warn(t,o);let e=document.querySelector("#acss-error-message");e||((e=document.createElement("div")).id="acss-error-message"),e.style.top=o.getBoundingClientRect().bottom+"px",o.matches(c)&&(e.style.top=o.getBoundingClientRect().top-15+"px"),e.style.left=o.getBoundingClientRect().left+"px",document.querySelector("body").appendChild(e),e.innerHTML=t,e.classList.remove("acss-hidden"),setTimeout(()=>{e.classList.add("acss-hidden")},5e3),o.classList.add("acss-input-error")}else t=r,(o=document.querySelector("#acss-error-message"))&&(o.innerHTML="",o.classList.add("acss-hidden")),t.classList.remove("acss-input-error")}},750)),(t=document.createElement("style")).textContent=`
:root {
    --acss-red: #ff0000;
}

#acss-error-message {
    position: absolute;
    background-color: var(--acss-red);
    color: white;
    padding: .1em;
    font-size: .6em;
    font-weight: bold;
    z-index: 9999;
}

.acss-input-error {
    outline: 1px solid var(--acss-red) !important;
    transition: border-width 0.3s linear;
}

.acss-hidden {
    display: none;
}
`,document.head.appendChild(t)};preInit=()=>{let e;null!=(e=null==(e=document.getElementById("bricks-builder-iframe"))?document.getElementById("ct-artificial-viewport"):e)&&e.addEventListener("load",()=>{t()})},document.addEventListener("DOMContentLoaded",preInit)}();