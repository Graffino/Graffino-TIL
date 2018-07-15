const editor = document.getElementById('editor');
let choiceSource = document.getElementById('editor-choice');

if (choiceSource != undefined) {
  choice = choiceSource.dataset.choice;
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

  codeEditor.on('changes', instance => {
    const value = instance.getValue();
    editor.value = value;
    var event = new Event('input', {
        'bubbles': true,
        'cancelable': true
    });

    editor.dispatchEvent(event);
  });
}
