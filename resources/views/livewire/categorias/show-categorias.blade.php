<x-mios.base>
    <div class="p-6">

        <h2 class="text-2xl font-bold text-gray-800 mb-5 border-b pb-4">
            <i class="fas fa-tags mr-2 text-indigo-600"></i>Gestión de Categorías
        </h2>

        <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
            <div class="relative w-full md:w-64">
                <x-input type="search" placeholder="Buscar categoría..." wire:model.live="buscar" />
            </div>
            @livewire('categorias.create-categoria')
        </div>

        <div class="border border-gray-200 rounded-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase whitespace-nowrap tracking-wider cursor-pointer hover:bg-gray-100 w-16"
                                wire:click="ordenar('id')">
                                ID <i class="fas fa-sort ml-1 text-gray-300"></i>
                            </th>

                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium whitespace-nowrap text-gray-500 uppercase tracking-wider cursor-pointer hover:bg-gray-100 w-48"
                                wire:click="ordenar('nombre')">
                                Nombre <i class="fas fa-sort ml-1 text-gray-300"></i>
                            </th>

                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Descripción
                            </th>

                            <th scope="col"
                                class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider w-32">
                                Acciones
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($categorias as $item)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 align-top">
                                    {{ $item->id }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap align-top">
                                    <div class="text-sm font-bold text-gray-900">
                                        {{ $item->nombre }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500 align-top whitespace-normal break-words">
                                    {{ $item->descripcion }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium align-top">
                                    <div class="flex justify-end gap-3">
                                        <button class="text-indigo-600 hover:text-indigo-900 transition-colors"
                                            title="Editar" wire:click="mostrarEditar({{ $item->id }})">
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
            </div>
        </div>
        <div class="mt-2">
            {{ $categorias->links() }}
        </div>
    </div>
    <div>
        @isset($uform)
            <x-dialog-modal wire:model="openEditar">

                <x-slot name="title">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-bold text-gray-900">
                            <i class="fas fa-edit text-indigo-600 mr-2"></i> Editar Categoría
                        </h3>
                        <button wire:click="cancelar" class="text-gray-400 hover:text-gray-600 transition-colors">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </x-slot>

                <x-slot name="content">
                    <form class="space-y-4 mt-2">

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nombre de la Categoría</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-tag text-gray-400 text-xs"></i>
                                </div>
                                <input type="text" wire:model="uform.nombre"
                                    class="block w-full pl-10 rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                    placeholder="Ej: Novela Histórica">
                            </div>
                            <x-input-error for="uform.nombre" />
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Descripción</label>
                            <div class="relative">
                                <div class="absolute top-3 left-3 flex items-start pointer-events-none">
                                    <i class="fas fa-align-left text-gray-400 text-xs"></i>
                                </div>
                                <textarea wire:model="uform.descripcion" rows="4"
                                    class="block w-full pl-10 rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                    placeholder="Describe brevemente de qué trata esta categoría..."></textarea>
                            </div>
                            <x-input-error for="uform.descripcion" />
                        </div>

                    </form>
                </x-slot>

                <x-slot name="footer">
                    <div class="flex flex-row-reverse gap-3">
                        <button type="button" wire:click="update" wire:loading.attr="disabled"
                            class="inline-flex justify-center rounded-lg border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-50 transition-colors">
                            <i class="fas fa-save mr-2 mt-0.5"></i> ACTUALIZAR
                        </button>

                        <button wire:click="cancelar" type="button" wire:loading.attr="disabled"
                            class="inline-flex justify-center rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-colors">
                            CANCELAR
                        </button>
                    </div>
                </x-slot>
            </x-dialog-modal>
        @endisset
    </div>
</x-mios.base>
