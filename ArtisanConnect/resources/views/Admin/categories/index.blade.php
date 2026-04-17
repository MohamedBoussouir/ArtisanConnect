<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion Catégories - ArtisanConnect</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-100 font-sans flex">

    <aside class="w-64 bg-gray-900 min-h-screen text-gray-300 fixed md:relative z-50">
        <div class="p-6 text-white font-black text-xl border-b border-gray-800">
            <i class="fa-solid fa-shield-halved text-orange-500 mr-2"></i> ADMIN<span class="text-blue-500">CP</span>
        </div>
        <nav class="p-4 space-y-2">
            <a href="/admin/dashboard" class="flex items-center p-3 rounded-lg hover:bg-gray-800 transition"><i class="fa-solid fa-chart-pie mr-3"></i> Dashboard</a>
            <a href="users" class="flex items-center p-3 rounded-lg hover:bg-gray-800 transition"><i class="fa-solid fa-users mr-3"></i> Utilisateurs</a>
            <a href="/admin/categories" class="flex items-center p-3 rounded-lg bg-gray-800 text-white"><i class="fa-solid fa-list-check mr-3"></i> Catégories</a>
            <a href="#" class="flex items-center p-3 rounded-lg hover:bg-gray-800 transition"><i class="fa-solid fa-flag mr-3"></i> Signalements</a>
            <div class="pt-10 border-t border-gray-800 mt-10">
                <a href="/" class="flex items-center p-3 rounded-lg hover:bg-blue-900 transition text-blue-400">
                    <i class="fa-solid fa-house mr-3"></i> Retour au Site
                </a>
                <form action="/logout" method="POST">
                    @csrf
                    <button type="submit" class="w-full flex items-center p-3 rounded-lg hover:bg-red-900 transition text-red-400 mt-2">
                        <i class="fa-solid fa-power-off mr-3"></i> Déconnexion
                    </button>
                </form>
        </nav>
    </aside>

    <div class="flex-1">
        <header class="bg-white shadow-sm p-4 flex justify-between items-center px-8">
            <h2 class="font-bold text-gray-800 text-lg uppercase tracking-wider">Gestion des Catégories</h2>
            <p class="font-bold text-gray-700">Admin_System</p>
        </header>

        <div class="p-8">
            @if(session('success'))
                <div class="mb-6 p-4 bg-green-100 border-l-4 border-green-500 text-green-700 font-bold rounded shadow-sm">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100 mb-8">
                <h3 class="text-lg font-bold text-slate-800 mb-4">Ajouter une nouvelle catégorie</h3>
                <form action="{{ route('admin.categories.store') }}" method="POST" class="flex flex-col md:flex-row gap-4">
                    @csrf
                    <div class="flex-1">
                        <input type="text" name="name" required placeholder="Nom (ex: Plomberie)" 
                               class="w-full p-3 bg-gray-50 rounded-xl border border-gray-100 focus:ring-2 focus:ring-blue-500 outline-none">
                    </div>
                    <div class="md:w-1/4">
                        <input type="text" name="icon" required placeholder="Icon (ex: fa-plug)" 
                               class="w-full p-3 bg-gray-50 rounded-xl border border-gray-100 focus:ring-2 focus:ring-blue-500 outline-none">
                    </div>
                    <button type="submit" class="bg-blue-600 text-white px-8 py-3 rounded-xl font-bold hover:bg-blue-700 transition shadow-lg shadow-blue-200">
                        Ajouter
                    </button>
                </form>
            </div>

            <div class="bg-white rounded-2xl shadow-sm overflow-hidden border border-gray-100">
                <div class="p-6 border-b border-gray-100">
                    <h3 class="font-bold text-gray-800">Liste des Catégories</h3>
                </div>
                <table class="w-full text-left">
                    <thead class="bg-gray-50 text-gray-500 text-xs uppercase">
                        <tr>
                            <th class="p-4">Icône</th>
                            <th class="p-4">Nom de la Catégorie</th>
                            <th class="p-4">Nombre d'Artisans</th>
                            <th class="p-4 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($categories as $category)
                        <tr>
                            <td class="p-4 text-blue-500 text-xl">
                                <i class="fa-solid {{ $category->icon }}"></i>
                            </td>
                            <td class="p-4">
                                <p class="font-bold text-gray-800">{{ $category->name }}</p>
                            </td>
                            <td class="p-4">
                                <span class="px-3 py-1 bg-gray-100 text-gray-600 rounded-full text-xs font-bold">
                                    {{ $category->artisan_profiles_count ?? 0 }} Artisans
                                </span>
                            </td>
                            <td class="p-4 text-center">
                                <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Supprimer cette catégorie ?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-400 hover:text-red-600 transition">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>
</html>