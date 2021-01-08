

  @section('meta_keywords', $post->seo ?? '')
  @section('description', $post->description ?? '')
  @section('canonical_url', $post->canonical_url ?? '')

    <div class="form">
      <label class="form__label">Meta Tags</label>
          <div class="form__label">
            <input type="text" class="form__input" name="meta_keywords" value="{{ old('$post->seo', $post->seo ?? '') }}">
            <label class="form__label">Description</label>
            <textarea id="description" class="form__textarea" name="description">{{ old('$post->description', $post->description ?? '') }}</textarea>
            <label class="form__label">Canonical URL</label>
            <input type="text" class="form__input" name="canonical_url" value="{{ old('$post->canonical_url', $post->canonical_url ?? '')}}">
          </div>
    </div>
