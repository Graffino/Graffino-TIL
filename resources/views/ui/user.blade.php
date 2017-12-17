@if(Auth::check())
<div class="user__controls">
  <ul class="controls__list">
    <li class="list__item"><a class="link" href="{{ url('/') }}">User</a></li>
    <li class="list__item"><a class="link" href="{{ url('auth/logout')}}">Sign out</a></li>
    <li class="list__item"><a class="link" href="{{ url('posts/new') }}">Create Post</a></li>
    <li class="list__item"><a class="link" href="{{ url('profile/edit') }}">Profile</a></li>
  </ul>
</div>
@endif
