<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-alpha border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-alpha/70 focus:bg-alpha/70 active:bg-alpha/90 focus:outline-none focus:ring-2 focus:ring-alpha focus:ring-offset-2 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
