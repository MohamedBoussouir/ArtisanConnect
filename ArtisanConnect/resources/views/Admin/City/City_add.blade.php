<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Villes - Admin Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body class="bg-gray-100 font-sans flex">

    <aside class="w-64 bg-gray-900 min-h-screen text-gray-300 fixed md:relative z-50">
        <div class="p-6 text-white font-black text-xl border-b border-gray-800">
            <i class="fa-solid fa-shield-halved text-orange-500 mr-2"></i> ADMIN<span class="text-blue-500">CP</span>
        </div>
        <nav class="p-4 space-y-2">
            <a href="/admin/dashboard" class="flex items-center p-3 rounded-lg hover:bg-gray-800 transition">
                <i class="fa-solid fa-chart-pie mr-3"></i> Dashboard
            </a>
            <a href="/admin/users" class="flex items-center p-3 rounded-lg hover:bg-gray-800 transition">
                <i class="fa-solid fa-users mr-3"></i> Utilisateurs
            </a>
            <a href="/admin/categories" class="flex items-center p-3 rounded-lg hover:bg-gray-800 transition">
                <i class="fa-solid fa-list-check mr-3"></i> Catégories
            </a>
            <a href="/admin/cities" class="flex items-center p-3 rounded-lg bg-gray-800 text-white shadow-lg">
                <i class="fa-solid fa-flag mr-3"></i> Villes
            </a>
            
            <div class="pt-10 border-t border-gray-800 mt-10">
                <a href="/" class="flex items-center p-3 rounded-lg hover:bg-blue-900 transition text-blue-400">
                    <i class="fa-solid fa-house mr-3"></i> Retour au Site
                </a>
                <a href="/logout" class="flex items-center p-3 rounded-lg hover:bg-red-900 transition text-red-400 mt-2">
                    <i class="fa-solid fa-power-off mr-3"></i> Déconnexion
                </a>
            </div>
        </nav>
    </aside>

    <div class="flex-1">
        <header class="bg-white shadow-sm p-4 flex justify-between items-center px-8">
            <h2 class="font-bold text-gray-800 text-lg uppercase tracking-wider italic">Gestion des Villes</h2>
            <div class="flex items-center gap-4">
                <p class="font-bold text-gray-700">Admin_System</p>
                <div class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center text-white font-bold">A</div>
            </div>
        </header>

        <div class="p-8 space-y-8">
            
            <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100">
                <h3 class="text-lg font-black text-gray-800 mb-6 flex items-center uppercase tracking-tighter">
                    <i class="fa-solid fa-plus-circle text-blue-500 mr-2"></i> Ajouter une nouvelle ville
                </h3>
                <form action="{{ route('City.store') }}" method="POST" class="flex flex-col md:flex-row gap-4">
                    @csrf
                    <div class="flex-1">
                        <input type="text" name="name" required placeholder="Ex: Casablanca, Safi, El Jadida..." 
                               class="w-full p-4 bg-gray-50 rounded-xl border border-gray-200 focus:ring-2 focus:ring-blue-500 outline-none font-bold text-gray-700 transition">
                    </div>
                    <button type="submit" class="bg-blue-600 text-white px-8 py-4 rounded-xl font-black uppercase text-xs tracking-widest hover:bg-blue-700 transition shadow-lg shadow-blue-200 hover:-translate-y-1">
                        Ajouter la ville
                    </button>
                </form>
            </div>

            <div class="bg-white rounded-2xl shadow-sm overflow-hidden border border-gray-100">
                <div class="p-6 border-b border-gray-100">
                    <h3 class="font-bold text-gray-800 uppercase tracking-widest text-sm">Villes Actuelles ({{ $cities->count() }})</h3>
                </div>
                <table class="w-full text-left">
                    <thead class="bg-gray-50 text-gray-500 text-xs uppercase">
                        <tr>
                            <th class="p-4">ID</th>
                            <th class="p-4">Nom de la Ville</th>
                            <th class="p-4">Date d'ajout</th>
                            <th class="p-4 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 font-medium text-gray-700">
                        @forelse ($cities as $city)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="p-4 text-gray-400 font-bold">#{{ $city->id }}</td>
                            <td class="p-4">
                                <span class="bg-blue-50 text-blue-700 px-3 py-1 rounded-lg font-black uppercase text-[10px]">
                                    {{ $city->name }}
                                </span>
                            </td>
                            <td class="p-4 text-sm">{{ $city->created_at->format('d/m/Y') }}</td>
                            <td class="p-4 text-center">
                                <div class="flex justify-center gap-2">
                                    {{-- زر الحذف --}}
                                    <form action="{{ route('cities.destroy', $city) }}" method="POST" onsubmit="return confirm('Supprimer cette ville ?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="w-9 h-9 bg-red-50 text-red-500 rounded-lg hover:bg-red-500 hover:text-white transition flex items-center justify-center">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="p-10 text-center text-gray-400 italic">
                                <i class="fa-solid fa-city text-4xl mb-3 block opacity-20"></i>
                                Aucune ville n'a été ajoutée pour le moment.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>
</html>