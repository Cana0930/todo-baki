@extends('layouts.app')
@section('content')
   <body>
   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


      <canvas id="canvas" width="1024" height="1024"></canvas>

        <div class="welcomepage">
            
            <div class= toptitle>ToDo</div>
            
            <div class="logo-class"><img class="welcome-logo" src="{{ asset('img/logo2.png') }}" alt="カエルロゴ"></div>
            
            <div class= toptitle>BAKI</div>

        </div>
    </body>
</html>



<style>
html,body{
  margin: 0;
  padding: 0;
  overflow: hidden;
  height: 100%;
}

canvas{
  width: 100%;
  height: 100%;
  top: 0;
  left: 0;
  z-index: -1;
  position: fixed;  
}
.welcomepage {
    position: fixed;
    top: 170px;
    height: 100%;
    width: 100%;
    z-index: 1;
}
</style>

<script>
    $(document).ready(function () {
        var theCanvas = document.getElementById('canvas');
        var context = theCanvas.getContext('2d');
        theCanvas.width = window.innerWidth;
        theCanvas.height = window.innerHeight;
    
        var ballArray = [];
        var fuite = { x: 0.5, y: 0.5 };
    
        var keyboard = { x: 0, y: 0, left: false, right: false, up: false, down: false };
    
        $(document).keydown(function (e) {
            switch (e.keyCode) {
                case 37: keyboard.left = true; break;
                case 39: keyboard.right = true; break;
                case 38: keyboard.up = true; break;
                case 40: keyboard.down = true; break;
            }
        });
    
        $(document).keyup(function (e) {
            switch (e.keyCode) {
                case 37: keyboard.left = false; break;
                case 39: keyboard.right = false; break;
                case 38: keyboard.up = false; break;
                case 40: keyboard.down = false; break;
            }
        });
    
        var moveBalls = function () {
            ballArray.forEach(function (ball, index) {
                ball.z += (0.05 * Math.pow(ball.z, 1)) + 0.001;
                if (ball.z < 1) {
                    drawBall(ball);
                } else {
                    ballArray.splice(index, 1);
                }
            });
        };
    
        var drawBackground = function () {
            context.fillStyle = "#000";
            context.fillRect(0, 0, theCanvas.width, theCanvas.height);
        };
    
        var drawBall = function (ball) {
            var x = ((((ball.x - fuite.x) * ball.z * 3) + fuite.x) + (keyboard.x * ball.z)) * theCanvas.width;
            var y = ((((ball.y - fuite.y) * ball.z * 3) + fuite.y) + (keyboard.y * ball.z)) * theCanvas.height;
            context.beginPath();
            context.fillStyle = "#FFF";
            context.arc(
                x, y,
                5 * ball.z, // 半径
                0,          // 開始角度
                2 * Math.PI // 終了角度
            );
            context.fill();
            context.closePath();
        };
    
        var ball = function () {
            return { x: Math.random(), y: Math.random(), z: 0 };
        };
    
        setInterval(function () {
            ballArray.push(new ball());
        }, 50);
    
        function animate() {
            if (keyboard.left) keyboard.x -= keyboard.x > -0.5 ? 0.01 : 0;
            if (keyboard.right) keyboard.x += keyboard.x < 0.5 ? 0.01 : 0;
            if (keyboard.up) keyboard.y -= keyboard.y > -0.5 ? 0.01 : 0;
            if (keyboard.down) keyboard.y += keyboard.y < 0.5 ? 0.01 : 0;
    
            drawBackground();
            moveBalls();
            requestAnimationFrame(animate);
        }
    
        animate();
    });
    </script>

@endsection