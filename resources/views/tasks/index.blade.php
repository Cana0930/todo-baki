@extends("layouts.app")
@section("content")

  <div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
             <div class="card text-center">
                <div class="card-header">
                    投稿一覧
                </div>
                @foreach($tasks as $task)
                <div class="card-body">
                    <!-- タイトルをクリックすると内容をトグルする -->
                    <h5 class="card-title" style="cursor: pointer;">タイトル : {{ $task->title }}</h5>
                    <!-- トグル対象の内容部分 -->
                    <div class="toggle-content">
                        <p class="card-text">内容 : {{ $task->body }}</p>
                        <p class="card-text">投稿者：{{ $task->user->name }}</p>
                        <a href="{{ route("posts.show", $task->id) }}" class="btn btn-primary">詳細へ</a>
                    </div>
                </div>
                <div class="card-footer text-muted">
                    投稿日時 : {{ $task->created_at }}
                </div>
                @endforeach
            </div>
        </div>
        <div class="col-md-2">
            <a href="{{ route("tasks.create") }}" class="btn btn-primary">
              新規投稿
            </a>
        </div>
    </div>
  </div>

<!-- jQuery スクリプト -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function() {
      // 初期状態で内容を非表示にする
      $(".toggle-content").hide();

      // タイトルがクリックされたときの動作
      $(".card-title").click(function(e) {
          // クリックされたタイトルに対応する内容をトグル
          let content = $(this).next(".toggle-content");

          // 他の内容は閉じる
          $(".toggle-content").not(content).slideUp();

          // クリックしたタイトルの内容をトグル
          content.stop(true, true).slideToggle();

          // 他のクリックイベントが伝播しないようにする
          e.stopPropagation();
      });

      // タイトル以外のどこかをクリックしたときにすべての内容を閉じる
      $(document).click(function() {
          $(".toggle-content").slideUp();
      });
  });
</script>
@endsection

{{-- @extends('layouts.app')
@section('content')
  <div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
             <div class="card text-center">
            <div class="card-header">
                投稿一覧
            </div>
            @foreach($tasks as $task)
            <div class="card-body">

                <div class="color"></div>
                <h5 class="card-title">タイトル2 : {{ $task->title }}</h5>
                <p class="card-text">
                  内容 : {{ $task->body }}
                </p>
                <p class="card-text">投稿者：{{ $task->user->name }}</p>

                {{-- <a href="{{ route('posts.show', $post->id) }}" class="btn btn-primary">詳細へ</a> --}}
            {{-- </div>
            <div class="card-footer text-muted"> --}}
                {{-- 投稿日時 : {{ $post->created_at }} --}}
            </div>
            @endforeach
        </div>
        <div class="col-md-2"> --}}
          <a href="{{ route('tasks.create') }}" class="btn btn-primary">
            新規投稿
          </a>
        </div>
    </div>
  </div>
@endsection --}}