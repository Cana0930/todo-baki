
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
                   <label>内容</label>
                   <textarea class="form-control" placeholder="内容" rows="5" name="body"></textarea>
               </div>
               <div class="form-group">
                    <label for="finish_date">デッドライン:</label>
                    <input type="date" id="finish_date" name="finish_date" class="form-control">
                 </div>
               <div class="form-group">
                   <label for="photo">Choose a photo!</label>
                   <input type="file" id="photo" name="photo" class="form-control">
               </div>
               <div class="form-group">
                   <label for="color">色選んで:</label>
                   <select name="color_id" id="color" required>
                    @foreach($colors as $color)
                     <option value="{{ $color->id }}">{{ $color->color_name }}</option>
                    @endforeach
                   </select>

               </div>
               <button type="submit" class="btn btn-primary">作成</button>
           </form>
       </div>
   </div>
</div>
@endsection