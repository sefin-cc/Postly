<x-layout>


    {{-- Session Messages --}}
    @if (session('status'))
        <x-flashMsg msg="{{ session('status') }}" />
    @endif

    <div class="mx-auto max-w-screen-sm card">
        <h1 class="title">Request a Password Reset Email</h1>
        <form action="{{ route('password.request') }}" method="post"  x-data="formSubmit" @submit.prevent="submit">
            @csrf

            {{-- Email --}}
            <div class="mb-4">
                <label for="email">Email</label>
                <input type="text" name="email" value="{{ old('email') }}"
                    class="input @error('email') ring-red-500 @enderror">

                @error('email')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            {{-- Submit Button --}}
            <button x-ref="btn" class="btn">Submit</button>
        </form>
    </div>
</x-layout>