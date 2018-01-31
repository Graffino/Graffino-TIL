const token = document.head.querySelector('meta[name="csrf-token"]').content;
const likesSource = document.getElementsByClassName('js-like');

let likesSubscription;

const isLiked = event => !!Cookies.get(`liked -${event.target.id}`);
const toggle = event => isLiked(event) ? unlike(event) : like(event);
const getCount = event => Array.from(event.target.children).filter(child => child.classList.contains('js-like-count'));
const updateClass = el => !!Cookies.get(`liked -${el.id}`) ? el.classList.add('is-liked') : el.classList.remove('is-liked');

Array.from(likesSource).map(el => updateClass(el));

const like = event => Rx.Observable
  .ajax({url: `${window.location.origin}/posts/like/${event.target.id}`, method: 'POST', body: {slug: event.target.id}, headers: {"X-CSRF-TOKEN": token}})
  .subscribe(data => {
    let count = getCount(event);

    Cookies.set(`liked -${event.target.id}`, 'liked', { expires: 3600, path: '/' });
    count[0].innerHTML = data.response;
    event.target.classList.add('is-liked');
  });

const unlike = event => Rx.Observable
  .ajax({url: `posts/unlike/${event.target.id}`, method: 'POST', body: {slug: event.target.id}, headers: {"X-CSRF-TOKEN": token}})
  .subscribe(data => {
    let count = getCount(event);

    Cookies.remove(`liked -${event.target.id}`, { expires: 3600, path: '/' });
    count[0].innerHTML = data.response;
    event.target.classList.remove('is-liked');
});

const $likesStream = Rx.Observable.fromEvent(likesSource, 'click')
  .map(event => {
    event.preventDefault();
    return event;
  })

if (likesSource != null) likesSubscription = $likesStream.subscribe(toggle);
