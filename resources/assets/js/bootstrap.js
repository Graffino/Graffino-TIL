window.Rx = require('rxjs');
window.hljs = require("highlight.js");
window.Cookies = require("js-cookie");

hljs.initHighlightingOnLoad();

import Echo from 'laravel-echo'

window.Pusher = require('pusher-js');

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: '48c555271ceabb01ea19',
    cluster: 'eu',
    encrypted: true
});
