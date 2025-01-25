<x-layout>

    <a href="{{ route('dashboard') }}" class="block mb-2 text-xs text-blue-500"> &larr; Go back to your dashboard</a>

    <div class="card">
        <h2 class="font-bold mb-4">Update your Post</h2>
        <form action="{{ route('posts.update', $post) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="title">Post Title</label>
                <input type="text" name="title" value="{{ $post->title }}" class="input
                @error('title') ring-red-500 @enderror">
                @error('title')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="title">Post Content</label>
                <textarea name="body" rows="5" class="input" @error('body') ring-red-500 @enderror>
                    {{ $post->body }}
                </textarea>
                @error('body')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>
           
            @if ($post->image)
                <div class="mb-4">
                    <label>Current cover photo</label>
                    <img class="h-36 w-1/3 object-cover rounded-lg" src="{{ asset('storage/' . $post->image) }}" alt="" >
                </div>
             @endif
             <div class="mb-4">
                <label for="image">Cover photo</label>
                <input type="file" name="image" id="image" class="input
                @error('image') ring-red-500 @enderror">
                
                @error('image')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            <button class="btn">Update</button>
        </form>
    </div>

</x-layout>