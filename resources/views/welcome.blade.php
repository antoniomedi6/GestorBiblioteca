<x-app-layout>
    <x-mios.base>
        <div class="container mx-auto px-4 py-12">

            <div class="text-center mb-12">
                <h1 class="text-4xl font-bold text-gray-900 mb-4">
                    <span class="text-indigo-600"><i class="fas fa-book-open mr-2"></i>Biblioteca</span> Digital
                </h1>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Bienvenido a nuestro catálogo público. Explora nuestra colección de libros disponibles para
                    préstamo. Inicia sesión para gestionar reservas.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                @foreach ($libros as $item)
                    <article
                        class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1 flex flex-col h-full border border-gray-100">
                        <div class="relative h-80 overflow-hidden bg-gray-100 group">
                            <img src="{{ Storage::url($item->portada) }}" alt="Portada {{ $item->titulo }}"
                                class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">

                            <div class="absolute bottom-4 left-4">
                                <span
                                    class="bg-black/70 text-white text-xs font-semibold px-3 py-1 rounded-lg backdrop-blur-sm border border-white/20">
                                    {{ $item->categoria->nombre }}
                                </span>
                            </div>
                        </div>

                        <div class="p-6 flex-1 flex flex-col">
                            <div
                                class="flex items-center text-gray-400 text-xs font-semibold mb-2 uppercase tracking-wider">
                                <i class="fas fa-calendar-alt mr-1.5"></i> {{ $item->anio_publicacion }}
                            </div>

                            <h3 class="text-xl font-bold text-gray-900 leading-tight mb-2">
                                {{ $item->titulo }}
                            </h3>

                            <p class="text-gray-600 mb-4 font-medium flex items-center">
                                <span
                                    class="w-6 h-6 rounded-full bg-gray-100 flex items-center justify-center mr-2 text-xs text-gray-500">
                                    <i class="fas fa-user"></i>
                                </span>
                                {{ $item->author->nombre }} {{ $item->author->apellidos }}
                            </p>

                            <div
                                class="mt-auto pt-4 border-t border-gray-100 grid grid-cols-2 gap-4 text-xs text-gray-500">
                                <div class="flex flex-col">
                                    <span class="text-gray-400 mb-0.5">Editorial</span>
                                    <span class="font-semibold text-gray-700">{{ $item->editorial }}</span>
                                </div>
                                <div class="flex flex-col text-right">
                                    <span class="text-gray-400 mb-0.5">Extensión</span>
                                    <span class="font-semibold text-gray-700">{{ $item->paginas }} págs.</span>
                                </div>
                            </div>
                        </div>
                    </article>
                @endforeach

            </div>
        </div>
    </x-mios.base>
</x-app-layout>
