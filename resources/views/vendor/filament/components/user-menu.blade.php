@if(auth()->check())
<div class="flex items-center space-x-3">
    <!-- User Avatar -->
    <div class="flex items-center space-x-2">
        @if(auth()->user()->photo)
            <img src="{{ asset('profile-pictures/' . auth()->user()->photo) }}" 
                 alt="{{ auth()->user()->name }}" 
                 class="w-8 h-8 rounded-full object-cover border-2 border-gray-300">
        @else
            <div class="w-8 h-8 rounded-full bg-gray-300 flex items-center justify-center text-gray-600 text-sm font-medium border-2 border-gray-300">
                {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
            </div>
        @endif
        
        <!-- User Name -->
        <div class="flex flex-col">
            <span class="text-sm font-medium text-gray-900 dark:text-white">
                {{ auth()->user()->name }}
            </span>
        </div>
    </div>
</div>
@endif