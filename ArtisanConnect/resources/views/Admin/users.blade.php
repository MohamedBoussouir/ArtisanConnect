<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion Utilisateurs - ArtisanConnect</title>
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
            <a href="/admin/users" class="flex items-center p-3 rounded-lg bg-gray-800 text-white shadow-lg">
                <i class="fa-solid fa-users mr-3"></i> Utilisateurs
            </a>
            <a href="/admin/categories" class="flex items-center p-3 rounded-lg hover:bg-gray-800 transition">
                <i class="fa-solid fa-list-check mr-3"></i> Catégories
            </a>
            <a href="#" class="flex items-center p-3 rounded-lg hover:bg-gray-800 transition">
                <i class="fa-solid fa-flag mr-3"></i> Signalements
            </a>
            
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
            </div>
        </nav>
    </aside>

    <div class="flex-1">
        <header class="bg-white shadow-sm p-4 flex justify-between items-center px-8">
            <h2 class="font-bold text-gray-800 text-lg uppercase tracking-wider">Gestion des Utilisateurs</h2>
            <div class="flex items-center gap-4">
                <p class="font-bold text-gray-700">Admin_System</p>
                <div class="w-10 h-10 rounded-full bg-orange-500 flex items-center justify-center text-white font-bold">A</div>
            </div>
        </header>

        <div class="p-8">
            <div class="mb-8 flex justify-between items-center">
                <h3 class="text-2xl font-black text-slate-800">Liste des membres</h3>
                <div class="bg-white px-6 py-2 rounded-2xl shadow-sm border border-gray-100 font-bold text-blue-600">
                    {{ $users->total() }} Inscrits
                </div>
            </div>

            <div class="bg-white rounded-3xl shadow-sm overflow-hidden border border-gray-100">
                <table class="w-full text-left">
                    <thead class="bg-gray-50 text-gray-400 text-xs uppercase font-black">
                        <tr>
                            <th class="p-5">Profil</th>
                            <th class="p-5">Rôle</th>
                            <th class="p-5">Ville</th>
                            <th class="p-5">Statut</th>
                            <th class="p-5 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @foreach($users as $user)
                        <tr class="hover:bg-slate-50 transition">
                            <td class="p-5">
                                <div class="flex items-center gap-3">
                                    <div class="w-11 h-11 rounded-2xl bg-gradient-to-br from-slate-100 to-slate-200 flex items-center justify-center font-bold text-slate-500 uppercase">
                                        {{ substr($user->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <p class="font-bold text-slate-800">{{ $user->name }}</p>
                                        <p class="text-xs text-slate-400">{{ $user->email }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="p-5">
                                @if($user->roles == 'artisan')
                                    <span class="px-3 py-1 bg-orange-100 text-orange-600 rounded-lg text-[10px] font-black uppercase tracking-wider">Artisan</span>
                                @elseif($user->roles == 'admin')
                                    <span class="px-3 py-1 bg-blue-100 text-blue-600 rounded-lg text-[10px] font-black uppercase tracking-wider">Admin</span>
                                @else
                                    <span class="px-3 py-1 bg-green-100 text-green-600 rounded-lg text-[10px] font-black uppercase tracking-wider">Client</span>
                                @endif
                            </td>
                            <td class="p-5 text-sm font-medium text-slate-600">{{ $user->city }}</td>
                            <td class="p-5">
                                <span class="flex items-center gap-1.5 text-green-500 text-xs font-bold">
                                    <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span> Actif
                                </span>
                            </td>
                            <td class="p-5 text-center">
                                <div class="flex justify-center gap-2">
                                    <button title="Voir Profil" class="w-9 h-9 rounded-xl bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white transition">
                                        <i class="fa-solid fa-eye"></i>
                                    </button>
                                    <button title="Bannir" class="w-9 h-9 rounded-xl bg-red-50 text-red-400 hover:bg-red-500 hover:text-white transition">
                                        <i class="fa-solid fa-ban"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                
                <div class="p-6 bg-gray-50 border-t border-gray-100">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>

</body>
</html>