<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Post') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <section>
                        <form method="POST" action="{{ route('posts.update', $post)}}" class="space-y-6">
                            @csrf
                            @method('PUT')
                           
                            <!-- Title -->
                            <div>
                                <x-input-label for="title" :value="__('Title')" />
                                <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" required value="{{ $post->title ?? '' }}" />
                                <x-input-error :messages="$errors->get('title')" class="mt-2" />
                            </div>
                        
                            <!-- Content -->
                            <div>
                                <x-input-label for="content" :value="__('Content')" />
                                <textarea id="content" name="content" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" rows="6" required>{{ $post->content ?? '' }}</textarea>
                                <x-input-error :messages="$errors->get('content')" class="mt-2" />
                            </div>
                        
                            <!-- Publish Date -->
                            <div>
                                <x-input-label for="publish_date" :value="__('Publish Date (Opsional, jika kosong = langsung aktif)')" />
                                <x-text-input id="publish_date" name="publish_date" type="datetime-local" class="mt-1 block w-full" 
                                    value="{{ $post->publish_date ? $post->publish_date->format('Y-m-d\TH:i') : '' }}" />
                                <x-input-error :messages="$errors->get('publish_date')" class="mt-2" />
                            </div>
                        
                            <!-- Checkbox Save as Draft -->
                            <div>
                                <label for="is_draft" class="inline-flex items-center">
                                    <input id="is_draft" type="checkbox" value="1" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" 
                                        name="is_draft" {{ $post->status === 'Draft' ? 'checked' : '' }}>
                                    <span class="ms-2 text-sm text-gray-600">{{ __('Save as Draft') }}</span>
                                </label>
                            </div>
                        
                            <!-- Submit Button -->
                            <div class="flex items-center gap-4">
                                <x-primary-button>{{ __('Update') }}</x-primary-button>
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
