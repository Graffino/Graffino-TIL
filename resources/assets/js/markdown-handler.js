const source = document.getElementById('markdown-source');
const destination = document.getElementById('html-preview');

let subscription;

const updateHtml = html => destination.innerHTML = html;

const makeRequest = (data) => Rx.Observable
  .ajax({url: '/api/convert', method: 'POST', body: { raw: data }})
  .subscribe(console.log(`Converting "${data}" to html...`));

const $stream = Rx.Observable.fromEvent(source, 'input')
  .map(event => event.target.value)
  .filter(value => value.length >= 5)
  .distinctUntilChanged()
  .debounce(() => Rx.Observable.interval(800));

if (source != null) subscription = $stream.subscribe(makeRequest)

window.Echo.private('text-converter')
  .listen('TextConverted', e => updateHtml(e.text));
