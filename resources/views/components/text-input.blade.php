@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-300 focus:border-alpha focus:ring-alpha rounded-md shadow-sm']) !!}>
