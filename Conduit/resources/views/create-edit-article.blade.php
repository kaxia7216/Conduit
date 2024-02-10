@include('layouts.head')
@include('layouts.header')
<div class="editor-page">
  <div class="container page">
    <div class="row">
      <div class="col-md-10 offset-md-1 col-xs-12">
        <!-- <ul class="error-messages">
          <li>That title is required</li>
        </ul> -->
        @if($editMode === 1)
          <form method="post" action="/edit/{{$article->id}}">
            <fieldset>
              @csrf
              <fieldset class="form-group">
                <input type="text" name="title" class="form-control form-control-lg" value="{{$article->title}}" />
              </fieldset>
              <fieldset class="form-group">
                <input type="text" name="theme" class="form-control" value="{{$article->theme}}" />
              </fieldset>
              <fieldset class="form-group">
                <textarea
                  name="text"
                  class="form-control"
                  rows="8"
                >{{$article->text}}</textarea>
              </fieldset>
              <fieldset class="form-group">
                <input type="text" class="form-control" placeholder="Enter tags" />
                <div class="tag-list">
                  <span class="tag-default tag-pill"> <i class="ion-close-round"></i> tag </span>
                </div>
              </fieldset>
              <button class="btn btn-lg pull-xs-right btn-primary" type="submit">
                Publish Article
              </button>
            </fieldset>
          </form>
        @else
          <form method="post" action="/create">
            <fieldset>
              @csrf
              <fieldset class="form-group">
                <input type="text" name="title" class="form-control form-control-lg" placeholder="Article Title" />
              </fieldset>
              <fieldset class="form-group">
                <input type="text" name="theme" class="form-control" placeholder="What's this article about?" />
              </fieldset>
              <fieldset class="form-group">
                <textarea
                  name="text"
                  class="form-control"
                  rows="8"
                  placeholder="Write your article (in markdown)"
                ></textarea>
              </fieldset>
              <fieldset class="form-group">
                <input type="text" class="form-control" placeholder="Enter tags" />
                <div class="tag-list">
                  <span class="tag-default tag-pill"> <i class="ion-close-round"></i> tag </span>
                </div>
              </fieldset>
              <button class="btn btn-lg pull-xs-right btn-primary" type="submit">
                Publish Article
              </button>
            </fieldset>
          </form>
        @endif
      </div>
    </div>
  </div>
</div>
@include('layouts.footer')