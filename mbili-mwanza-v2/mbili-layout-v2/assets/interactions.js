(()=>{
'use strict';
function init(scope=document){
 scope.querySelectorAll('[data-mmv2-slider]:not([data-ready])').forEach(root=>{
  root.dataset.ready='true';
  const slides=[...root.querySelectorAll('[data-mmv2-slide]')], controls=root.querySelector('[data-mmv2-controls]');
  if(slides.length<2||!controls)return;
  const dots=[...root.querySelectorAll('[data-mmv2-dot]')],status=root.querySelector('[data-mmv2-status]');let current=0;
  const show=n=>{current=(n+slides.length)%slides.length;slides.forEach((s,i)=>s.hidden=i!==current);dots.forEach((d,i)=>d.setAttribute('aria-current',String(i===current)));if(status)status.textContent=(current+1)+' / '+slides.length;};
  controls.hidden=false;show(0);
  root.querySelector('[data-mmv2-prev]').addEventListener('click',()=>show(current-1));
  root.querySelector('[data-mmv2-next]').addEventListener('click',()=>show(current+1));
  dots.forEach((d,i)=>d.addEventListener('click',()=>show(i)));
  controls.addEventListener('keydown',e=>{if(e.key==='ArrowLeft'||e.key==='ArrowRight'){e.preventDefault();show(current+(e.key==='ArrowLeft'?-1:1));dots[current].focus();}});
 });
}
if(document.readyState==='loading')document.addEventListener('DOMContentLoaded',()=>init());else init();
if(window.jQuery)window.jQuery(window).on('elementor/frontend/init',()=>{if(window.elementorFrontend)window.elementorFrontend.hooks.addAction('frontend/element_ready/global',s=>init(s[0]));});
})();
