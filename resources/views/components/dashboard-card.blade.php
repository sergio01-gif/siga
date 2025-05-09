@props(['title', 'count', 'color'])

<div class="bg-white shadow rounded-lg p-4 border-t-4 border-{{ $color }}-500">
    <h3 class="text-sm text-gray-600">{{ $title }}</h3>
    <p class="text-3xl font-bold text-{{ $color }}-600">{{ $count }}</p>
</div>
