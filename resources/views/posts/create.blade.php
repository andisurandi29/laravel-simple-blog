<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create New Post') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <section>
                        <form method="POST" action="{{ route('posts.store')}}" class="space-y-6">
                            @csrf
                           
                            <!-- Title -->
                            <div>
                                <x-input-label for="title" :value="__('Title')" />
                                <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" required value="{{ old('title') }}" />
                                <x-input-error :messages="$errors->get('title')" class="mt-2" />
                            </div>
                        
                            <!-- Content -->
                            <div>
                                <x-input-label for="content" :value="__('Content')" />
                                <textarea id="content" name="content" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" rows="6" required>{{ old('content') }}</textarea>
                                <x-input-error :messages="$errors->get('content')" class="mt-2" />
                            </div>
                        
                            <!-- Publish Date -->
                            <x-text-input id="publish_date" name="publish_date" type="datetime-local" class="mt-1 block w-full"
                                min="{{ now()->format('Y-m-d\TH:i') }}"
                                value="{{ old('publish_date') }}" />
                            <x-input-error :messages="$errors->get('publish_date')" class="mt-2" />
                        
                        
                            <!-- Checkbox Save as Draft -->
                            <div>
                                <label for="is_draft" class="inline-flex items-center">
                                    <input id="is_draft" type="checkbox" value="1" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" 
                                        name="is_draft" {{ old('is_draft') ? 'checked' : '' }}>

                                    <span class="ms-2 text-sm text-gray-600">{{ __('Save as Draft') }}</span>
                                </label>
                            </div>
                        
                            <!-- Submit Button -->
                            <div class="flex items-center gap-4">
                                <x-primary-button>{{ __('Post') }}</x-primary-button>
                            </div>
                        </form>
                        
                    </section>
                </div>
            </div>
        </div>
    </div>


    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let publishDateInput = document.getElementById("publish_date");
            if (publishDateInput) {
                let now = new Date();
                let minDate = now.toISOString().slice(0, 16); // Format YYYY-MM-DDTHH:MM
                publishDateInput.setAttribute("min", minDate);
        
                publishDateInput.addEventListener("change", function() {
                    if (this.value < minDate) {
                        alert("Tanggal publish tidak boleh kurang dari hari ini!");
                        this.value = minDate;
                    }
                });
            }
        });
    </script>
        
</x-app-layout>
