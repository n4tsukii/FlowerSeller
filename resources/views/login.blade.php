<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk6o2UwyJnUMPM3HbQoQ8fQmN7x+lwt8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxW8A8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>Đăng nhập</title>
    <style>
        .khung {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-image: linear-gradient(to top, #a18cd1 0%, #fbc2eb 100%);
        }
        .boxlogin {
            max-width: 600px;
            min-width: 400px;
            background: white;
            display: block;
            padding: 20px;
            border-radius: 17px;
        }
    </style>
</head>
<body>
    <div class="khung">
        <div class="boxlogin">
            <h1 class="text-center text-success">ĐĂNG NHẬP</h1>
            <form action="{{ route('website.dologin') }}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="username">
                        <strong>Tên đăng nhập</strong>
                    </label>
                    <input type="text" id="username" name="username" class="form-control" placeholder="Tên đăng nhập hoặc email" autofocus>
                </div>
                <div class="mb-3">
                    <label for="password">
                        <strong>Mật khẩu</strong>
                    </label>
                    <input type="password" id="password" name="password" class="form-control" placeholder="Mật khẩu">
                </div>
                <button type="submit" class="btn btn-success">Đăng nhập</button>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYwqLDIrZUI/4hqeoQieQmAZNXBecioYjo2IdadnWP+8ZaIJVT5EE2iyIGjE5UfqkhI9+M2T8gn3x+Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-50i+FSndj70KMY7JcPNT6y76oPBKUYO9e3RVT5ic2qP3RnlhpU5z7PJX9eTQ/L7O/nq25C6nPUWgoX76OMRYyQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    
    <!-- Auto focus to username input -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Focus vào ô username khi trang load xong
            const usernameInput = document.getElementById('username');
            if (usernameInput) {
                usernameInput.focus();
                
                // Đặt con trỏ ở cuối nếu có text
                usernameInput.setSelectionRange(usernameInput.value.length, usernameInput.value.length);
            }
        });

        // Backup focus bằng jQuery (nếu DOM chưa ready)
        $(document).ready(function() {
            $('#username').focus();
        });
    </script>
    
    @if (Session::has('message'))
    <script>
        toastr.options = {
            "progressBar": true,
            "closeButton": true
        }
        toastr.error("{{ Session::get('message') }}");
    </script>
    @endif
</body>
</html>