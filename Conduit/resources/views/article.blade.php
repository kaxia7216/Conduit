 <?php //記事詳細画面?>
@include('layouts.head')
@include('layouts.header')
<div class="article-page">
  <div class="banner">
    <div class="container">
      <h1>{{$article->title}}</h1>
      <form id="article-edit" action="/edit/{{$article->id}}" method="GET"></form>
      <form id="article-delete" action="/delete/{{$article->id}}" method="GET"></form>
      <div class="article-meta">
        <!-- <a href="/profile/eric-simons"><img src="http://i.imgur.com/Qr71crq.jpg" /></a> -->
        <div class="info">
          <!-- <a href="/profile/eric-simons" class="author">Eric Simons</a> -->
          <span class="date">{{$article->created_at}}</span>
        </div>
        <!-- <button class="btn btn-sm btn-outline-secondary">
          <i class="ion-plus-round"></i>
          &nbsp; Follow Eric Simons <span class="counter">(10)</span>
        </button> -->
        &nbsp;&nbsp;
        <!-- <button class="btn btn-sm btn-outline-primary">
          <i class="ion-heart"></i>
          &nbsp; Favorite Post <span class="counter">(29)</span>
        </button> -->
          <button class="btn btn-sm btn-outline-secondary" form="article-edit">
            <i class="ion-edit"></i> Edit Article
          </button>
          <button class="btn btn-sm btn-outline-danger" form="article-delete" onclick='return confirm("本当に削除しますか？")'>
            <i class="ion-trash-a"></i> Delete Article
          </button>
      </div>
    </div>
  </div>

  <div class="container page">
    <div class="row article-content">
      <div class="col-md-12">
        <p>{{$article->text}}</p>
        <ul class="tag-list">
          @foreach($setTags as $setTag)
            <li class="tag-default tag-pill tag-outline">{{$setTag->name}}</li>
          @endforeach
        </ul>
      </div>
    </div>

    <hr />

    <div class="article-actions">
      <div class="article-meta">
        <!-- <a href="profile.html"><img src="http://i.imgur.com/Qr71crq.jpg" /></a> -->
        <div class="info">
          <!-- <a href="" class="author">Eric Simons</a> -->
          <span class="date">{{$article->created_at}}</span>
        </div>

        <!-- <button class="btn btn-sm btn-outline-secondary">
          <i class="ion-plus-round"></i>
          &nbsp; Follow Eric Simons
        </button> -->
        &nbsp;
        <!-- <button class="btn btn-sm btn-outline-primary">
          <i class="ion-heart"></i>
          &nbsp; Favorite Article <span class="counter">(29)</span>
        </button> -->
        <button class="btn btn-sm btn-outline-secondary" form="article-edit">
          <i class="ion-edit"></i> Edit Article
        </button>
        <button class="btn btn-sm btn-outline-danger" form="article-delete" onclick='return confirm("本当に削除しますか？")'>
          <i class="ion-trash-a"></i> Delete Article
        </button>
      </div>
    </div>

    <div class="row">
      <div class="col-xs-12 col-md-8 offset-md-2">
        @if ($errors->any())
        <ul class="error-messages">
          @foreach ($errors->all() as $error)
            <li>{{$error}}</li>
          @endforeach
        </ul>
        @endif
        <form class="card comment-form" method="POST" action="/add-comment/{{$article->id}}">
          @csrf
          <div class="card-block">
            <textarea class="form-control" placeholder="Write a comment..." rows="3" name="comment"></textarea>
          </div>
          <div class="card-footer">
            <!-- <img src="http://i.imgur.com/Qr71crq.jpg" class="comment-author-img" /> -->
            <button class="btn btn-sm btn-primary">Post Comment</button>
          </div>
        </form>

        @foreach($articleComments as $Comment)
          <div class="card">
            <div class="card-block">
              <p class="card-text">
                {{$Comment->comment}}
              </p>
            </div>
            <div class="card-footer">
              <!-- <a href="/profile/author" class="comment-author">
                <img src="http://i.imgur.com/Qr71crq.jpg" class="comment-author-img" />
              </a> -->
              &nbsp;
              <!-- <a href="/profile/jacob-schmidt" class="comment-author">Jacob Schmidt</a> -->
              <span class="date-posted">{{$Comment->created_at}}</span>
              <span class="mod-options">
                <a href="/delete-Comment/{{$Comment->id}}&{{$article->id}}"><i class="ion-trash-a"></i></a>
              </span>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </div>
</div>
@include('layouts.footer')