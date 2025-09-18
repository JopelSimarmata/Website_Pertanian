<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Login</h1>
    <form action="/login" method="POST" style="max-width: 350px; margin: 40px auto; padding: 24px; border: 1px solid #ccc; border-radius: 8px; background: #fafafa; box-shadow: 0 2px 8px rgba(0,0,0,0.05);">
        @csrf
        <div style="margin-bottom: 16px;">
            <label for="email" style="display: block; margin-bottom: 6px; font-weight: 500;">Email:</label>
            <input type="email" id="email" name="email" required style="width: 100%; padding: 8px; border: 1px solid #bbb; border-radius: 4px;">
        </div>
        <div style="margin-bottom: 20px;">
            <label for="password" style="display: block; margin-bottom: 6px; font-weight: 500;">Password:</label>
            <input type="password" id="password" name="password" required style="width: 100%; padding: 8px; border: 1px solid #bbb; border-radius: 4px;">
        </div>
        <button type="submit" style="width: 100%; padding: 10px; background: #4CAF50; color: #fff; border: none; border-radius: 4px; font-size: 16px; cursor: pointer;">Login</button>
    </form>
    </form>
</body>
</html>