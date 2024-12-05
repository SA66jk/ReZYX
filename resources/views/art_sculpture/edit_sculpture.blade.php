<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Sculpture Edit</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f2f5;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            width: 90%;
            max-width: 600px;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        form {
            margin-bottom: 20px;
            padding: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
        }

        input[type="file"] {
            margin-bottom: 10px;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .upload-link {
            display: block;
            margin-top: 15px;
            text-decoration: none;
            color: #007BFF;
            font-weight: bold;
        }

        img {
            margin-top: 15px;
            border-radius: 5px;
            max-width: 100%;
            height: auto;
        }

        .uploaded-info {
            margin-top: 15px;
            padding: 10px;
            background-color: #f1f1f1;
            border-radius: 4px;
        }
    </style>
</head>

<body>
    <div class="container">
        <form method="POST" action="{{ url('/sculpture' , $id) }}" enctype="multipart/form-data">
            @csrf
            @method('put')
            <input type="file" name="upload">
            <input type="submit" value="Change Upload">
        </form>

        @if(!empty($id))
        <a href="{{ url('/sculpture', [$id, $originalName]) }}" class="upload-link">{{ $id }} {{ $originalName }}</a>
        @if(substr($mimeType, 0, 5) == 'image')
        <img src="{{ url('/sculpture', [$id, $originalName]) }}">
        @endif
        @endif

        <a href="{{ url('/sculpture') }}" class="upload-link">Sculpture</a>

        @isset($id)
        <div class="uploaded-info">
            {{ $id }} <br>
            {{ $path }} <br>
            {{ $originalName }} <br>
            {{ $mimeType }}
        </div>
        @endisset
    </div>
</body>

</html>
