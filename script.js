document.querySelector("span.site-title a").style.backgroundColor = "red";


var el = document.querySelector('span.site-title a');
// get HTML content
console.log(el.innerHTML);
el.replace("Scotland", "<span>Scotland</span>");	
console.log(el.innerHTML);