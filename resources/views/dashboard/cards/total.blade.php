<div class="{{ $bgColor }} text-white p-6 rounded-lg shadow-lg flex items-center justify-between">
    <div>
        <h2 class="text-xl font-semibold">{{ $title }}</h2>
        <p class="text-2xl">{{ $count }}</p>
    </div>
    <svg class="w-12 h-12 {{ $icon }}" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
        <path d="{{ $iconPath }}" />
    </svg>
</div>
