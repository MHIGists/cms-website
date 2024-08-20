<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white dark:text-gray-200 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
                <div>
                  <form method="GET" action="{{ route('save.color.choices') }}">
                  @csrf
                    <div>
                    <label for="background_color">Background Color:</label>
                    </div>   
                    <div>
                    <input type="color" id="background_color" name="background_color" value="{{ Auth::user()->background_color }}">
                    </div>   
                    <div>    
                    <label for="navlink_color">Navlink Color:</label>
                    </div>   
                    <div>
                    <input type="color" id="navlink_color" name="navlink_color" value="{{ Auth::user()->navlink_color }}">
                    </div>   
                      <x-primary-button>Save Color Choices</x-primary-button>
                    </form>
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
                
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
     
        </div>
    </div>
</x-app-layout>
