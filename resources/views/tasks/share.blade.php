@extends("layouts.app")
@section("content")

<link rel="stylesheet" href="{{ asset('/css/style.css') }}">

<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card text-center">
        <div class="card-header">Share ToDo</div>

        @foreach($groupedTasks as $userId => $tasks)
          @php
            $user = $tasks->first()->user; // ユーザー情報を取得
          @endphp

          <div class="user-tasks mb-4">
            <h4 class="user-name">▽ {{ $user->name }} さんのタスク ▽</h4>
            <div class="toggle">
            @foreach($tasks as $task)
            
              <div class="ichiran">
                <div class="card-body">
                  <div class="card-center">
                    <div class="card-unhide">
                      <h5 class="card-title">
                        <i class="fas fa-frog" style="color: {{ $task->color->color_code }};"></i>......{{ $task->title }}
                      </h5>
                      <p class="card-finish_date">締切日：{{ $task->finish_date }}</p>
                      <p class="detail" style="cursor: pointer;">▽詳細</p>
                    </div>
                    <div class="toggle-content">
                      <div class="card-left">
                        @if($task->image_at === 'img/noimage.png')
                        <img src="{{ asset($task->image_at) }}" alt="No Image" class="img">
                        @else
                        <img src="{{ asset('storage/' . $task->image_at) }}" alt="Task Image" class="img">
                        @endif
                      </div>
                      <div class="card-right">
                        <p class="card-text">内容 : {{ $task->contents }}</p>
                        <p class="card-finish_date">投稿日時 : {{ $task->created_at }}</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            @endforeach
           </div>
         </div>
        @endforeach
      </div>
    </div>
  </div>
</div>

<!-- jQuery スクリプト -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function() {
      $(".toggle-content").hide();

      $(".detail").click(function(e) {
        let content = $(this).closest(".card-unhide").next(".toggle-content");
        $(".toggle-content").not(content).slideUp();
        content.stop(true, true).slideToggle();
        e.stopPropagation();
      });

      $(document).click(function() {
        $(".toggle-content").slideUp();
      });


      //田中を隠すやつ
      // 初期設定: 全てのタスクを非表示
    $(".toggle").hide();

    // ユーザー名をクリックしたら、そのユーザーのタスクを全て表示/非表示
    $(".user-name").click(function(e) {
      let userTasks = $(this).next(".toggle"); // ユーザーに対応するタスク
      $(".toggle").not(userTasks).slideUp();  // 他のタスクを非表示
      userTasks.stop(true, true).slideToggle(); // 対応するタスクをトグル表示
      e.stopPropagation();
    });
    
    $(document).click(function() {
      $(".toggle").slideUp();
    });
    
    $(".user-name").click(function(e) {
      e.stopPropagation();
    });
  });
</script>
@endsection
