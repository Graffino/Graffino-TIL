  @section('meta_keywords', $post->seo ?? '')
  @section('description', $post->description ?? '')
  @section('canonical_url', $post->canonical_url ?? '')
  @section('social_image_url', $post->social_image_url ?? '')

  <article class="post">
  <header class="post__header">
    <span class="post__terminal-decorations"></span>
    <h2 class="post__title"><a href="{{ route('posts.show', $post->slug) }}">{{ $post->title }}</a></h2>
  </header>
  <div class="post__wrapper">
    {!! markdown($post->body) !!}
    <div class="post__info">
      <a class="post__author" href="{{ route('author', $post->developer->username) }}">{{ $post->developer->username }}</a>
      <a class="post__timestamp" href="{{ route('posts.show', $post->slug) }}">{{ $post->created_at->format('d M y') }}</a>
    </div>
  </div>
  <footer class="footer">
    <ul class="post__actions">
      <li class="post__actions-item"><a href="{{ route('channel', $post->channel->name) }}">{{ $post->channel->name }}</a></li>
      <li class="post__actions-item"><a href="{{ route('posts.show', $post->slug) }}">Permalink</a></li>
      <li class="post__actions-item"><a href="{{ route('raw', $post->slug) }}">Raw</a></li>
      <li class="post__actions-item">
        <a id="{{ $post->slug }}" class="post__like js-like" href="#">
          &hearts;
          <span class="post__like-count js-like-count">{{ $post->likes }}</span>
          <span class="post__like-label" style="display: none;">likes</span>
        </a>
      </li>
      @if(Auth::check())
        <li class="post__actions-item"><a href="{{ route('posts.edit', $post->id) }}">Edit</a></li>
      @endif
    </ul>
  </footer>
</article>
