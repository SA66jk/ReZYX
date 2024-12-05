<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Art Museum/Paint</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            line-height: 1.6;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            margin: auto;
            overflow: hidden;
        }
        .art-list {
            list-style: none;
            padding: 0;
        }
        .art-item {
            background: #fff;
            margin-bottom: 20px;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .art-details {
            flex: 1;
        }
        .art-details h3 {
            margin: 0;
            font-size: 1.5em;
            color: #333;
        }
        .art-actions form {
            display: inline-block;
            margin-left: 10px;
        }
        .art-actions input[type="submit"] {
            background-color: #007BFF;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .art-actions input[type="submit"]:hover {
            background-color: #0056b3;
        }
        .add-file {
            text-align: right;
            margin-top: 20px;
        }
        .add-file a {
            text-decoration: none;
            background-color: #28a745;
            color: #fff;
            padding: 10px 20px;
            border-radius: 4px;
            transition: background-color 0.3s;
        }
        .add-file a:hover {
            background-color: #218838;
        }
        
        .link {
            text-align: right;
            margin-top: 20px;
        }
        .link a {
            text-decoration: none;
            background-color: #28a745;
            color: #fff;
            padding: 10px 20px;
            border-radius: 4px;
            transition: background-color 0.3s;
        }
        .link a:hover {
            background-color: #218838;
        }


    </style>
</head>
<body>
    <div class="container">
        <h1>Online Art Museum/Paint</h1>
        <ol class="art-list">
            @foreach ($uploads as $upload)
        
            <li class="art-item" value='{{ $upload->id }}'>
                <div class="art-details">
                    <h3>{{ $upload->originalName }}</h3>

                {{ $upload->title }} {{ $upload->content }}
                {{$upload->user->name}} {{ $upload->user->id }}    
                @auth
                <div class="art-actions">
                    <form method="POST" action='{{ url("/museum/{$upload->id}/edit") }}' style="display:inline;">
                        @csrf
                        @method('get')
                        <input type="submit" value="Edit">
                    </form>
                    <form method="POST" action='{{ url("/museum/{$upload->id}") }}' style="display:inline;">
                        @csrf
                        @method('delete')
                        <input type="submit" value="Delete">
                    </form>
                </div>
                @endauth
            </li>
            @endforeach
        </ol>

        @if (session('operation'))
            <div class="operation-message">
                {{ session('operation') }} {{ session('id') }}
            </div>
        @endif

        <div class="add-file">
            <a href="/museum/create">Add New Artwork</a>
        </div>


        <div class="link">
            <a href="/sculpture">Sculpture</a>
        </div>

    </div>
</body>
</html>


