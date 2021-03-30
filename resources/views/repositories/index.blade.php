<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Repositorios
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <p class="text-right mb-4 ">
                <a href="{{ route('repositories.create') }}" class="bg-blue-500 text-white font-bold py-2 px-4 rounded-md text-xs">
                    Crear
                </a>
            </p>
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
                <table class="w-full">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Enlace</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($repositories as $repository)
                        <tr>
                            <td class="border px-4 py-2">{{ $repository->id }}</td>
                            <td class="border px-4 py-2">{{ $repository->url }}</td>
                            <td class="pl-4 py-2 w-1">
                                <a 
                                    class="bg-blue-500 text-white font-bold py-2 px-4 rounded-md text-xs"
                                    href="{{ route('repositories.show', $repository) }}"
                                >
                                    Ver
                                </a>
                            </td>
                            <td class="px-1 py-2 w-1">
                                <a 
                                    class="bg-blue-500 text-white font-bold py-2 px-4 rounded-md text-xs"
                                    href="{{ route('repositories.edit', $repository) }}"
                                >
                                    Editar
                                </a>
                            </td>/a>
                        </td>
                        <td class="px-0 py-2 w-1">
                            <form 
                                action="{{ route('repositories.destroy', $repository) }}"
                                method="POST"
                            >
                                @csrf
                                @method('DELETE')
                                <button 
                                    class="bg-red-500 text-white font-bold py-2 px-4 rounded-md text-xs"
                                    type="submit"
                                >
                                    Eliminar
                                </button>
                            </form>
                        </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5">
                                <div class="bg-blue-200 p-2rounded ">
                                    No hay repositorios creados
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>