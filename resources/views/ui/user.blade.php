@if(Auth::check())
  <ul class="list -type-simple -type-inline">
    <li class="list__item"><a class="link" href="{{ url('/') }}">User</a></li>
    <li class="list__item"><a class="link" href="{{ url('auth/logout')}}">Sign out</a></li>
    <li class="list__item"><a class="link" href="{{ url('posts/new') }}">Create Post</a></li>
    <li class="list__item"><a class="link" href="{{ url('developer/edit') }}">Profile</a></li>
  </ul>
@endif
