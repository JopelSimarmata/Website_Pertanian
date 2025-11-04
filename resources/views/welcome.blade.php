<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="/register" method="POST">
        @csrf
        <h2>Register</h2>
        <div>
            <label for="name">Nama Lengkap</label>
            <input type="text" id="name" name="name" required>
        </div>
        <div>
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div>
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
        </div>
        <div>
            <label for="password">Konfirmasi Password</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required>
        </div>
        <div>
            <label>Daftar Sebagai</label>
            <label><input type="radio" name="daftarSebagai" value="petani">Petani</label>
            <label><input type="radio" name="daftarSebagai" value="tengkulak">Tengkulak</label>
        </div>
        <button type="submit">Login</button>
    </form>
</body>
</html>