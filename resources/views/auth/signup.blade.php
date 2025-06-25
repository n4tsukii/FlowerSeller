<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk6o2UwyJnUMPM3HbQoQ8fQmN7x+lwt8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxW8A8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>Đăng ký</title>
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
            <h1 class="text-center text-success">ĐĂNG KÝ</h1>
            <form action="{{ route('website.dosignup') }}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="name">
                        <strong>Tên</strong>
                    </label>
                    <input type="text" id="name" name="name" class="form-control" placeholder="Nhập tên" value="{{ old('name') }}" required>
                    @error('name') <span class="text-danger small">{{ $message }}</span> @enderror
                </div>
                <div class="mb-3">
                    <label for="email">
                        <strong>Email</strong>
                    </label>
                    <input type="email" id="email" name="email" class="form-control" placeholder="Nhập email" value="{{ old('email') }}" required>
                    @error('email') <span class="text-danger small">{{ $message }}</span> @enderror
                </div>
                <div class="mb-3">
                    <label for="gender">
                        <strong>Giới tính</strong>
                    </label>
                    <select id="gender" name="gender" class="form-control" required>
                        <option value="">-- Chọn giới tính --</option>
                        <option value="1" {{ old('gender')=='1'?'selected':'' }}>Nam</option>
                        <option value="0" {{ old('gender')=='0'?'selected':'' }}>Nữ</option>
                    </select>
                    @error('gender') <span class="text-danger small">{{ $message }}</span> @enderror
                </div>
                <div class="mb-3">
                    <label for="phone">
                        <strong>Số điện thoại</strong>
                    </label>
                    <input type="text" id="phone" name="phone" class="form-control" placeholder="Nhập số điện thoại" value="{{ old('phone') }}" required>
                    @error('phone') <span class="text-danger small">{{ $message }}</span> @enderror
                </div>
                <div class="mb-3">
                    <label for="address">
                        <strong>Địa chỉ</strong>
                    </label>
                    <input type="text" id="address" name="address" class="form-control" placeholder="Nhập địa chỉ" value="{{ old('address') }}" required>
                    @error('address') <span class="text-danger small">{{ $message }}</span> @enderror
                </div>
                <div class="mb-3">
                    <label for="password">
                        <strong>Mật khẩu</strong>
                    </label>
                    <input type="password" id="password" name="password" class="form-control" placeholder="Mật khẩu" required>
                    @error('password') <span class="text-danger small">{{ $message }}</span> @enderror
                </div>
                <div class="mb-3">
                    <label for="password_confirmation">
                        <strong>Xác nhận mật khẩu</strong>
                    </label>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Xác nhận mật khẩu" required>
                </div>
                <button type="submit" class="btn btn-success w-100">Đăng ký</button>
            </form>
            <div class="mt-3 text-center">
                <a href="{{ route('website.getlogin') }}">Đã có tài khoản? Đăng nhập</a>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYwqLDIrZUI/4hqeoQieQmAZNXBecioYjo2IdadnWP+8ZaIJVT5EE2iyIGjE5UfqkhI9+M2T8gn3x+Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-50i+FSndj70KMY7JcPNT6y76oPBKUYO9e3RVT5ic2qP3RnlhpU5z7PJX9eTQ/L7O/nq25C6nPUWgoX76OMRYyQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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