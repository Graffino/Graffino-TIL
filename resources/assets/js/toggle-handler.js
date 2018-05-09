const toggleBtn = document.getElementsByClassName("js-toggle-button"),
  toggleEl = document.getElementsByClassName("js-toggle-element");


const findAncestor = function(el, cls) {
    while ((el = el.parentElement) && !el.classList.contains(cls));
    return el;
};

Array.from(toggleBtn).map(item => {
  item.addEventListener("click", function(event) {
    event.preventDefault();

    let ancestor = findAncestor(event.target, 'js-toggle-container');
    let el = Array.from(ancestor.children).filter(child => child.classList.contains('js-toggle-element'))[0];

    if (el.classList.contains('is-visible') || ancestor.contains(event.target)) {
      el.classList.remove('is-visible');
    } else {
      el.classList.add('is-visible');
    }
  }, false);
});
