@php
    $categoryId = $category_id ?? '';
@endphp
{{-- @foreach ($categories as $category)
        <option value="{{ $category->id }}" {{ $category->id == $category_id ? 'selected' : '' }}> {{ $category->title }}
        </option>
    @endforeach --}}
@foreach ($categories as $category)
    <option value="{{ $category->id }}" {{ $categoryId == $category->id ? 'selected' : '' }}>
        {{ $category->title }}
    </option>
@endforeach
