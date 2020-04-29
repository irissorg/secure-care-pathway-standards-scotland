// document.querySelector("span.site-title a").style.backgroundColor = "red";
var el = document.querySelector('span.site-title a');
// get HTML content
// console.log(el.innerHTML);
const orig = el.innerHTML;
const newString = orig.replace("Scotland", "<span style='font-weight: 400;'>Scotland</span>");
el.innerHTML = newString;
// console.log(el.innerHTML);