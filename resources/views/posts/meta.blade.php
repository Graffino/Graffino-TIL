


  @section('meta_keywords', $post ?? '')

    <div class="form">
      <label class="form__label">Meta Tags</label>
          <div class="form__label">
            @if(!empty($post->seo))
              @foreach (json_decode($post->seo) as $keywords)
                <input type="text" class="form__input" name="meta_keywords" value="{{ old('$keywords', $keywords) or ''}}">
              @endforeach
            @else
              <input type="text" class="form__input" name="meta_keywords">
            @endif
            <label class="form__label">Description</label>
            @if(!empty( $post->description))
              <textarea id="description" class="form__textarea" name="description">{{ old('$post->description', $post->description) }}</textarea>
            @else
              <textarea id="description" class="form__textarea" name="description"></textarea>
            @endif
            <label class="form__label">Canonical URL</label>
            @if(!empty($post->canonical_url))
              <input type="text" class="form__input" name="canonical_url" value="{{ old('$post->canonical_url', $post->canonical_url)}}">
            @else
              <input type="text" class="form__input" name="canonical_url">
            @endif
          </div>
    </div>
