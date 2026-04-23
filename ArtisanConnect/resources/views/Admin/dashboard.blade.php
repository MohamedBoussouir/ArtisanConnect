<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - ArtisanConnect</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body class="bg-gray-100 font-sans flex">

    <aside class="w-64 bg-gray-900 min-h-screen text-gray-300 fixed md:relative z-50">
        <div class="p-6 text-white font-black text-xl border-b border-gray-800">
            <i class="fa-solid fa-shield-halved text-orange-500 mr-2"></i> ADMIN<span class="text-blue-500">CP</span>
        </div>
        <nav class="p-4 space-y-2">
            <a href="#" class="flex items-center p-3 rounded-lg bg-gray-800 text-white"><i
                    class="fa-solid fa-chart-pie mr-3"></i> Dashboard</a>
            <a href="users" class="flex items-center p-3 rounded-lg hover:bg-gray-800 transition"><i
                    class="fa-solid fa-users mr-3"></i> Utilisateurs</a>
            <a href="categories" class="flex items-center p-3 rounded-lg hover:bg-gray-800 transition"><i
                    class="fa-solid fa-list-check mr-3"></i> Catégories</a>

            <a href="/admin/City" class="flex items-center p-3 rounded-lg hover:bg-gray-800 transition"><i
                    class="fa-solid fa-flag mr-3"></i> City</a>
            <div class="pt-10 border-t border-gray-800 mt-10">
                <a href="/" class="flex items-center p-3 rounded-lg hover:bg-blue-900 transition text-blue-400"><i
                        class="fa-solid fa-house mr-3"></i> Retour au Site</a>
                <a href="/logout"
                    class="flex items-center p-3 rounded-lg hover:bg-red-900 transition text-red-400 mt-2"><i
                        class="fa-solid fa-power-off mr-3"></i> Déconnexion</a>
            </div>
        </nav>
    </aside>

    <div class="flex-1">
        <header class="bg-white shadow-sm p-4 flex justify-between items-center px-8">
            <h2 class="font-bold text-gray-800 text-lg uppercase tracking-wider">Statistiques Globales</h2>
            <div class="flex items-center gap-4">
                <div class="relative">
                    <i class="fa-solid fa-bell text-gray-400 text-xl"></i>
                    <span class="absolute -top-1 -right-1 bg-red-500 w-2 h-2 rounded-full"></span>
                </div>
                <p class="font-bold text-gray-700">Admin_System</p>
            </div>
        </header>

        <div class="p-8 space-y-8">

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white p-6 rounded-2xl shadow-sm border-b-4 border-blue-500">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-gray-500 text-sm font-bold">Total Utilisateurs</p>
                            <h3 class="text-3xl font-black mt-1">{{ $totalUsers }}</h3>
                        </div>
                        <i class="fa-solid fa-users text-4xl text-gray-100"></i>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow-sm border-b-4 border-orange-500">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-gray-500 text-sm font-bold">Total Artisans</p>
                            <h3 class="text-3xl font-black mt-1">{{ $totalArtisans }}</h3>
                        </div>
                        <i class="fa-solid fa-screwdriver-wrench text-4xl text-gray-100"></i>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow-sm border-b-4 border-green-500">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-gray-500 text-sm font-bold">Nouveaux Clients</p>
                            <h3 class="text-3xl font-black mt-1">{{ $newClients }}</h3>
                        </div>
                        <i class="fa-solid fa-user-plus text-4xl text-gray-100"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm overflow-hidden border border-gray-100">
                <div class="p-6 border-b border-gray-100 flex justify-between items-center">
                    <h3 class="font-bold text-gray-800">Dernières Inscriptions</h3>
                    <button
                        class="text-sm bg-blue-50 text-blue-600 px-4 py-2 rounded-lg font-bold hover:bg-blue-100 transition">Voir
                        tout</button>
                </div>
                <table class="w-full text-left">
                    <thead class="bg-gray-50 text-gray-500 text-xs uppercase">
                        <tr>
                            <th class="p-4">Utilisateur</th>
                            <th class="p-4">Rôle</th>
                            <th class="p-4">Ville</th>
                            <th class="p-4">Status</th>
                            <th class="p-4 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse ($news as $new)
                            <tr>
                                <td class="p-4 flex items-center gap-3">
                                    <div
                                        class="w-8 h-8 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center font-bold">
                                        M</div>
                                    <div>
                                        <p class="font-bold text-gray-800 text-sm">{{ $new->name }}</p>

                                    </div>
                                </td>
                                <td class="p-4">
                                    <span
                                        class="px-2 py-1 bg-orange-100 text-orange-600 rounded text-[10px] font-bold uppercase">{{ $new->roles }}</span>
                                </td>
                                <td class="p-4 text-sm text-gray-600">{{ $new->city }}</td>
                                <td class="p-4">
                                    @if ($new->is_bane == null)
                                        <span
                                            class="flex items-center gap-2 text-green-600 font-bold bg-green-50 px-3 py-1 rounded-full w-fit text-xs">
                                            <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span>
                                            Actif
                                        </span>
                                    @else
                                        <span
                                            class="flex items-center gap-2 text-red-600 font-bold bg-red-50 px-3 py-1 rounded-full w-fit text-xs">
                                            <span class="w-2 h-2 bg-red-500 rounded-full"></span>
                                            Banni
                                        </span>
                                    @endif
                                </td>
                                <td class="p-4 text-center">
                                    <form action="{{ route('admin.ban_user', $new) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button class="text-gray-400 hover:text-red-500 transition mr-2"><i
                                                class="fa-solid fa-ban"></i></button>
                                    </form>

                                    {{-- <button class="text-gray-400 hover:text-blue-500 transition"><i --}}
                                    {{-- class="fa-solid fa-pen-to-square"></i></button> --}}
                                </td>
                            </tr>
                        @empty
                            <h4>no news</h4>
                        @endforelse




                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>

</html>
