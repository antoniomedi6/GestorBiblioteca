<div>
    <button wire:click="$set('mostrarCrear', true)"
        class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded shadow transition duration-200 flex items-center">
        <i class="fas fa-plus mr-2"></i> Nuevo Préstamo
    </button>

    <x-dialog-modal wire:model="mostrarCrear">

        <x-slot name="title">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-bold text-gray-900">
                    <i class="fas fa-hand-holding-book text-indigo-600 mr-2"></i> Registrar Préstamo
                </h3>
                <button wire:click="$set('mostrarCrear', false)"
                    class="text-gray-400 hover:text-gray-600 transition-colors">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </x-slot>

        <x-slot name="content">
            <form class="space-y-4 mt-2">

                <div class="grid grid-cols-1 gap-4">

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Libro a Prestar</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-book text-gray-400 text-xs"></i>
                            </div>
                            <select wire:model="cform.libro_id"
                                class="block w-full pl-10 rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm bg-white">
                                <option value="">Seleccione un libro...</option>
                                @foreach ($libros as $libro)
                                    <option value="{{ $libro->id }}">{{ $libro->titulo }} ({{ $libro->editorial }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <x-input-error for="cform.libro_id" />
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Usuario Solicitante</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-user text-gray-400 text-xs"></i>
                            </div>
                            <select wire:model="cform.user_id"
                                class="block w-full pl-10 rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm bg-white">
                                <option value="">Seleccione un usuario...</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <x-input-error for="cform.user_id" />
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Fecha de Préstamo</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-calendar-alt text-gray-400 text-xs"></i>
                        </div>
                        <input type="date" wire:model="cform.fecha_prestamo"
                            class="block w-full pl-10 rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    </div>
                    <p class="text-xs text-gray-500 mt-1 ml-1">La fecha de devolución se registrará cuando el usuario
                        retorne el libro.</p>
                    <x-input-error for="cform.fecha_prestamo" />
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
