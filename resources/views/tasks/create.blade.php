@extends('layouts.app')
@section('content')
<div class="container mt-5">
   <div class="row justify-content-center">
        <div class="col-md-8">
            <form action="{{ route('tasks.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>タイトル</label>
                    <input type="text" class="form-control" placeholder="タイトルを入力して下さい" name="title">
                </div>
                <div class="form-group">
                    <label>詳細</label>
                    <textarea class="form-control" placeholder="内容" rows="5" name="contents"></textarea>
                </div>
                <div class="form-group dedline">
                    <label for="finish_date">いつまでに</label>
                    <input type="date" id="finish_date" name="finish_date" class="form-control">
                </div>
                <div class="form-group">
                    <label for="image_at">写真選択</label>
                    <input type="file" id="photo" name="image_at" class="form-control">
                </div>
                <div class="form-group">
                        <label for="color">色🐸？</label>
                    <select name="color_id" id="color" required>
                        @foreach($colors as $color)
                        <option value="{{ $color->id }}">{{ $color->color_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="button-container">
                    <button id="editbtn" type="submit" class="btn btn-primary">作成</button>
                </div>
            </form>
       </div>
   </div>
</div>
@endsection