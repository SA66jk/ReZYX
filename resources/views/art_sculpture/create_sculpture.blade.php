<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Artwork - Online Art Gallery</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }
        .upload-container {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 400px;
            text-align: center;
        }
        .upload-container h2 {
            margin-bottom: 20px;
            color: #007BFF;
        }
        .upload-container input[type="file"] {
            margin: 20px 0;
        }
        .upload-container input[type="submit"] {
            background-color: #28a745;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .upload-container input[type="submit"]:hover {
            background-color: #218838;
        }
        .uploaded-details {
            margin-top: 20px;
            text-align: left;
        }
        .uploaded-details a {
            color: #007BFF;
            text-decoration: none;
        }
        .uploaded-details a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="upload-container">
        <h2>Upload Your Artwork</h2>
        <form method="POST" action='{{ url("/sculpture") }}' enctype="multipart/form-data">
            @csrf
            <input type="file" name="upload">
            <br>
            <input type="submit" value="Save">

        </form>

        @if ( ! empty($id) )
            <div class="uploaded-details">
                <p>Uploaded File:</p>
                <a href="{{ url('/sculpture', [$id, $originalName]) }}">{{ $id }} {{ $originalName }}</a>

                @if(substr($mimeType, 0, 5) == 'image')
                    <br>
                    <img height="100" width="100" src='{{ url('/sculpture', [$id, $originalName]) }}'>
                @endif
            </div>
        @endif

        <div class="uploaded-details">
            <a href="{{ url('/sculpture') }}">View Sculpture Art</a>
        </div>

        @isset($id)
            <div class="uploaded-details">
                <p>Upload ID: {{ $id }}</p>
                <p>Path: {{ $path }}</p>
                <p>Original Name: {{ $originalName }}</p>
                <p>MIME Type: {{ $mimeType }}</p>
            </div>
        @endisset
    </div>
</body>
</html>