@extends("layouts.app")
@section("content")

<link rel="stylesheet" href="{{ asset('/css/style.css') }}">

  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card text-center">
          <div class="card-header">みんなのToDoリスト</div>           
        @foreach($tasks as $task)
          <div class="ichiran">
            <div class="card-body">
              <div class="card-center">
                <div class="card-unhide">
                  <h5 class="card-title"><i class="fas fa-frog" style="color: {{ $task->color->color_code }};"></i>......{{ $task->title }}</h5>
                  <p class="card-finish_date">締切日：{{ $task->finish_date }}</p>
                  <p class="detail" style="cursor: pointer;">▽詳細</p> <!-- クリック対象を▽詳細に変更 -->
                </div>
                      <!-- トグル対象の内容部分 -->
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
    </div>
  </div>

<!-- jQuery スクリプト -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function() {
      // 初期状態で内容を非表示にする
      $(".toggle-content").hide();

     // ▽詳細がクリックされたときの動作
    $(".detail").click(function(e) {
      // クリックされた詳細に対応する内容をトグル
      let content = $(this).closest(".card-unhide").next(".toggle-content");

      // 他の内容は閉じる
      $(".toggle-content").not(content).slideUp();

      // クリックした詳細の内容をトグル
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
