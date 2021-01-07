@section('meta_keywords',  $post)

  <div class="form">
    <label class="form__label">Meta Tags</label>
        <div class="form__label">
        @foreach ($post->seo as $keywords)
            <input type="text" class="form__input" name="meta_keywords" value="{{ old('$keywords', $keywords)}}">
          @endforeach
        </div>
  </div>