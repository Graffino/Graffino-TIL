const markdownSource = document.getElementById('markdown-source');
const markdownDestination = document.getElementById('html-preview');

let markdownSubscription;

const updateHtml = html => markdownDestination.innerHTML = html;

const makeRequest = data => Rx.Observable
  .ajax({url: '/api/convert', method: 'POST', body: { raw: data }})
  .subscribe(console.log(`Converting "${data}" to html...`));

const $stream = Rx.Observable.fromEvent(markdownSource, 'input')
  .map(event => event.target.value)
  .filter(value => value.length >= 5)
  .distinctUntilChanged()
  .debounce(() => Rx.Observable.interval(800));

if (markdownSource != null) markdownSubscription = $stream.subscribe(makeRequest)

window.Echo.private('text-converter')
  .listen('TextConverted', e => updateHtml(e.text));
