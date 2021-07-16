window.Rx = require("rxjs");
window.hljs = require("highlight.js");
window.Cookies = require("js-cookie");

window.CodeMirror = require("codemirror/lib/codemirror");
require("codemirror/keymap/vim");
require("codemirror/keymap/emacs");

hljs.highlightAll();

import Echo from "laravel-echo";

const domainName = document.head.querySelector(
    'meta[name="domain-name"]'
).content;

window.Pusher = require("pusher-js");

window.Echo = new Echo({
    broadcaster: "pusher",
    key: "48c555271ceabb01ea19",
    cluster: "eu",
    encrypted: true,
    authEndpoint: `${domainName}/broadcasting/auth`,
});
