const flashClassName = 'alert';

const getFlashMessages = () => document.getElementsByClassName(flashClassName);
const checkFlashMessages = () => getFlashMessages().length > 0;

const clearFlashMessages = () => {
  if (checkFlashMessages()) getFlashMessages()[0].parentNode.removeChild(getFlashMessages()[0]);
}

if (checkFlashMessages()) document.onclick = clearFlashMessages;
