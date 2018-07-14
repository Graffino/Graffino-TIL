const textarea = document.getElementsByTagName('textarea')[0];
let originalHeight;

if (textarea != undefined) {
  originalHeight = textarea.scrollHeight;
  textarea.addEventListener('input', handleHeight);
}

function handleHeight() {
    console.log(originalHeight);
    if (textarea.scrollHeight > originalHeight) {
        textarea.style.height = `${textarea.scrollHeight}px`;
    } else {
        textarea.style.height = originalHeight;
    }
}
