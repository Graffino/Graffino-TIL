window.Rx = require('rxjs');
window.hljs = require("highlight.js");
window.Cookies = require("js-cookie");

window.CodeMirror = require("codemirror");
require('../../../node_modules/codemirror/keymap/vim.js');
require('../../../node_modules/codemirror/keymap/emacs.js');

hljs.initHighlightingOnLoad();

import Echo from 'laravel-echo'

window.Pusher = require('pusher-js');

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: '48c555271ceabb01ea19',
    cluster: 'eu',
    encrypted: true
});
