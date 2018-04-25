@if(Auth::check())
<div class="user__controls">
  <ul class="controls__list">
    <li class="list__item"><a class="link" href="{{ route('posts') }}">User</a></li>
    <li class="list__item"><a class="link" href="{{ route('logout') }}">Sign out</a></li>
    <li class="list__item"><a class="link" href="{{ route('posts.new') }}">Create Post</a></li>
    <li class="list__item"><a class="link" href="{{ route('profile.form') }}">Profile</a></li>
  </ul>
</div>
@endif
