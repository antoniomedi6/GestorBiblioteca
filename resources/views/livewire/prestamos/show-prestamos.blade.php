<x-mios.base>
    <div class="p-6">

        <h2 class="text-2xl font-bold text-gray-800 mb-5 border-b pb-4">
            <i class="fas fa-book-reader mr-2 text-indigo-600"></i>Gestión de Préstamos
        </h2>

        <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
            <div class="relative w-full md:w-64">
                <x-input type="search" placeholder="Buscar..." wire:model.live="buscar" />
            </div>
            @livewire('prestamos.create-prestamo')
        </div>

        <div class="border border-gray-200 rounded-lg overflow-hidden">
            <div class="overflow-x-auto">
                @if ($prestamos->count())
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" wire:click="ordenar('id')"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer hover:bg-gray-100 w-16">
                                    ID <i class="fas fa-sort ml-1 text-gray-300"></i>
                                </th>
                                <th scope="col" wire:click="ordenar('ltitulo')"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer hover:bg-gray-100">
                                    Libro <i class="fas fa-sort ml-1 text-gray-300"></i>
                                </th>
                                <th scope="col" wire:click="ordenar('uname')"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer hover:bg-gray-100">
                                    Usuario <i class="fas fa-sort ml-1 text-gray-300"></i>
                                </th>
                                <th scope="col" wire:click="ordenar('fecha_prestamo')"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer hover:bg-gray-100">
                                    F. Préstamo
                                </th>
                                <th scope="col" wire:click="ordenar('fecha_devolucion')"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer hover:bg-gray-100">
                                    F. Devolución
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Estado (Click para cambiar)
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider w-32">
                                    Acciones
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($prestamos as $item)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 align-top">
                                        {{ $item->id }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap align-top">
                                        <div class="text-sm font-bold text-gray-900">{{ $item->ltitulo }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap align-top">
                                        <div class="text-sm text-gray-900">{{ $item->uname }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 align-top">
                                        {{ $item->fecha_prestamo }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 align-top">
                                        {{ $item->fecha_devolucion }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center align-top">
                                        <button wire:click="cambiarEstado({{ $item->id }})"
                                            @class([
                                                'px-3 py-1 inline-flex text-xs leading-5 font-bold rounded-full cursor-pointer transition-colors border shadow-sm',
                                                'bg-green-100 text-green-800 hover:bg-green-200' =>
                                                    $item->fecha_devolucion == null,
                                                'bg-red-100 text-red-800 hover:bg-red-200' =>
                                                    $item->fecha_devolucion != null,
                                            ]) title="Click para marcar como devuelto/activo">
                                            {{ $item->fecha_devolucion ? 'Devuelto' : 'Activo' }}
                                        </button>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium align-top">
                                        <div class="flex justify-end gap-3">
                                            <button wire:click="mostrarEditar({{ $item->id }})"
                                                class="text-indigo-600 hover:text-indigo-900 transition-colors">
                                                <i class="fas fa-edit fa-lg"></i>
                                            </button>
                                            <button wire:click="mostrarConfirmacion({{ $item->id }})"
                                                class="text-red-600 hover:text-red-900 transition-colors">
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
                        No se han encontrado prestamos o no se ha creado ninguno todavia.
                    </x-mios.alerta>
                @endif

            </div>
        </div>

        <div class="mt-4">
            {{ $prestamos->links() }}
        </div>

        @isset($uform)
            <x-dialog-modal wire:model="openEditar">
                <x-slot name="title">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-bold text-gray-900">
                            <i class="fas fa-edit text-indigo-600 mr-2"></i> Editar Préstamo
                        </h3>
                        <button wire:click="cancelar" class="text-gray-400 hover:text-gray-600 transition-colors">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </x-slot>

                <x-slot name="content">
                    <form class="space-y-4 mt-2">
                        <div class="grid grid-cols-1 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Libro</label>
                                <select wire:model="uform.libro_id"
                                    class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    @foreach ($libros as $libro)
                                        <option value="{{ $libro->id }}">{{ $libro->titulo }}</option>
                                    @endforeach
                                </select>
                                <x-input-error for="uform.libro_id" />
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Usuario</label>
                                <select wire:model="uform.user_id"
                                    class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                                <x-input-error for="uform.user_id" />
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Fecha Préstamo</label>
                            <input type="date" wire:model="uform.fecha_prestamo"
                                class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            <x-input-error for="uform.fecha_prestamo" />
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Fecha Devolución</label>
                            <input type="date" wire:model="uform.fecha_devolucion"
                                class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            <x-input-error for="uform.fecha_devolucion" />
                        </div>
                    </form>
                </x-slot>

                <x-slot name="footer">
                    <div class="flex flex-row-reverse gap-3">
                        <button wire:click="update" wire:loading.attr="disabled"
                            class="inline-flex justify-center rounded-lg border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 transition-colors">
                            <i class="fas fa-save mr-2 mt-0.5"></i> ACTUALIZAR
                        </button>
                        <button wire:click="cancelar"
                            class="inline-flex justify-center rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 transition-colors">
                            CANCELAR
                        </button>
                    </div>
                </x-slot>
            </x-dialog-modal>
        @endisset
    </div>
</x-mios.base>
