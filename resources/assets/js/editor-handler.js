const editor = document.getElementById('editor');
let choice;

if (choice != undefined) {
  choice = document.getElementById('editor-choice').dataset.choice;
}

if (/Code Editor|Vim|Emacs/.test(choice)) {
  let options;

  const defaultOptions = {
    lineNumbers: true,
    tabSize: 2,
    mode: 'gfm',
    insertSoftTab: true,
    smartIndent: false,
    lineWrapping: true
  };

  switch (choice) {
    case 'Vim':
      options = Object.assign({}, defaultOptions, {keyMap: 'vim'});
    break;
    case 'Emacs':
      options = Object.assign({}, defaultOptions, {keyMap: 'emacs'});
    break;
    default:
      options = defaultOptions;
  }

  const codeEditor = CodeMirror.fromTextArea(editor, options);
}
