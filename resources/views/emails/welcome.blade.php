
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Post</title>
    <style>
        body{
            font-family: Arial, sans-serif;
            color:#151515;
        }

        .card {
            margin: 20px;
            background-color: white;
            padding: 1.5rem; 
            border-radius: 0.5rem; 
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border: 1px solid #cbd5e1; 
          
        }
    
        .card h2 {
            font-weight: bold; 
            font-size: 1.25rem; 
        }
    
        .card .text-sm {
            font-size: 0.875rem; 
        }
    
        .card img {
            height: 9rem; 
            width: 100%; 
            object-fit: cover; 
            border-radius: 0.5rem; 
        }
    </style>
</head>
<body>
    <h2>Hello {{ $user->username }}!</21>
    <h4>You created the post "{{ $post->title }}".</h4>
        <div class="card">
            <h2>{{$post->title}}</h2>
            <div class="text-sm">
                <p> {{ $post->body }} </p>
            </div>
            <img src="{{ $message->embed('storage/'. $post->image) }}" alt="">
        </div>

</body>
</html>
