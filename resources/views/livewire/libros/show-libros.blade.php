<x-mios.base>
    <div class="container mx-auto px-4 py-8">
        <h2 class="text-2xl font-bold text-gray-800 mb-5">
            <i class="fas fa-table mr-2 text-indigo-600"></i>Listado de Libros
        </h2>
        <div class="flex justify-between items-center mb-6">
            <x-input type="search" placeholder="Buscar..." wire:model.live="buscar" />
            @livewire('libros.create-libros')
        </div>

        <div class="bg-white shadow-md rounded-lg overflow-hidden border border-gray-200">
            <div class="overflow-x-auto">
                @if ($libros->count())
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Portada
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 hover:bg-gray-100 uppercase tracking-wider cursor-pointer"
                                    wire:click="ordenar('titulo')">
                                    <i class="fas fa-sort mr-1"></i>Título
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 hover:bg-gray-100 uppercase tracking-wider cursor-pointer"
                                    wire:click="ordenar('authors.nombre')">
                                    <i class="fas fa-sort mr-1"></i>Autor
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 hover:bg-gray-100 uppercase tracking-wider cursor-pointer"
                                    wire:click="ordenar('categorias.nombre')">
                                    <i class="fas fa-sort mr-1"></i>Categoría
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Detalles
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Acciones
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($libros as $item)
                                <tr class="hover:bg-gray-50 transition-colors duration-150">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="h-16 w-12 flex-shrink-0">
                                            <img class="h-16 w-12 rounded object-cover shadow-sm border border-gray-200"
                                                src="{{ Storage::url($item->portada) }}"
                                                alt="Portada {{ $item->titulo }}">
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-bold text-gray-900">{{ $item->titulo }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-700">
                                            <i class="fas fa-user-pen text-gray-400 mr-1"></i>
                                            {{ $item->author->nombre }}
                                            {{ $item->author->apellidos }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-indigo-100 text-indigo-800">
                                            {{ $item->categoria->nombre }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <div class="flex flex-col gap-1">
                                            <span><i class="fas fa-calendar-alt w-4 text-center mr-1"></i>
                                                {{ $item->anio_publicacion }}</span>
                                            <span><i class="fas fa-building w-4 text-center mr-1"></i>
                                                {{ $item->editorial }}</span>
                                            <span><i class="fas fa-file-alt w-4 text-center mr-1"></i>
                                                {{ $item->paginas }}
                                                págs.</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <div class="flex justify-end gap-3">
                                            <button class="text-indigo-600 hover:text-indigo-900 transition-colors"
                                                wire:click="mostrarEditar({{ $item->id }})" title="Editar"
                                                wire:click="mostrarEditar({{ $item->id }})">
                                                <i class="fas fa-edit fa-lg"></i>
                                            </button>
                                            <button class="text-red-600 hover:text-red-900 transition-colors"
                                                title="Eliminar" wire:click="mostrarConfirmacion({{ $item->id }})">
                                                <i class="fas fa-trash-alt fa-lg"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <x-mios.alerta>
                        No se ha encontrado ningún libro o no se ha creado ninguno.
                    </x-mios.alerta>
                @endif
            </div>
        </div>
        {{ $libros->links() }}
    </div>
    @if ($uform->libro)
        <x-dialog-modal wire:model="openEditar">

            <x-slot name="title">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-bold text-gray-900">
                        <i class="fas fa-book-medical text-indigo-600 mr-2"></i> Nuevo Libro
                    </h3>
                    <button wire:click="$set('mostrarCrear', false)"
                        class="text-gray-400 hover:text-gray-600 transition-colors">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </x-slot>

            <x-slot name="content">
                <form class="space-y-4 mt-2">

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Título del Libro</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-heading text-gray-400 text-xs"></i>
                            </div>
                            <input type="text" wire:model="uform.titulo"
                                class="block w-full pl-10 rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                placeholder="Ej: Don Quijote de la Mancha">
                        </div>
                        <x-input-error for="uform.titulo" />
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Autor</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-user-pen text-gray-400 text-xs"></i>
                                </div>
                                <select wire:model="uform.author_id"
                                    class="block w-full pl-10 rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm bg-white">
                                    <option value="">Seleccionar Autor...</option>
                                    @foreach ($autores as $item)
                                        <option value="{{ $item->id }}">{{ $item->nombre }}
                                            {{ $item->apellidos }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <x-input-error for="uform.author_id" />
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Categoría</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-tags text-gray-400 text-xs"></i>
                                </div>
                                <select wire:model="uform.categoria_id"
                                    class="block w-full pl-10 rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm bg-white">
                                    <option value="">Seleccionar Categoría...</option>
                                    @foreach ($categorias as $item)
                                        <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <x-input-error for="uform.categoria_id" />
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Año</label>
                            <input type="number" min="1" wire:model="uform.anio_publicacion"
                                class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                placeholder="2026">
                            <x-input-error for="uform.anio_publicacion" />
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Editorial</label>
                            <input type="text" wire:model="uform.editorial"
                                class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                placeholder="Ej: Planeta">
                            <x-input-error for="uform.editorial" />
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Páginas</label>
                            <input type="number" min="1" wire:model="uform.paginas"
                                class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                placeholder="0">
                            <x-input-error for="uform.paginas" />
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Portada</label>

                        <label for="uportada"
                            class="block w-full h-80 rounded bg-gray-200 relative border border-gray-300 overflow-hidden cursor-pointer group hover:bg-gray-300 transition-colors">

                            <input type="file" class="hidden" id="uportada" accept="image/*"
                                wire:model="uform.portada" />

                            @isset($uform->portada)
                                <img src="{{ $uform->portada->temporaryUrl() }}"
                                    class="w-full h-full object-contain object-center bg-no-repeat" />
                            @else
                                <img src="{{ Storage::url($uform->libro->portada) }}"
                                    class="w-full h-full object-contain object-center bg-no-repeat" />
                            @endisset

                            <div
                                class="absolute bottom-2 right-2 text-white rounded-lg p-2 bg-gray-600 group-hover:bg-gray-800 transition-colors shadow-lg z-10">

                                <span wire:loading.remove wire:target="uform.portada">
                                    <i class="fas fa-upload mr-1"></i> SUBIR IMAGEN
                                </span>

                                <span wire:loading wire:target="uform.portada">
                                    <i class="fas fa-spinner fa-spin mr-1"></i> Cargando...
                                </span>
                            </div>

                            <div wire:loading.flex wire:target="uform.portada"
                                class="absolute inset-0 bg-black/20 flex items-center justify-center z-20">
                            </div>

                        </label>

                        <x-input-error for="uform.portada" />
                    </div>

                </form>
            </x-slot>

            <x-slot name="footer">
                <div class="flex flex-row-reverse gap-3">
                    <button type="button" wire:click="update" wire:loading.attr="disabled"
                        class="inline-flex justify-center rounded-lg border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-50 transition-colors">
                        <i class="fas fa-save mr-2 mt-0.5"></i> EDITAR
                    </button>
                    <button wire:click="cancelar" type="button" wire:loading.attr="disabled"
                        class="inline-flex justify-center rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-colors">
                        CANCELAR
                    </button>
                </div>
            </x-slot>
        </x-dialog-modal>
    @endif

</x-mios.base>
