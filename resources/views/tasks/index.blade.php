@extends("layouts.app")
@section("content")

<link rel="stylesheet" href="{{ asset('/css/style.css') }}">

  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card text-center">
          <div class="card-header">ToDoリスト</div>
          <div class="col-md-2">
              <a href="{{ route("tasks.create") }}" class="btn btn-primary" id="shinkibtn">
                + 新規作成
              </a>
          </div>  
          <!-- ソート選択ドロップダウン -->
<form method="GET" action="{{ route('tasks.index') }}" class="sort-form">
  <select name="sort" onchange="this.form.submit()" class="form-select selector">
    <option value="">並び替え</option>
    <option value="created_at_asc" {{ request('sort') === 'created_at_asc' ? 'selected' : '' }}>投稿日時（昇順）</option>
    <option value="created_at_desc" {{ request('sort') === 'created_at_desc' ? 'selected' : '' }}>投稿日時（降順）</option>
    <option value="finish_date_asc" {{ request('sort') === 'finish_date_asc' ? 'selected' : '' }}>締切日（昇順）</option>
    <option value="finish_date_desc" {{ request('sort') === 'finish_date_desc' ? 'selected' : '' }}>締切日（降順）</option>
    <option value="color" {{ request('sort') === 'color' ? 'selected' : '' }}>色順</option>
  </select>
</form>              
        @foreach($tasks as $task)
          <div class="ichiran">
            <div class=dekita>
              <label>
                <form action="{{ route('tasks.destroy', ['id'=>$task->id]) }}" method="POST">
                  @csrf
                  @method('delete')
                  <input type="checkbox" class="input" onclick='if (confirm("本当に削除しますか？")) this.form.submit();'>
                </form>
                <span class="custom-checkbox"></span>
              </label>
            </div>
            <div class="card-body">
              {{-- <div class="card-left">
                <div class="color"></div>
              </div> --}}
              <div class="card-center">
                <div class="card-unhide">
                  <h5 class="card-title"><i class="fas fa-frog" style="color: {{ $task->color->color_code }};"></i>......{{ $task->title }}</h5>
                  <p class="card-finish_date">締切日：{{ $task->finish_date }}</p>
                  <p class="detail" style="cursor: pointer;">▽詳細</p> <!-- クリック対象を▽詳細に変更 -->
                </div>
                      <!-- トグル対象の内容部分 -->
                <div class="toggle-content">
                  <div id="modal" class="modal" style="display: none;">
                    <div class="modal-content">
                      <span class="close">&times;</span> <!-- モーダルを閉じるボタン -->
                      <img id="modal-img" src="" alt="拡大画像" style="width: 100%;">
                    </div>
                  </div>
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
                  <div class="btn">
                    <a href="{{ route('tasks.edit', ['id' => $task->id]) }}" class="btn btn-primary" id="editbtn">
                      編集
                    </a>
                    <form action='{{ route('tasks.destroy', ['id' => $task->id]) }}' method='POST'>
                      @csrf
                      @method('delete')
                      <input type='submit' value='削除' class="btn btn-danger" onclick='return confirm("本当に削除しますか？");' id="deletebtn">
                    </form>
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
  $(document).ready(function () {
    // 初期状態でモーダルを非表示に設定
    $("#modal").hide();
    $(".toggle-content").hide();

    // 画像クリックでモーダルを表示
    $(".img").click(function (e) {
        let src = $(this).attr("src");
        $("#modal-img").attr("src", src);
        $("#modal").fadeIn();
        e.stopPropagation(); // 他のクリックイベントを防止
    });

    // モーダル外をクリックでモーダルを閉じる
    $(document).click(function (e) {
        if (!$(e.target).closest(".modal-content").length) {
            // モーダルを閉じる
            $("#modal").fadeOut();

            // モーダルが閉じる際に詳細を閉じる
            $(".toggle-content").slideUp();
        }
    });

    // モーダル内の閉じるボタン
    $(".close").click(function () {
        // モーダルを閉じる
        $("#modal").fadeOut();

        // モーダルが閉じる際に詳細を閉じる
        $(".toggle-content").slideUp();
    });

    // ▽詳細クリックでトグル
    $(".detail").click(function (e) {
        let content = $(this).closest(".card-unhide").next(".toggle-content");

        // モーダルが開いている場合は詳細を閉じない
        if ($("#modal").is(":visible")) {
            e.stopPropagation();
            return;
        }

        // 他の内容を閉じる
        $(".toggle-content").not(content).slideUp();

        // クリックした詳細の内容をトグル
        content.stop(true, true).slideToggle();

        // 他のクリックイベントが伝播しないようにする
        e.stopPropagation();
    });

    // モーダルが閉じている場合に画面をクリックすると詳細を閉じる
    $(document).click(function () {
        if (!$("#modal").is(":visible")) {
            $(".toggle-content").slideUp();
        }
    });
});
</script>
@endsection



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