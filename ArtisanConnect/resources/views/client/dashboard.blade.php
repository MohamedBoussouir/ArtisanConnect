<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Dashboard - ArtisanConnect</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-slate-50 font-sans">

    <div class="flex min-h-screen">
        <aside class="w-72 bg-white border-r border-slate-200 hidden lg:block shadow-sm">
            <div class="p-8 text-2xl font-black text-blue-700 tracking-tight">
                Artisan<span class="text-orange-500">Connect</span>
            </div>
            
            <nav class="mt-4 p-4 space-y-2">
                <a href="#" class="flex items-center py-3 px-4 rounded-xl bg-blue-50 text-blue-700 font-bold transition">
                    <i class="fa-solid fa-house-chimney mr-3"></i> Vue d'ensemble
                </a>
                <a href="#" class="flex items-center py-3 px-4 rounded-xl text-slate-500 hover:bg-slate-50 hover:text-blue-700 transition font-medium">
                    <i class="fa-solid fa-calendar-days mr-3"></i> Mes Réservations
                </a>
                <a href="#" class="flex items-center py-3 px-4 rounded-xl text-slate-500 hover:bg-slate-50 hover:text-blue-700 transition font-medium">
                    <i class="fa-solid fa-heart mr-3"></i> Artisans Favoris
                </a>
                <a href="#" class="flex items-center py-3 px-4 rounded-xl text-slate-500 hover:bg-slate-50 hover:text-blue-700 transition font-medium">
                    <i class="fa-solid fa-message mr-3"></i> Messages
                </a>
                <div class="pt-8 pb-4">
                    <p class="px-4 text-[10px] font-black uppercase text-slate-400 tracking-widest">Paramètres</p>
                </div>
                <a href="/profile/settings" class="flex items-center py-3 px-4 rounded-xl text-slate-500 hover:bg-slate-50 hover:text-blue-700 transition font-medium">
                    <i class="fa-solid fa-user-gear mr-3"></i> Mon Profil
                </a>
                <a href="/logout" class="flex items-center py-3 px-4 rounded-xl text-red-400 hover:bg-red-50 transition font-medium">
                    <i class="fa-solid fa-power-off mr-3"></i> Déconnexion
                </a>
            </nav>
        </aside>

        <main class="flex-1">
            <header class="bg-white border-b border-slate-200 p-6 flex justify-between items-center px-10">
                <div>
                    <h2 class="text-xl font-black text-slate-800 uppercase tracking-tighter">Tableau de Bord</h2>
                    <p class="text-xs text-slate-400 font-medium">Bienvenue, {{ Auth::user()->name }} 👋</p>
                </div>
                <div class="flex items-center gap-4">
                    <button class="relative w-10 h-10 flex items-center justify-center bg-slate-50 rounded-xl text-slate-500 hover:bg-slate-100 transition">
                        <i class="fa-solid fa-bell"></i>
                        <span class="absolute top-2 right-2 w-2 h-2 bg-orange-500 rounded-full border-2 border-white"></span>
                    </button>
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=1E3A8A&color=fff" class="w-10 h-10 rounded-xl border-2 border-white shadow-sm">
                </div>
            </header>

            <div class="p-10">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
                    <div class="bg-white p-6 rounded-[2rem] shadow-sm border border-slate-100 flex items-center gap-5">
                        <div class="w-14 h-14 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center text-xl shadow-inner">
                            <i class="fa-solid fa-clock-rotate-left"></i>
                        </div>
                        <div>
                            <p class="text-[10px] font-black uppercase text-slate-400 tracking-widest">En cours</p>
                            <h3 class="text-2xl font-black text-slate-800 tracking-tighter">04</h3>
                        </div>
                    </div>
                    <div class="bg-white p-6 rounded-[2rem] shadow-sm border border-slate-100 flex items-center gap-5">
                        <div class="w-14 h-14 bg-green-50 text-green-600 rounded-2xl flex items-center justify-center text-xl shadow-inner">
                            <i class="fa-solid fa-check-double"></i>
                        </div>
                        <div>
                            <p class="text-[10px] font-black uppercase text-slate-400 tracking-widest">Terminées</p>
                            <h3 class="text-2xl font-black text-slate-800 tracking-tighter">12</h3>
                        </div>
                    </div>
                    <div class="bg-white p-6 rounded-[2rem] shadow-sm border border-slate-100 flex items-center gap-5">
                        <div class="w-14 h-14 bg-orange-50 text-orange-600 rounded-2xl flex items-center justify-center text-xl shadow-inner">
                            <i class="fa-solid fa-star"></i>
                        </div>
                        <div>
                            <p class="text-[10px] font-black uppercase text-slate-400 tracking-widest">Avis laissés</p>
                            <h3 class="text-2xl font-black text-slate-800 tracking-tighter">08</h3>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <div class="lg:col-span-2 space-y-6">
                        <div class="flex justify-between items-center px-2">
                            <h3 class="text-lg font-black text-slate-800 uppercase italic tracking-tighter">Réservations Récentes</h3>
                            <a href="#" class="text-blue-600 text-xs font-bold hover:underline">Voir tout</a>
                        </div>

                        <div class="bg-white p-6 rounded-[2.5rem] border border-slate-100 shadow-sm hover:shadow-md transition-all flex items-center justify-between gap-4">
                            <div class="flex items-center gap-4">
                                <div class="w-16 h-16 bg-slate-900 text-white rounded-3xl flex flex-col items-center justify-center">
                                    <span class="text-[8px] font-black uppercase opacity-60">Mai</span>
                                    <span class="text-xl font-black italic">14</span>
                                </div>
                                <div>
                                    <h4 class="font-black text-slate-800 uppercase italic leading-none">Réparation Plomberie</h4>
                                    <p class="text-xs text-slate-400 mt-1 font-medium italic">Artisan: <span class="text-blue-600">Ahmed Mansouri</span></p>
                                </div>
                            </div>
                            <div class="flex flex-col items-end">
                                <span class="px-3 py-1 rounded-full text-[9px] font-black uppercase tracking-widest bg-orange-100 text-orange-600 mb-2">En attente</span>
                                <p class="text-[10px] font-bold text-slate-400 tracking-widest uppercase">14:30</p>
                            </div>
                        </div>

                        <div class="bg-white p-6 rounded-[2.5rem] border border-slate-100 shadow-sm hover:shadow-md transition-all flex items-center justify-between gap-4">
                            <div class="flex items-center gap-4">
                                <div class="w-16 h-16 bg-slate-900 text-white rounded-3xl flex flex-col items-center justify-center">
                                    <span class="text-[8px] font-black uppercase opacity-60">Avr</span>
                                    <span class="text-xl font-black italic">28</span>
                                </div>
                                <div>
                                    <h4 class="font-black text-slate-800 uppercase italic leading-none">Installation Électrique</h4>
                                    <p class="text-xs text-slate-400 mt-1 font-medium italic">Artisan: <span class="text-blue-600">Yassine Amrani</span></p>
                                </div>
                            </div>
                            <div class="flex flex-col items-end">
                                <span class="px-3 py-1 rounded-full text-[9px] font-black uppercase tracking-widest bg-green-100 text-green-600 mb-2">Terminée</span>
                                <p class="text-[10px] font-bold text-slate-400 tracking-widest uppercase">10:00</p>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <h3 class="text-lg font-black text-slate-800 uppercase italic tracking-tighter px-2">Besoin d'aide ?</h3>
                        <div class="bg-blue-700 rounded-[2.5rem] p-8 text-white shadow-xl shadow-blue-100 relative overflow-hidden group">
                            <div class="relative z-10">
                                <h4 class="text-xl font-black italic uppercase leading-tight mb-2">Trouvez un nouvel Artisan</h4>
                                <p class="text-blue-100 text-sm font-medium mb-6 leading-relaxed">Parcourez nos catégories et réservez un service en quelques clics.</p>
                                <a href="/" class="inline-block bg-white text-blue-700 px-6 py-3 rounded-2xl font-black uppercase text-[10px] tracking-widest hover:bg-orange-500 hover:text-white transition-all shadow-lg active:scale-95">Explorer les métiers</a>
                            </div>
                            <i class="fa-solid fa-magnifying-glass absolute -bottom-4 -right-4 text-8xl text-blue-800/50 transform -rotate-12 group-hover:scale-110 transition-transform"></i>
                        </div>

                        <div class="bg-white p-6 rounded-[2.5rem] border border-slate-100 shadow-sm">
                            <h4 class="text-[10px] font-black uppercase text-slate-400 tracking-[0.2em] mb-4">Profil à 80%</h4>
                            <div class="w-full h-2 bg-slate-100 rounded-full overflow-hidden">
                                <div class="w-[80%] h-full bg-orange-500 rounded-full shadow-[0_0_10px_rgba(249,115,22,0.4)]"></div>
                            </div>
                            <p class="text-[10px] text-slate-400 mt-3 font-medium italic">Ajoutez un numéro de téléphone pour plus de rapidité.</p>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

</body>
</html> 