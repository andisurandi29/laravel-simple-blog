<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Home') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl space-y-10 sm:px-6 lg:px-8">

            {{-- for gueset users --}}
            @guest
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <p>Please <a href="{{ route('login') }}" class="text-blue-500">login</a> or
                    <a href="{{ route('register') }}" class="text-blue-500">register</a>.</p>
                </div>
            </div>
            @endguest

            {{-- for authenticated users --}}
          @auth
          <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
            <div class="space-y-6 p-6">
                @if (session('success'))
                    <div class="bg-green-100 text-green-800 p-2 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif
                
                <h2 class="text-lg font-semibold">Your Posts</h2>
               @foreach ($posts as $post)
               <div class="rounded-md border p-5 shadow">
                <div class="flex items-center gap-2">
                    @if ($post->status === 'Draft')
                        <span class="flex-none rounded bg-yellow-100 px-2 py-1 text-yellow-800">{{$post->status}}</span>
                    @elseif ($post->status === 'Schedule')
                        <span class="flex-none rounded bg-blue-100 px-2 py-1 text-blue-800">{{$post->status}}</span>
                    @elseif ($post->status === 'Active')
                        <span class="flex-none rounded bg-green-100 px-2 py-1 text-green-800">{{$post->status}}</span>
                    @endif

                    <h3><a href="{{ route('posts.show', $post) }}" class="text-blue-500">{{$post->title}}</a></h3>
                </div>
                <div class="mt-4 flex items-end justify-between">
                    <div>
                        @if ($post->status != 'Draft')
                        <div>Published: {{$post->publish_date}}</div>
                        @endif
                        <div>Updated: {{$post->updated_at}}</div>
                    </div>
                    <div>
                        <a href="{{ route('posts.show', $post) }}" class="text-blue-500">Detail</a> / 
                        <a href="{{ route('posts.edit', $post) }}" class="text-blue-500">Edit</a> /
                        <form action="{{ route('posts.destroy', $post) }}" method="POST" class="inline-block" onsubmit="return confirmDelete()">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500">Delete</button>
                        </form>
                       
                    </div>
                </div>
            </div>
               @endforeach
               <div class="mt-4 flex justify-center">
                {{ $posts->links() }}
                </div>
            </div>
          </div>
          @endauth
        </div>
    </div>



    <script>
        function confirmDelete() {
            return confirm("Apakah kamu yakin ingin menghapus post ini?");
        }
    </script>

</x-app-layout>
