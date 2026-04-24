<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Profil - ArtisanConnect</title>
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
                <a href="{{ route('client.dashboard') }}" class="flex items-center py-3 px-4 rounded-xl text-slate-500 hover:bg-slate-50 hover:text-blue-700 transition font-medium">
                    <i class="fa-solid fa-house-chimney mr-3"></i> Vue d'ensemble
                </a>
                <a href="{{ route('client.bookings') }}" class="flex items-center py-3 px-4 rounded-xl text-slate-500 hover:bg-slate-50 hover:text-blue-700 transition font-medium">
                    <i class="fa-solid fa-calendar-days mr-3"></i> Mes Réservations
                </a>
                <div class="pt-8 pb-4">
                    <p class="px-4 text-[10px] font-black uppercase text-slate-400 tracking-widest">Paramètres</p>
                </div>
                <a href="{{ route('client.profile') }}" class="flex items-center py-3 px-4 rounded-xl bg-blue-50 text-blue-700 font-bold transition">
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
            <h2 class="text-xl font-black text-slate-800 uppercase tracking-tighter italic">Paramètres du Profil</h2>
            <p class="text-xs text-slate-400 font-medium">Gérez vos informations personnelles</p>
        </div>
        <div class="flex items-center gap-4">
            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=1E3A8A&color=fff" class="w-10 h-10 rounded-xl border-2 border-white shadow-sm">
        </div>
    </header>

    <div class="p-10 max-w-4xl">
        {{-- تحديث الـ action ليوجه إلى مسار التحديث --}}
        <form action="{{ route('client.profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf
            @method('PUT')

            <div class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-sm flex items-center gap-8">
                <div class="relative">
                    {{-- عرض صورة المستخدم الحقيقية أو Avatar افتراضي --}}
                    <img src="{{ Auth::user()->profile_photo ? asset('storage/' . Auth::user()->profile_photo) : 'https://ui-avatars.com/api/?name='.urlencode(Auth::user()->name).'&size=128&background=1E3A8A&color=fff' }}" 
                         class="w-32 h-32 rounded-[2rem] object-cover border-4 border-slate-50 shadow-md">
                    
                    <label class="absolute -bottom-2 -right-2 bg-orange-500 text-white w-10 h-10 rounded-xl flex items-center justify-center cursor-pointer hover:bg-orange-600 transition shadow-lg">
                        <i class="fa-solid fa-camera text-sm"></i>
                        {{-- إضافة اسم للحقل 'photo' --}}
                        <input type="file" name="photo" class="hidden">
                    </label>
                </div>
                <div>
                    <h3 class="text-lg font-black text-slate-800 uppercase italic leading-none mb-2">Photo de profil</h3>
                    <p class="text-xs text-slate-400 font-medium">JPG, GIF ou PNG. Max 2Mo.</p>
                </div>
            </div>

            <div class="bg-white p-10 rounded-[3rem] border border-slate-100 shadow-sm">
                <h3 class="text-sm font-black text-slate-800 uppercase tracking-widest mb-8 flex items-center">
                    <i class="fa-solid fa-id-card mr-3 text-blue-600"></i> Informations Personnelles
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="text-[10px] font-black uppercase text-slate-400 ml-4 tracking-widest">Nom complet</label>
                        <input type="text" name="name" value="{{ Auth::user()->name }}" class="w-full bg-slate-50 border-none rounded-2xl p-4 text-slate-800 font-bold focus:ring-2 focus:ring-blue-500 transition">
                    </div>

                    <div class="space-y-2">
                        <label class="text-[10px] font-black uppercase text-slate-400 ml-4 tracking-widest">Adresse Email</label>
                        <input type="email" name="email" value="{{ Auth::user()->email }}" class="w-full bg-slate-50 border-none rounded-2xl p-4 text-slate-800 font-bold focus:ring-2 focus:ring-blue-500 transition">
                    </div>

                    <div class="space-y-2">
                        <label class="text-[10px] font-black uppercase text-slate-400 ml-4 tracking-widest">Téléphone</label>
                        {{-- إضافة القيمة من قاعدة البيانات هنا --}}
                        <input type="text" name="phone" value="{{ Auth::user()->phone }}" placeholder="+212 ..." class="w-full bg-slate-50 border-none rounded-2xl p-4 text-slate-800 font-bold focus:ring-2 focus:ring-blue-500 transition">
                    </div>

                    <div class="space-y-2">
                        <label class="text-[10px] font-black uppercase text-slate-400 ml-4 tracking-widest">Ville</label>
                        <select name="city" class="w-full bg-slate-50 border-none rounded-2xl p-4 text-slate-800 font-bold focus:ring-2 focus:ring-blue-500 transition appearance-none">
                            {{-- تحديد المدينة المختارة تلقائياً --}}
                            @foreach(['Casablanca', 'Marrakech', 'Youssoufia', 'Rabat'] as $city)
                                <option value="{{ $city }}" {{ Auth::user()->city == $city ? 'selected' : '' }}>{{ $city }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="bg-white p-10 rounded-[3rem] border border-slate-100 shadow-sm">
                <h3 class="text-sm font-black text-slate-800 uppercase tracking-widest mb-8 flex items-center">
                    <i class="fa-solid fa-lock mr-3 text-orange-500"></i> Sécurité
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="text-[10px] font-black uppercase text-slate-400 ml-4 tracking-widest">Nouveau mot de passe</label>
                        <input type="password" name="password" class="w-full bg-slate-50 border-none rounded-2xl p-4 focus:ring-2 focus:ring-blue-500 transition">
                    </div>
                    <div class="space-y-2">
                        <label class="text-[10px] font-black uppercase text-slate-400 ml-4 tracking-widest">Confirmer</label>
                        <input type="password" name="password_confirmation" class="w-full bg-slate-50 border-none rounded-2xl p-4 focus:ring-2 focus:ring-blue-500 transition">
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-end gap-4 pt-4">
                <button type="button" onclick="window.history.back()" class="px-8 py-4 text-slate-400 font-bold uppercase text-[10px] tracking-widest hover:text-slate-600 transition">Annuler</button>
                <button type="submit" class="bg-blue-700 text-white px-10 py-4 rounded-2xl font-black uppercase text-[10px] tracking-[0.2em] hover:bg-blue-800 transition shadow-xl shadow-blue-100 active:scale-95">
                    Sauvegarder les modifications
                </button>
            </div>
        </form>
    </div>
</main>
    </div>

</body>
</html>