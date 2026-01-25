<x-mios.base>
    <div class="p-6">

        <h2 class="text-2xl font-bold text-gray-800 mb-5 border-b pb-4">
            <i class="fas fa-users mr-2 text-indigo-600"></i>Gestión de Autores
        </h2>

        <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
            <div class="relative w-full md:w-64">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-search text-gray-400"></i>
                </div>
                <input type="search" placeholder="Buscar..." wire:model.live="buscar"
                    class="pl-10 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
            </div>
            @livewire('authors.create-author')
        </div>

        <div class="border border-gray-200 rounded-lg overflow-hidden">
            <table class="w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer hover:bg-gray-100 w-16 whitespace-nowrap"
                            wire:click="ordenar('id')">
                            <i class="fas fa-sort mr-1"></i>ID
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer hover:bg-gray-100 w-48 whitespace-nowrap"
                            wire:click="ordenar('nombre')">
                            <i class="fas fa-sort mr-1"></i>Autor
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer hover:bg-gray-100 w-32 whitespace-nowrap"
                            wire:click="ordenar('nacionalidad')">
                            <i class="fas fa-sort mr-1"></i>Nacionalidad
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer hover:bg-gray-100 w-32 whitespace-nowrap"
                            wire:click="ordenar('fecha_nacimiento')">
                            <i class="fas fa-sort mr-1"></i>Fecha Nac.
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Biografía
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider w-24">
                            Acciones
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($autores as $item)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 align-top">
                                {{ $item->id }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap align-top">
                                <div class="text-sm font-bold text-gray-900">
                                    {{ $item->nombre }} {{ $item->apellidos }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap align-top">
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                    {{ $item->nacionalidad }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 align-top">
                                {{ $item->fecha_nacimiento }}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500 align-top whitespace-normal break-words">
                                {{ $item->biografia }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium align-top">
                                <div class="flex justify-end gap-3">
                                    <button class="text-indigo-600 hover:text-indigo-900"
                                        wire:click="mostrarEditar({{ $item->id }})">
                                        <i class="fas fa-edit fa-lg"></i>
                                    </button>
                                    <button class="text-red-600 hover:text-red-900"
                                        wire:click="mostrarConfirmacion({{ $item->id }})">
                                        <i class="fas fa-trash-alt fa-lg"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4 flex flex-col md:flex-row justify-between items-center text-sm text-gray-500 gap-4">
            {{ $autores->links() }}
        </div>
    </div>
    @isset($uform)
        <x-dialog-modal wire:model="openEditar">

            <x-slot name="title">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-bold text-gray-900">
                        <i class="fas fa-user-plus text-indigo-600 mr-2"></i> Nuevo Autor
                    </h3>
                </div>
            </x-slot>

            <x-slot name="content">
                <form class="space-y-4 mt-2">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nombre</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-user text-gray-400 text-xs"></i>
                                </div>
                                <input type="text" wire:model="uform.nombre"
                                    class="block w-full pl-10 rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                    placeholder="Ej: Gabriel">
                            </div>
                            <x-input-error for="uform.nombre" />
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Apellidos</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-user-tag text-gray-400 text-xs"></i>
                                </div>
                                <input type="text" wire:model="uform.apellidos"
                                    class="block w-full pl-10 rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                    placeholder="Ej: García Márquez">
                            </div>
                            <x-input-error for="uform.apellidos" />
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nacionalidad</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-globe text-gray-400 text-xs"></i>
                                </div>
                                <input type="text" wire:model="uform.nacionalidad"
                                    class="block w-full pl-10 rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                    placeholder="Ej: Colombiana">
                            </div>
                            <x-input-error for="uform.nacionalidad" />
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Fecha de Nacimiento</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-calendar-alt text-gray-400 text-xs"></i>
                                </div>
                                <input type="date" wire:model="uform.fecha_nacimiento"
                                    class="block w-full pl-10 rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            </div>
                            <x-input-error for="uform.fecha_nacimiento" />
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Biografía</label>
                        <div class="relative">
                            <div class="absolute top-3 left-3 flex items-start pointer-events-none">
                                <i class="fas fa-align-left text-gray-400 text-xs"></i>
                            </div>
                            <textarea wire:model="uform.biografia" rows="4"
                                class="block w-full pl-10 rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                placeholder="Escribe una breve biografía del autor..."></textarea>
                        </div>
                        <x-input-error for="uform.biografia" />
                    </div>

                </form>
            </x-slot>

            <x-slot name="footer">
                <div class="flex flex-row-reverse gap-3">
                    <button type="button" wire:click="update" wire:loading.attr="disabled"
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
    @endisset
</x-mios.base>
