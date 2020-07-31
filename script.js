var el = document.querySelector('.site-title a');
const orig = el.innerHTML;
const newString = orig.replace("Scotland", "<span style='font-weight: 400;'>Scotland</span>");
el.innerHTML = newString;