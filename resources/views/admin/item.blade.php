@extends('layouts.app')

@section('breadcrumb', 'Perpustakaan Digital')

@section('content')

    <div class="p-6">
        <!-- Header Section -->
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between mb-8">
            <div>
                <h1 class="text-3xl font-bold text-amerta-primary mb-2">Perpustakaan Digital Budaya</h1>
                <p class="text-gray-600">Kelola koleksi digital warisan budaya dari seluruh Nusantara</p>
            </div>
            <div class="flex items-center space-x-3 mt-4 lg:mt-0">
                <button id="create-item-btn"
                    class="bg-amerta-primary hover:bg-amerta-dark text-white px-6 py-3 rounded-xl font-medium transition-colors duration-200 flex items-center">
                    <i class="fas fa-plus mr-2"></i>
                    Tambah Item
                </button>
            </div>
        </div>

        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 animate__animated animate__fadeInDown animate__faster"
                    role="alert">
                    <span class="font-medium">{{ $error }}</span>
                </div>
            @endforeach
        @endif
        @if (session('success'))
            <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 animate__animated animate__fadeInDown animate__faster"
                role="alert">
                <span class="font-medium">Sukses!</span> {{ session('success') }}
            </div>
        @endif

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="bg-gradient-to-r from-emerald-500 to-emerald-600 p-6 rounded-2xl text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-emerald-100 text-sm">Total Item</p>
                        <p class="text-3xl font-bold">1,247</p>
                    </div>
                    <i class="fas fa-archive text-3xl text-emerald-200"></i>
                </div>
            </div>

            <div class="bg-gradient-to-r from-blue-500 to-blue-600 p-6 rounded-2xl text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-blue-100 text-sm">Dokumen</p>
                        <p class="text-3xl font-bold">523</p>
                    </div>
                    <i class="fas fa-file-alt text-3xl text-blue-200"></i>
                </div>
            </div>

            <div class="bg-gradient-to-r from-pink-500 to-pink-600 p-6 rounded-2xl text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-pink-100 text-sm">Media</p>
                        <p class="text-3xl font-bold">456</p>
                    </div>
                    <i class="fas fa-photo-video text-3xl text-pink-200"></i>
                </div>
            </div>

            <div class="bg-gradient-to-r from-orange-500 to-orange-600 p-6 rounded-2xl text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-orange-100 text-sm">Audio</p>
                        <p class="text-3xl font-bold">268</p>
                    </div>
                    <i class="fas fa-music text-3xl text-orange-200"></i>
                </div>
            </div>
        </div>

        <!-- Filters & Search -->
        <div class="bg-white rounded-2xl border border-gray-100 p-6 mb-6">
            <div class="grid grid-cols-1 lg:grid-cols-5 gap-4">
                <!-- Search -->
                <div class="lg:col-span-2 relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <i class="fas fa-search text-gray-400"></i>
                    </div>
                    <input type="text" id="search-input"
                        class="block w-full pl-10 pr-3 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-amerta-primary/20 focus:border-amerta-primary transition-colors"
                        placeholder="Cari di perpustakaan...">
                </div>

                <!-- Category Filter -->
                <select id="category-filter"
                    class="px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-amerta-primary/20 focus:border-amerta-primary transition-colors">
                    <option value="">Semua Kategori</option>
                    <option value="baju_adat">👘 Baju Adat</option>
                    <option value="permainan">🎲 Permainan</option>
                    <option value="musik_tradisional">🎶 Musik Tradisional</option>
                    <option value="makanan_tradisional">🍲 Makanan Tradisional</option>
                    <option value="acara_adat">🎉 Acara Adat</option>
                    <option value="cerita_rakyat">📖 Cerita Rakyat</option>
                    <option value="artefak">🏺 Artefak</option>
                </select>

                <!-- Province Filter -->
                <select id="province-filter"
                    class="px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-amerta-primary/20 focus:border-amerta-primary transition-colors">
                    <option value="">Semua Provinsi</option>
                    @foreach ($provinces as $prov)
                        <option value="{{ $prov->id }}">{{ $prov->name }}</option>
                    @endforeach
                </select>

                <!-- Uploader Filter -->
                <select id="uploader-filter"
                    class="px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-amerta-primary/20 focus:border-amerta-primary transition-colors">
                    <option value="">Semua Uploader</option>
                    <option value="1">Admin Utama</option>
                    <option value="2">Kurator Budaya</option>
                    <option value="3">Kontributor</option>
                    <option value="4">Relawan</option>
                </select>
            </div>

            <!-- Additional Actions -->
            <div class="flex items-center justify-between mt-4 pt-4 border-t border-gray-100">
                <div class="flex items-center space-x-2 text-sm text-gray-500">
                    <i class="fas fa-filter"></i>
                    <span id="active-filters">Tidak ada filter aktif</span>
                </div>
                <div class="flex items-center space-x-2">
                    <button id="clear-filters" class="text-sm text-gray-500 hover:text-amerta-primary transition-colors">
                        Reset Filter
                    </button>
                    <button id="export-btn"
                        class="text-sm bg-gray-100 hover:bg-gray-200 px-3 py-2 rounded-lg transition-colors">
                        <i class="fas fa-download mr-1"></i>
                        Export
                    </button>
                </div>
            </div>
        </div>

        <!-- Library Grid -->
        <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden">
            <!-- Grid Header -->
            <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-gray-800">Koleksi Digital</h3>
                    <div class="flex items-center space-x-4">
                        <div class="flex items-center space-x-2 text-sm text-gray-500">
                            {{-- <span>Menampilkan {{ $items->firstItem() }}-{{ $items->lastItem() }} dari {{ $items->total() }} item</span> --}}
                        </div>
                        <div class="flex items-center space-x-2">
                            <button id="grid-view" class="p-2 bg-amerta-primary text-white rounded-lg">
                                <i class="fas fa-th-large"></i>
                            </button>
                            <button id="list-view" class="p-2 text-gray-400 hover:bg-gray-100 rounded-lg">
                                <i class="fas fa-list"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Grid Content -->
            <div id="items-grid" class="p-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @forelse($items as $item)
                    <div
                        class="group bg-white border border-gray-200 rounded-2xl overflow-hidden hover:shadow-lg hover:border-amerta-primary/30 transition-all duration-300">

                        <!-- Item Thumbnail -->
                        <div class="relative h-48 bg-gray-100 flex items-center justify-center overflow-hidden">
                            @if ($item->file)
                                <img src="{{ $item->file }}" alt="{{ $item->title }}"
                                    class="w-full h-full object-cover bg-gray-50">
                            @else
                                {{-- Thumbnail fallback --}}
                                <div class="w-full h-full flex items-center justify-center bg-gray-200">
                                    <i class="fas fa-image text-4xl text-gray-400"></i>
                                </div>
                            @endif

                            <!-- Badge Kategori -->
                            <div class="absolute top-3 left-3">
                                <span
                                    class="
                        @switch($item->category)
                            @case('baju_adat') bg-red-100 text-red-800 @break
                            @case('permainan') bg-green-100 text-green-800 @break
                            @case('musik_tradisional') bg-blue-100 text-blue-800 @break
                            @case('makanan_tradisional') bg-yellow-100 text-yellow-800 @break
                            @case('acara_adat') bg-purple-100 text-purple-800 @break
                            @case('cerita_rakyat') bg-pink-100 text-pink-800 @break
                            @case('artefak') bg-orange-100 text-orange-800 @break
                            @default bg-gray-100 text-gray-800
                        @endswitch
                        text-xs font-medium px-2 py-1 rounded-full">
                                    {{ str_replace('_', ' ', ucfirst($item->category)) }}
                                </span>
                            </div>
                        </div>

                        <!-- Item Info -->
                        <div class="p-4">
                            <div class="flex items-start justify-between mb-2">
                                <h4 class="font-semibold text-gray-900 text-sm line-clamp-2 flex-1">
                                    {{ $item->title }}
                                </h4>
                                <div class="ml-2 flex items-center space-x-1">
                                    {{-- Download PDF jika ada --}}
                                    @if ($item->file_url)
                                        <a href="{{ $item->file_url }}"
                                            class="p-1 text-gray-400 hover:text-blue-600 transition-colors"
                                            title="Download PDF" target="_blank">
                                            <i class="fas fa-download text-sm"></i>
                                        </a>
                                    @endif
                                    <button class="p-1 text-gray-400 hover:text-green-600 transition-colors btn-preview"
                                        title="Preview" data-id="{{ $item->id }}">
                                        <i class="fas fa-eye text-sm"></i>
                                    </button>
                                </div>
                            </div>

                            <p class="text-xs text-gray-500 mb-3 line-clamp-2">
                                {{ \Illuminate\Support\Str::limit(strip_tags($item->description), 80) }}
                            </p>

                            <div class="flex items-center justify-between text-xs text-gray-400 mb-3">
                                <div class="flex items-center space-x-2">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <span>{{ $item->province->name ?? '-' }}</span>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <i class="fas fa-user"></i>
                                    <span>{{ $item->uploader->name ?? '-' }}</span>
                                </div>
                            </div>

                            <div class="flex items-center justify-between">
                                <span class="text-xs text-gray-500">
                                    {{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}
                                </span>
                                <div class="flex items-center space-x-1">
                                    {{-- <button class="p-1 text-gray-400 hover:text-amerta-primary transition-colors btn-edit"
                                        title="Edit" data-id="{{ $item->id }}">
                                        <i class="fas fa-edit text-sm"></i>
                                    </button> --}}
                                    <button type="button"
                                        class="p-1 text-gray-400 hover:text-red-600 transition-colors btn-delete"
                                        data-id="{{ $item->id }}">
                                        <i class="fas fa-trash text-sm"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-4 text-center text-gray-500 py-12">
                        Tidak ada item ditemukan.
                    </div>
                @endforelse
            </div>


            <!-- Pagination -->
            <div class="px-6 py-4 border-t border-gray-100 bg-gray-50">
                <div class="flex items-center justify-between">
                    <div class="text-sm text-gray-500">
                        {{-- Halaman {{ $items->currentPage() }} dari {{ $items->lastPage() }} --}}
                    </div>
                    <div>
                        {{-- {{ $items->links() }} --}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="item-modal" class="fixed inset-0 z-50 hidden bg-black bg-opacity-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-4xl max-h-[90vh] overflow-hidden">
            <!-- Modal Header -->
            <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
                <div class="flex items-center justify-between">
                    <h2 id="item-modal-title" class="text-xl font-bold text-gray-800">Tambah Item Baru</h2>
                    <button id="close-item-modal"
                        class="p-2 text-gray-400 hover:text-gray-600 rounded-lg transition-colors">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
            </div>

            <!-- Modal Body -->
            <div class="p-6 overflow-y-auto max-h-[calc(90vh-140px)]">
                <form action="/create/item" method="POST" id="item-form" class="space-y-6"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <!-- Title -->
                        <div class="lg:col-span-2">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Judul Item</label>
                            <input type="text" id="item-title" name="title"
                                class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-amerta-primary/20 focus:border-amerta-primary transition-colors"
                                placeholder="Masukkan judul item..." required>
                        </div>

                        <!-- Category -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Kategori</label>
                            <select id="item-category" name="category"
                                class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-amerta-primary/20 focus:border-amerta-primary transition-colors"
                                required>
                                <option value="">Pilih kategori...</option>
                                <option value="baju_adat">👘 Baju Adat</option>
                                <option value="permainan">🎲 Permainan</option>
                                <option value="musik_tradisional">🎶 Musik Tradisional</option>
                                <option value="makanan_tradisional">🍲 Makanan Tradisional</option>
                                <option value="acara_adat">🎉 Acara Adat</option>
                                <option value="cerita_rakyat">📖 Cerita Rakyat</option>
                                <option value="artefak">🏺 Artefak</option>
                            </select>
                        </div>

                        <!-- Province -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Provinsi</label>
                            <select id="item-province" name="province_id"
                                class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-amerta-primary/20 focus:border-amerta-primary transition-colors"
                                required>
                                <option value="">Pilih provinsi...</option>
                                @foreach ($provinces as $prov)
                                    <option value="{{ $prov->id }}">{{ $prov->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Description -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi</label>
                        <textarea id="item-description" name="description" rows="4"
                            class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-amerta-primary/20 focus:border-amerta-primary transition-colors resize-y"
                            placeholder="Jelaskan tentang item ini..." required></textarea>
                    </div>

                    <!-- Media Upload -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Media (Gambar, Video, Audio)</label>
                        <div
                            class="border-2 border-dashed border-gray-200 rounded-xl p-6 text-center hover:border-amerta-primary/50 transition-colors">
                            <input type="file" id="item-file" name="file" class="hidden"
                                accept=".jpg,.jpeg,.png,.mp4,.mp3,.wav">
                            <div id="file-upload-area" class="cursor-pointer">
                                <i class="fas fa-cloud-upload-alt text-4xl text-gray-400 mb-3"></i>
                                <p class="text-gray-600 mb-2">Klik untuk upload media atau drag & drop</p>
                                <p class="text-xs text-gray-500">JPG, PNG, MP4, MP3, WAV (Max: 50MB)</p>
                            </div>
                            <div id="file-preview" class="hidden">
                                <div class="flex items-center justify-center space-x-3 bg-gray-50 rounded-lg p-4">
                                    <i id="file-icon" class="fas fa-file text-2xl text-amerta-primary"></i>
                                    <div class="text-left">
                                        <p id="file-name" class="font-medium text-gray-800"></p>
                                        <p id="file-size" class="text-sm text-gray-500"></p>
                                    </div>
                                    <button type="button" id="remove-file"
                                        class="p-1 text-red-500 hover:bg-red-50 rounded">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- PDF Upload or URL -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Dokumen (PDF)</label>
                        <input type="file" id="pdf-file" name="file_url"
                            class="w-full px-4 py-3 border border-gray-200 rounded-xl" accept=".pdf">
                        <p class="text-center my-2 text-sm text-gray-500">atau</p>
                        <input type="url" id="pdf-url" name="file_url"
                            class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-amerta-primary/20 focus:border-amerta-primary transition-colors"
                            placeholder="Masukkan URL PDF eksternal...">
                    </div>

                </form>
            </div>

            <!-- Modal Footer -->
            <div class="px-6 py-4 border-t border-gray-100 bg-gray-50 flex items-center justify-end space-x-3">
                <button id="cancel-item-btn" type="button"
                    class="px-6 py-3 text-gray-700 bg-white border border-gray-200 rounded-xl hover:bg-gray-50 transition-colors">
                    Batal
                </button>
                <button id="save-item-btn" type="submit" form="item-form"
                    class="px-6 py-3 bg-amerta-primary hover:bg-amerta-dark text-white rounded-xl transition-colors">
                    <i class="fas fa-save mr-2"></i>
                    Simpan Item
                </button>
            </div>
        </div>
    </div>


    <!-- Delete Confirmation Modal -->
    <div id="delete-item-modal"
        class="hidden fixed inset-0 z-50 bg-black bg-opacity-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md">
            <div class="p-6 text-center">
                <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-exclamation-triangle text-red-600 text-2xl"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-800 mb-2">Hapus Item?</h3>
                <p class="text-gray-600 mb-6">
                    Apakah Anda yakin ingin menghapus item ini? File dan data tidak dapat dikembalikan.
                </p>
                <div class="flex items-center justify-center space-x-3">
                    <button id="cancel-delete" type="button"
                        class="px-4 py-2 text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors">
                        Batal
                    </button>
                    <form id="delete-item-form" method="POST" action="">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg transition-colors">
                            Ya, Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
    document.addEventListener("DOMContentLoaded", () => {
    const modalDelete = document.getElementById("delete-item-modal");
    const formDelete = document.getElementById("delete-item-form");
    const cancelBtnDelete = document.getElementById("cancel-delete");

    // Tombol delete di setiap item
    document.querySelectorAll(".btn-delete").forEach(btn => {
    btn.addEventListener("click", () => {
    const id = btn.dataset.id;
    formDelete.action = "/item/" + id; // route sesuai resource
    modalDelete.classList.remove("hidden");
    });
    });

    // Tombol batal
    cancelBtnDelete.addEventListener("click", () => {
    modalDelete.classList.add("hidden");
    });
    });

    </script>

    <!-- Preview Modal -->
    <div id="preview-modal" class="fixed inset-0 z-50 hidden bg-black bg-opacity-90 flex items-center justify-center p-4">
        <div class="relative w-full max-w-6xl max-h-[90vh]">
            <button id="close-preview"
                class="absolute top-4 right-4 z-10 p-2 bg-white/20 hover:bg-white/30 text-white rounded-lg">
                <i class="fas fa-times text-xl"></i>
            </button>

            <div id="preview-content" class="bg-white rounded-2xl overflow-hidden shadow-2xl">
                <!-- Preview content will be loaded here -->
            </div>
        </div>
    </div>

    <script>
        // Category icons mapping
        const categoryIcons = {
            'dokumen': {
                icon: 'fas fa-file-pdf',
                color: 'from-blue-500 to-blue-600',
                badge: 'bg-blue-100 text-blue-800'
            },
            'foto': {
                icon: 'fas fa-images',
                color: 'from-pink-500 to-pink-600',
                badge: 'bg-pink-100 text-pink-800'
            },
            'video': {
                icon: 'fas fa-video',
                color: 'from-purple-500 to-purple-600',
                badge: 'bg-purple-100 text-purple-800'
            },
            'audio': {
                icon: 'fas fa-music',
                color: 'from-orange-500 to-orange-600',
                badge: 'bg-orange-100 text-orange-800'
            },
            'artefak': {
                icon: 'fas fa-gem',
                color: 'from-emerald-500 to-emerald-600',
                badge: 'bg-emerald-100 text-emerald-800'
            },
            'cerita_rakyat': {
                icon: 'fas fa-book-open',
                color: 'from-amber-500 to-amber-600',
                badge: 'bg-amber-100 text-amber-800'
            },
            'resep_tradisional': {
                icon: 'fas fa-utensils',
                color: 'from-red-500 to-red-600',
                badge: 'bg-red-100 text-red-800'
            }
        };

        // Modal functionality
        const createItemBtn = document.getElementById('create-item-btn');
        const itemModal = document.getElementById('item-modal');
        const deleteItemModal = document.getElementById('delete-item-modal');
        const previewModal = document.getElementById('preview-modal');

        // Open modals
        createItemBtn.addEventListener('click', function() {
            document.getElementById('item-modal-title').textContent = 'Tambah Item Baru';
            document.getElementById('item-form').reset();
            itemModal.classList.remove('hidden');
        });

        // Close modals
        document.getElementById('close-item-modal').addEventListener('click', () => {
            itemModal.classList.add('hidden');
        });

        document.getElementById('close-preview').addEventListener('click', () => {
            previewModal.classList.add('hidden');
        });

        document.getElementById('cancel-item-btn').addEventListener('click', () => {
            itemModal.classList.add('hidden');
        });


        // File upload functionality
        const fileInput = document.getElementById('item-file');
        const fileUploadArea = document.getElementById('file-upload-area');
        const filePreview = document.getElementById('file-preview');
        const removeFileBtn = document.getElementById('remove-file');

        // Fix: prevent default form submission when clicking upload area
        fileUploadArea.addEventListener('click', function(e) {
            e.preventDefault();
            fileInput.click();
        });

        fileUploadArea.addEventListener('dragover', function(e) {
            e.preventDefault();
            fileUploadArea.classList.add('bg-amerta-primary/5');
        });

        fileUploadArea.addEventListener('dragleave', function(e) {
            e.preventDefault();
            fileUploadArea.classList.remove('bg-amerta-primary/5');
        });

        fileUploadArea.addEventListener('drop', function(e) {
            e.preventDefault();
            fileUploadArea.classList.remove('bg-amerta-primary/5');
            const files = e.dataTransfer.files;
            if (files.length > 0) {
                fileInput.files = files;
                handleFileUpload(files[0]);
            }
        });

        fileInput.addEventListener('change', function(e) {
            if (e.target.files.length > 0) {
                handleFileUpload(e.target.files[0]);
            }
        });

        function handleFileUpload(file) {
            const fileName = file.name;
            const fileSize = formatFileSize(file.size);
            const fileIcon = getFileIcon(file.type);

            document.getElementById('file-name').textContent = fileName;
            document.getElementById('file-size').textContent = fileSize;
            document.getElementById('file-icon').className = fileIcon;

            fileUploadArea.style.display = 'none';
            filePreview.classList.remove('hidden');
        }

        removeFileBtn.addEventListener('click', function(e) {
            e.preventDefault();
            fileInput.value = '';
            fileUploadArea.style.display = 'block';
            filePreview.classList.add('hidden');
        });

        function formatFileSize(bytes) {
            if (bytes === 0) return '0 Bytes';
            const k = 1024;
            const sizes = ['Bytes', 'KB', 'MB', 'GB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));
            return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
        }

        function getFileIcon(mimeType) {
            if (mimeType.startsWith('image/')) return 'fas fa-image text-2xl text-pink-500';
            if (mimeType.startsWith('video/')) return 'fas fa-video text-2xl text-purple-500';
            if (mimeType.startsWith('audio/')) return 'fas fa-music text-2xl text-orange-500';
            if (mimeType === 'application/pdf') return 'fas fa-file-pdf text-2xl text-red-500';
            return 'fas fa-file text-2xl text-gray-500';
        }

        // Filter & Search functionality
        document.getElementById('search-input').addEventListener('input', function(e) {
            updateQuery();
        });
        document.getElementById('category-filter').addEventListener('change', function(e) {
            updateQuery();
        });
        document.getElementById('province-filter').addEventListener('change', function(e) {
            updateQuery();
        });
        document.getElementById('uploader-filter').addEventListener('change', function(e) {
            updateQuery();
        });

        function updateQuery() {
            const search = document.getElementById('search-input').value;
            const category = document.getElementById('category-filter').value;
            const province = document.getElementById('province-filter').value;
            const uploader = document.getElementById('uploader-filter').value;
            const params = new URLSearchParams(window.location.search);

            if (search) params.set('search', search);
            else params.delete('search');
            if (category) params.set('category', category);
            else params.delete('category');
            if (province) params.set('province_id', province);
            else params.delete('province_id');
            if (uploader) params.set('uploaded_by', uploader);
            else params.delete('uploaded_by');

            window.location.search = params.toString();
        }

        // Edit item functionality
        document.querySelectorAll('.btn-edit').forEach(btn => {
            btn.addEventListener('click', function() {
                // Load item data via AJAX or fill modal for edit
                document.getElementById('item-modal-title').textContent = 'Edit Item';
                itemModal.classList.remove('hidden');
            });
        });

        // Preview item functionality
        document.querySelectorAll('.btn-preview').forEach(btn => {
            btn.addEventListener('click', function() {
                const itemId = btn.getAttribute('data-id');
                // Find item data from items array (if available)
                let item = null;
                @foreach($items as $item)
                    if ("{{ $item->id }}" == itemId) {
                        item = @json($item);
                    }
                @endforeach

                const previewContent = document.getElementById('preview-content');
                previewContent.innerHTML = '';

                if (item) {
                    let html = `<div class="p-8 flex flex-col items-center justify-center">`;
                    if (item.file) {
                        html += `<img src="${item.file}" alt="${item.title}" class="max-w-xl max-h-[60vh] rounded-lg shadow mb-4">`;
                    }
                    html += `<h3 class="text-xl font-bold mb-2">${item.title}</h3>`;
                    html += `<p class="text-gray-700 mb-4">${item.description}</p>`;
                    if (item.file_url) {
                        html += `<a href="${item.file_url}" target="_blank" class="text-blue-600 underline mb-2 block">Download PDF</a>`;
                    }
                    html += `</div>`;
                    previewContent.innerHTML = html;
                } else {
                    previewContent.innerHTML = '<div class="p-8 text-center text-gray-500">Data tidak ditemukan.</div>';
                }

                previewModal.classList.remove('hidden');
            });
        });

        // Keyboard shortcuts
        document.addEventListener('keydown', function(e) {
            if ((e.ctrlKey || e.metaKey) && e.key === 'n') {
                e.preventDefault();
                createItemBtn.click();
            }

            if (e.key === 'Escape') {
                itemModal.classList.add('hidden');
                deleteItemModal.classList.add('hidden');
                previewModal.classList.add('hidden');
            }
        });


        // // PDF preview
        // document.getElementById('item-pdf').addEventListener('change', function(e) {
        //     const file = e.target.files[0];
        //     const preview = document.getElementById('pdf-preview');
        //     const nameSpan = document.getElementById('pdf-file-name');
        //     if (file) {
        //         nameSpan.textContent = file.name;
        //         preview.classList.remove('hidden');
        //     } else {
        //         preview.classList.add('hidden');
        //         nameSpan.textContent = '';
        //     }
        // });
    </script>

@endsection
