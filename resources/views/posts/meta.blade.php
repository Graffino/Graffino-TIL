@extends('edit')
@section('content')
  <div class="meta-container">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Meta Tags</h3>
        </div>
        <div class="panel-body">
            <div class="form-group">
                <label>Keywords</label>
                <input name="meta_keywords" class="form-control">
            </div>
            <div class="form-group">
                <label>Description</label>
                <input name="meta_description" class="form-control">
            </div>
        </div>
    </div>
  </div>
@endsection