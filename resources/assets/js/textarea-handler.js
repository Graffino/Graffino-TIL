const textarea = document.getElementsByTagName('textarea')[0];

if (textarea != undefined) {
  textarea.style.height = `${textarea.scrollHeight}px`;

  textarea.addEventListener('input', function() {
    textarea.style.height = `${textarea.scrollHeight}px`;
  });
}
