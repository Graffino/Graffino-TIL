import {fromEvent, interval} from 'rxjs';
import { map, filter, distinctUntilChanged, debounce} from 'rxjs/operators';
import { ajax } from 'rxjs/ajax';

const markdownSource = document.getElementById('editor');
const markdownDestination = document.getElementById('html-preview');

let markdownSubscription;

const updateHtml = html => markdownDestination.innerHTML = html;

const makeRequest = data => ajax({url: '/api/convert', method: 'POST', body: { raw: data }})
  .subscribe(console.log(`Converting "${data}" to html...`));

const $stream = fromEvent(markdownSource, 'input')
  .pipe(map(event => event.target.value),
  filter(value => value.length >= 5),
  distinctUntilChanged(),
  debounce(() =>interval(800)));

if (markdownSource != null) markdownSubscription = $stream.subscribe(makeRequest)

window.Echo.private('text-converter')
  .listen('TextConverted', e => updateHtml(e.text));
