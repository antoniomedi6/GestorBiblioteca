<div>
    <button wire:click="$set('mostrarCrear', true)"
        class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded shadow transition duration-200 flex items-center">
        <i class="fas fa-plus mr-2"></i> Nuevo Libro
    </button>

    <x-dialog-modal wire:model="mostrarCrear">

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
                        <input type="text" wire:model="cform.titulo"
                            class="block w-full pl-10 rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                            placeholder="Ej: Don Quijote de la Mancha">
                    </div>
                    <x-input-error for="cform.titulo" />
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Autor</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-user-pen text-gray-400 text-xs"></i>
                            </div>
                            <select wire:model="cform.author_id"
                                class="block w-full pl-10 rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm bg-white">
                                <option value="">Seleccionar Autor...</option>
                                @foreach ($autores as $item)
                                    <option value="{{ $item->id }}">{{ $item->nombre }} {{ $item->apellidos }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <x-input-error for="cform.author_id" />
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Categoría</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-tags text-gray-400 text-xs"></i>
                            </div>
                            <select wire:model="cform.categoria_id"
                                class="block w-full pl-10 rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm bg-white">
                                <option value="">Seleccionar Categoría...</option>
                                @foreach ($categorias as $item)
                                    <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <x-input-error for="cform.categoria_id" />
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Año</label>
                        <input type="number" min="1" wire:model="cform.anio_publicacion"
                            class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                            placeholder="2026">
                        <x-input-error for="cform.anio_publicacion" />
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Editorial</label>
                        <input type="text" wire:model="cform.editorial"
                            class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                            placeholder="Ej: Planeta">
                        <x-input-error for="cform.editorial" />
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Páginas</label>
                        <input type="number" min="1" wire:model="cform.paginas"
                            class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                            placeholder="0">
                        <x-input-error for="cform.paginas" />
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Portada</label>

                    <label for="cportada"
                        class="block w-full h-80 rounded bg-gray-200 relative border border-gray-300 overflow-hidden cursor-pointer group hover:bg-gray-300 transition-colors">

                        <input type="file" class="hidden" id="cportada" accept="image/*"
                            wire:model="cform.portada" />

                        @if ($cform->portada)
                            <img src="{{ $cform->portada->temporaryUrl() }}"
                                class="w-full h-full object-contain object-center bg-no-repeat" />
                        @else
                            <div
                                class="absolute inset-0 flex items-center justify-center text-gray-400 group-hover:text-gray-500">
                                <i class="fas fa-image text-6xl opacity-50"></i>
                            </div>
                        @endif

                        <div
                            class="absolute bottom-2 right-2 text-white rounded-lg p-2 bg-gray-600 group-hover:bg-gray-800 transition-colors shadow-lg z-10">

                            <span wire:loading.remove wire:target="cform.portada">
                                <i class="fas fa-upload mr-1"></i> SUBIR IMAGEN
                            </span>

                            <span wire:loading wire:target="cform.portada">
                                <i class="fas fa-spinner fa-spin mr-1"></i> Cargando...
                            </span>
                        </div>

                        <div wire:loading.flex wire:target="cform.portada"
                            class="absolute inset-0 bg-black/20 flex items-center justify-center z-20">
                        </div>

                    </label>

                    <x-input-error for="cform.portada" />
                </div>

            </form>
        </x-slot>

        <x-slot name="footer">
            <div class="flex flex-row-reverse gap-3">
                <button type="button" wire:click="guardar" wire:loading.attr="disabled"
                    class="inline-flex justify-center rounded-lg border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-50 transition-colors">
                    <i class="fas fa-save mr-2 mt-0.5"></i> GUARDAR
                </button>
                <button wire:click="cancelar" type="button" wire:loading.attr="disabled"
                    class="inline-flex justify-center rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-colors">
                    CANCELAR
                </button>
            </div>
        </x-slot>
    </x-dialog-modal>
</div>
