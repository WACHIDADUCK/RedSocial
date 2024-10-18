<!-- @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif -->

@if (session('success'))
<div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
    <strong class="font-bold">¡Éxito!</strong>
    <span class="block sm:inline">{{ session('success') }}</span>
    <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
        <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
            <title>Cerrar</title>
            <path d="M14.348 14.849a1 1 0 11-1.415 1.415L10 11.414l-2.933 2.933a1 1 0 01-1.415-1.415l2.933-2.933-2.933-2.933a1 1 0 111.415-1.415L10 8.586l2.933-2.933a1 1 0 011.415 1.415L11.414 10l2.933 2.933a1 1 0 010 1.416z" />
        </svg>
    </span>
</div>
@endif

<!--
@if (session('error'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
        <strong class="font-bold">Error:</strong>
        <span class="block sm:inline">{{ session('error') }}</span>
        <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
            <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Cerrar</title><path d="M14.348 14.849a1 1 0 11-1.415 1.415L10 11.414l-2.933 2.933a1 1 0 01-1.415-1.415l2.933-2.933-2.933-2.933a1 1 0 111.415-1.415L10 8.586l2.933-2.933a1 1 0 011.415 1.415L11.414 10l2.933 2.933a1 1 0 010 1.416z"/></svg>
        </span>
    </div>
@endif-->