<div>
    <button wire:click="$set('mostrarCrear', true)"
        class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded shadow transition duration-200 flex items-center">
        <i class="fas fa-plus mr-2"></i> Nuevo Autor
    </button>

    <x-dialog-modal wire:model="mostrarCrear">

        <x-slot name="title">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-bold text-gray-900">
                    <i class="fas fa-user-plus text-indigo-600 mr-2"></i> Nuevo Autor
                </h3>
                <button wire:click="$set('mostrarCrear', false)"
                    class="text-gray-400 hover:text-gray-600 transition-colors">
                    <i class="fas fa-times"></i>
                </button>
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
                            <input type="text" wire:model="cform.nombre"
                                class="block w-full pl-10 rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                placeholder="Ej: Gabriel">
                        </div>
                        <x-input-error for="cform.nombre" />
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Apellidos</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-user-tag text-gray-400 text-xs"></i>
                            </div>
                            <input type="text" wire:model="cform.apellidos"
                                class="block w-full pl-10 rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                placeholder="Ej: García Márquez">
                        </div>
                        <x-input-error for="cform.apellidos" />
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nacionalidad</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-globe text-gray-400 text-xs"></i>
                            </div>
                            <input type="text" wire:model="cform.nacionalidad"
                                class="block w-full pl-10 rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                placeholder="Ej: Colombiana">
                        </div>
                        <x-input-error for="cform.nacionalidad" />
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Fecha de Nacimiento</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-calendar-alt text-gray-400 text-xs"></i>
                            </div>
                            <input type="date" wire:model="cform.fecha_nacimiento"
                                class="block w-full pl-10 rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        </div>
                        <x-input-error for="cform.fecha_nacimiento" />
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Biografía</label>
                    <div class="relative">
                        <div class="absolute top-3 left-3 flex items-start pointer-events-none">
                            <i class="fas fa-align-left text-gray-400 text-xs"></i>
                        </div>
                        <textarea wire:model="cform.biografia" rows="4"
                            class="block w-full pl-10 rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                            placeholder="Escribe una breve biografía del autor..."></textarea>
                    </div>
                    <x-input-error for="cform.biografia" />
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
