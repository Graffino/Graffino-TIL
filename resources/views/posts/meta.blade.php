

@isset($post)
  @section('meta_keywords', $post)

    <div class="form">
      <label class="form__label">Meta Tags</label>
          <div class="form__label">
            @if( !empty( $post->seo ))
              @foreach (json_decode($post->seo) as $keywords)
                <input type="text" class="form__input" name="meta_keywords" value="{{ old('$keywords', $keywords)}}">
              @endforeach
            @else
              <input type="text" class="form__input" name="meta_keywords">
            @endif
          </div>
    </div>
@else
  <input type="text" class="form__input" name="meta_keywords">
@endisset

