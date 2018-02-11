<article class="post">
  <header class="post__header">
    <span class="post__terminal-decorations"></span>
    <h1 class="post__title"><a href="{{ url('posts/'.$post->slug) }}">{{ $post->title }}</a></h1>
  </header>
  <div class="post__wrapper">
    {!! markdown($post->body) !!}
    <div class="post__info">
      <a class="post__author" href="{{ url('authors/'.$post->developer->username) }}">{{ $post->developer->username }}</a>
      <a class="post__timestamp" href="{{ url('posts/'.$post->slug) }}">{{ $post->created_at->format('d M y') }}</a>
    </div>
  </div>
  <footer class="footer">
    <ul class="post__actions">
      <li class="post__actions-item"><a href="{{ url('channel/'.$post->channel->id) }}">{{ $post->channel->name }}</a></li>
      <li class="post__actions-item"><a href="{{ url('posts/'.$post->slug) }}">Permalink</a></li>
      <li class="post__actions-item"><a href="{{ url('raw/'.$post->slug)}}">Raw</a></li>
      <li class="post__actions-item">
        <a id="{{ $post->slug }}" class="post__like js-like" href="#">
          &hearts;	
          <span class="post__like-count js-like-count">{{ $post->likes }}</span>
          <span class="post__like-label" style="display: none;">likes</span>
        </a>
      </li>
    </ul>
  </footer>
</article>
