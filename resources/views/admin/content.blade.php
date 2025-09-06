@extends('layouts.app')

@section('breadcrumb', 'Kelola Konten')

@section('content')
    <div class="p-6">
        <!-- Header Section -->
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between mb-8">
            <div>
                <h1 class="text-3xl font-bold text-amerta-primary mb-2">Kelola Konten Budaya</h1>
                <p class="text-gray-600">Kelola semua konten budaya, artikel, quiz, dan materi edukasi</p>
            </div>
            <button id="create-btn"
                class="mt-4 lg:mt-0 bg-amerta-primary hover:bg-amerta-dark text-white px-6 py-3 rounded-xl font-medium transition-colors duration-200 flex items-center">
                <i class="fas fa-plus mr-2"></i>
                Tambah Konten
            </button>
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
            <div class="bg-gradient-to-r from-blue-500 to-blue-600 p-6 rounded-2xl text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-blue-100 text-sm">Total Artikel</p>
                        <p class="text-3xl font-bold">{{ $article }}</p>
                    </div>
                    <i class="fas fa-newspaper text-3xl text-blue-200"></i>
                </div>
            </div>

            <div class="bg-gradient-to-r from-green-500 to-green-600 p-6 rounded-2xl text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-green-100 text-sm">Quiz Aktif</p>
                        <p class="text-3xl font-bold">{{ $quiz }}</p>
                    </div>
                    <i class="fas fa-question-circle text-3xl text-green-200"></i>
                </div>
            </div>

            <div class="bg-gradient-to-r from-purple-500 to-purple-600 p-6 rounded-2xl text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-purple-100 text-sm">Event</p>
                        <p class="text-3xl font-bold">{{ $event }}</p>
                    </div>
                    <i class="fas fa-calendar-alt text-3xl text-purple-200"></i>
                </div>
            </div>

            <div class="bg-gradient-to-r from-amber-500 to-amber-600 p-6 rounded-2xl text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-amber-100 text-sm">Total Konten</p>
                        <p class="text-3xl font-bold">{{ $total }}</p>
                    </div>
                    <i class="fas fa-file-alt text-3xl text-amber-200"></i>
                </div>
            </div>
        </div>

        <!-- Filters & Search -->
        <div class="bg-white rounded-2xl border border-gray-100 p-6 mb-6">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between space-y-4 lg:space-y-0">
                <!-- Search -->
                <div class="relative flex-1 lg:max-w-md">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <i class="fas fa-search text-gray-400"></i>
                    </div>
                    <input type="text" id="search-input"
                        class="block w-full pl-10 pr-3 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-amerta-primary/20 focus:border-amerta-primary transition-colors"
                        placeholder="Cari konten...">
                </div>

                <!-- Filters -->
                <div class="flex flex-wrap items-center space-x-4">
                    <select id="type-filter"
                        class="px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-amerta-primary/20 focus:border-amerta-primary transition-colors">
                        <option value="">Semua Tipe</option>
                        <option value="artikel">Artikel</option>
                        <option value="quiz">Quiz</option>
                        <option value="poster">Poster</option>
                        <option value="event">Event</option>
                        <option value="map_asset">Aset Peta</option>
                        <option value="submission">Submission</option>
                    </select>

                    <select id="author-filter"
                        class="px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-amerta-primary/20 focus:border-amerta-primary transition-colors">
                        <option value="">Semua Penulis</option>
                        <option value="1">Admin Utama</option>
                        <option value="2">Editor Budaya</option>
                        <option value="3">Kontributor</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Content Table -->
        <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden">
            <!-- Table Header -->
            <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-gray-800">Daftar Konten</h3>
                    <div class="flex items-center space-x-2 text-sm text-gray-500">
                        <span>Menampilkan 1-10 dari 67 konten</span>
                    </div>
                </div>
            </div>

            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 border-b border-gray-100">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                Konten
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                Tipe
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                Penulis
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                Tanggal
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach ($contents as $content)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="flex items-start space-x-4">
                                        <div
                                            class="w-12 h-12 bg-gradient-to-r {{ $content->type === 'artikel'
                                                ? 'from-blue-500 to-blue-600'
                                                : ($content->type === 'quiz'
                                                    ? 'from-green-500 to-green-600'
                                                    : ($content->type === 'poster'
                                                        ? 'from-amber-500 to-amber-600'
                                                        : ($content->type === 'event'
                                                            ? 'from-purple-500 to-purple-600'
                                                            : 'from-gray-400 to-gray-500'))) }} rounded-lg flex items-center justify-center">
                                            <i class=""
                                                {{ $content->type === 'artikel'
                                                    ? 'fas fa-newspaper'
                                                    : ($content->type === 'quiz'
                                                        ? 'fas fa-question-circle'
                                                        : ($content->type === 'poster'
                                                            ? 'fas fa-image'
                                                            : ($content->type === 'event'
                                                                ? 'fas fa-calendar-alt'
                                                                : 'fas fa-file-alt'))) }}
                                                text-white"></i>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <h4 class="text-sm font-semibold text-gray-900 truncate">
                                                {{ $content->title }}
                                            </h4>
                                            <p class="text-sm text-gray-500 mt-1 line-clamp-2">
                                                {!! \Illuminate\Support\Str::limit(strip_tags($content->body), 80) !!}
                                            </p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium 
                                    {{ $content->type === 'artikel'
                                        ? 'bg-blue-100 text-blue-800'
                                        : ($content->type === 'quiz'
                                            ? 'bg-green-100 text-green-800'
                                            : ($content->type === 'poster'
                                                ? 'bg-amber-100 text-amber-800'
                                                : ($content->type === 'event'
                                                    ? 'bg-purple-100 text-purple-800'
                                                    : 'bg-gray-100 text-gray-800'))) }}">
                                        <i
                                            class="
                                        {{ $content->type === 'artikel'
                                            ? 'fas fa-newspaper mr-1'
                                            : ($content->type === 'quiz'
                                                ? 'fas fa-question-circle mr-1'
                                                : ($content->type === 'poster'
                                                    ? 'fas fa-image mr-1'
                                                    : ($content->type === 'event'
                                                        ? 'fas fa-calendar-alt mr-1'
                                                        : 'fas fa-file-alt mr-1'))) }}"></i>
                                        {{ ucfirst($content->type) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center space-x-2">
                                        <div
                                            class="w-8 h-8 bg-amerta-primary rounded-full flex items-center justify-center">
                                            <span class="text-white text-xs font-medium">
                                                {{ strtoupper(substr($content->author->name ?? 'A', 0, 1)) }}
                                            </span>
                                        </div>
                                        <span class="text-sm text-gray-900">{{ $content->author->name ?? 'Admin' }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500">
                                    <div>{{ \Carbon\Carbon::parse($content->created_at)->format('d M Y') }}</div>
                                    <div class="text-xs text-gray-400">
                                        {{ \Carbon\Carbon::parse($content->created_at)->format('H:i') }} WIB</div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center space-x-2">
                                        <button class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors"
                                            title="Edit" data-id="{{ $content->id }}"
                                            data-title="{{ $content->title }}"
                                            data-type="{{ $content->type }}"
                                            data-body="{{ htmlentities($content->body) }}">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="p-2 text-green-600 hover:bg-green-50 rounded-lg transition-colors"
                                            title="Lihat" data-id="{{ $content->id }}">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button
                                            class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors btn-delete"
                                            title="Hapus" data-id="{{ $content->id }}">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="px-6 py-4 border-t border-gray-100 bg-gray-50">
                <div class="flex items-center justify-between">
                    <div class="text-sm text-gray-500">
                        Halaman {{ $contents->currentPage() }} dari {{ $contents->lastPage() }}
                    </div>
                    <div>
                        {{ $contents->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Create Modal -->
    <div id="content-create-modal"
        class="fixed inset-0 z-50 hidden bg-black bg-opacity-50 flex items-center justify-center p-4">
        <form action="/create/content" method="POST" id="content-create-form" class="space-y-6">
            <div class="bg-white rounded-2xl shadow-2xl w-full max-w-4xl max-h-[90vh] overflow-hidden">
                <!-- Modal Header -->
                <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
                    <div class="flex items-center justify-between">
                        <h2 class="text-xl font-bold text-gray-800">Tambah Konten Baru</h2>
                        <button type="button" id="close-create-modal"
                            class="p-2 text-gray-400 hover:text-gray-600 rounded-lg transition-colors">
                            <i class="fas fa-times text-xl"></i>
                        </button>
                    </div>
                </div>
                <!-- Modal Body -->
                <div class="p-6 overflow-y-auto max-h-[calc(90vh-140px)]">
                    @csrf
                    <!-- Title -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Judul Konten
                        </label>
                        <input type="text" id="create-title" name="title"
                            class="w-full px-4 py-3 border border-gray-200 rounded-xl"
                            placeholder="Masukkan judul konten..." required>
                    </div>

                    <!-- Type -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Tipe Konten
                        </label>
                        <select id="create-type" name="type"
                            class="w-full px-4 py-3 border border-gray-200 rounded-xl" required>
                            <option value="">Pilih tipe konten...</option>
                            <option value="artikel">📰 Artikel</option>
                            <option value="quiz">❓ Quiz</option>
                            <option value="poster">🖼️ Poster</option>
                            <option value="event">📅 Event</option>
                            <option value="map_asset">🗺️ Aset Peta</option>
                            <option value="submission">📝 Submission</option>
                        </select>
                    </div>

                    <!-- Body Content with QuillJS -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Konten
                        </label>
                        <div id="quill-create-body" style="height: 240px;"
                            class="bg-white px-4 py-3 border border-gray-200 rounded-xl"></div>
                        <input type="hidden" id="create-body" name="body" required>
                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="px-6 py-4 border-t border-gray-100 bg-gray-50 flex items-center justify-end space-x-3">
                    <button type="button" id="cancel-create-btn"
                        class="px-6 py-3 text-gray-700 bg-white border border-gray-200 rounded-xl">Batal</button>
                    <button type="submit" class="px-6 py-3 bg-amerta-primary hover:bg-amerta-dark text-white rounded-xl">
                        <i class="fas fa-save mr-2"></i>
                        Simpan Konten
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Edit Modal -->
    <div id="content-edit-modal"
        class="fixed inset-0 z-50 hidden bg-black bg-opacity-50 flex items-center justify-center p-4">
        <form method="POST" id="content-edit-form" class="space-y-6">
            @csrf
            <div class="bg-white rounded-2xl shadow-2xl w-full max-w-4xl max-h-[90vh] overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
                    <div class="flex items-center justify-between">
                        <h2 class="text-xl font-bold text-gray-800">Edit Konten</h2>
                        <button type="button" id="close-edit-modal"
                            class="p-2 text-gray-400 hover:text-gray-600 rounded-lg transition-colors">
                            <i class="fas fa-times text-xl"></i>
                        </button>
                    </div>
                </div>
                <div class="p-6 overflow-y-auto max-h-[calc(90vh-140px)]">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Judul Konten</label>
                        <input type="text" id="edit-title" name="title"
                            class="w-full px-4 py-3 border border-gray-200 rounded-xl" required>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Tipe Konten</label>
                        <select id="edit-type" name="type" class="w-full px-4 py-3 border border-gray-200 rounded-xl" required>
                            <option value="">Pilih tipe konten...</option>
                            <option value="artikel">📰 Artikel</option>
                            <option value="quiz">❓ Quiz</option>
                            <option value="poster">🖼️ Poster</option>
                            <option value="event">📅 Event</option>
                            <option value="map_asset">🗺️ Aset Peta</option>
                            <option value="submission">📝 Submission</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Konten</label>
                        <div id="quill-edit-body" style="height: 240px;"
                            class="bg-white px-4 py-3 border border-gray-200 rounded-xl"></div>
                        <input type="hidden" id="edit-body" name="body" required>
                    </div>
                </div>
                <div class="px-6 py-4 border-t border-gray-100 bg-gray-50 flex items-center justify-end space-x-3">
                    <button type="button" id="cancel-edit-btn"
                        class="px-6 py-3 text-gray-700 bg-white border border-gray-200 rounded-xl">Batal</button>
                    <button type="submit" class="px-6 py-3 bg-amerta-primary hover:bg-amerta-dark text-white rounded-xl">
                        <i class="fas fa-save mr-2"></i>Update Konten
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="delete-modal" class="fixed inset-0 z-50 hidden bg-black bg-opacity-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md">
            <div class="p-6 text-center">
                <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-exclamation-triangle text-red-600 text-2xl"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-800 mb-2">Hapus Konten?</h3>
                <p class="text-gray-600 mb-6">Apakah Anda yakin ingin menghapus konten ini? Tindakan ini tidak dapat
                    dibatalkan.</p>
                <div class="flex items-center justify-center space-x-3">
                    <button id="cancel-delete"
                        class="px-4 py-2 text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors">
                        Batal
                    </button>
                    <form id="delete-form" method="POST" action="" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button id="confirm-delete"
                            class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg transition-colors">
                            Ya, Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- QuillJS Styles & Script -->
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>

   <script>
    // Modal functionality
    const createBtn = document.getElementById('create-btn');
    const contentCreateModal = document.getElementById('content-create-modal');
    const contentEditModal = document.getElementById('content-edit-modal');
    const deleteModal = document.getElementById('delete-modal');
    const closeCreateModal = document.getElementById('close-create-modal');
    const closeEditModal = document.getElementById('close-edit-modal');
    const cancelCreateBtn = document.getElementById('cancel-create-btn');
    const cancelEditBtn = document.getElementById('cancel-edit-btn');
    const cancelDelete = document.getElementById('cancel-delete');

    // Open create modal
    createBtn.addEventListener('click', function() {
        document.getElementById('content-create-form').reset();
        quillCreate.setContents([]);
        contentCreateModal.classList.remove('hidden');
    });

    // Close modals
    [closeCreateModal, cancelCreateBtn].forEach(btn => {
        btn.addEventListener('click', function() {
            contentCreateModal.classList.add('hidden');
        });
    });

    [closeEditModal, cancelEditBtn].forEach(btn => {
        btn.addEventListener('click', function() {
            contentEditModal.classList.add('hidden');
        });
    });

    cancelDelete.addEventListener('click', function() {
        deleteModal.classList.add('hidden');
    });

    // Close modal on outside click
    contentCreateModal.addEventListener('click', function(e) {
        if (e.target === contentCreateModal) {
            contentCreateModal.classList.add('hidden');
        }
    });

    contentEditModal.addEventListener('click', function(e) {
        if (e.target === contentEditModal) {
            contentEditModal.classList.add('hidden');
        }
    });

    deleteModal.addEventListener('click', function(e) {
        if (e.target === deleteModal) {
            deleteModal.classList.add('hidden');
        }
    });

    // Edit buttons functionality
    document.querySelectorAll('button[title="Edit"]').forEach(btn => {
        btn.addEventListener('click', function() {
            const id = btn.getAttribute('data-id');
            document.getElementById('edit-title').value = btn.getAttribute('data-title');
            document.getElementById('edit-type').value = btn.getAttribute('data-type');
            quillEdit.root.innerHTML = decodeHTMLEntities(btn.getAttribute('data-body'));
            // Change action to /content/{id}/edit for POST
            document.getElementById('content-edit-form').action = `/content/${id}/edit`;
            contentEditModal.classList.remove('hidden');
        });
    });

    document.getElementById('content-edit-form').addEventListener('submit', function(e) {
        document.getElementById('edit-body').value = quillEdit.root.innerHTML;
    });

    function decodeHTMLEntities(text) {
        var txt = document.createElement('textarea');
        txt.innerHTML = text;
        return txt.value;
    }

    // Delete buttons functionality
    let deleteId = null;
    document.querySelectorAll('.btn-delete').forEach(btn => {
        btn.addEventListener('click', function() {
            deleteId = btn.getAttribute('data-id');
            document.getElementById('delete-form').action = '/content/' + deleteId;
            deleteModal.classList.remove('hidden');
        });
    });

    // Confirm delete submits form
    document.getElementById('confirm-delete').addEventListener('click', function() {
        document.getElementById('delete-form').submit();
    });

    /* =========================
       QuillJS setup untuk Create & Edit
       ========================= */

    // Create editor
    const quillCreate = new Quill('#quill-create-body', {
        theme: 'snow',
        placeholder: 'Tulis konten di sini...',
        modules: {
            toolbar: [
                [{ header: [1, 2, 3, false] }],
                ['bold', 'italic', 'underline', 'strike'],
                ['blockquote', 'code-block'],
                [{ list: 'ordered' }, { list: 'bullet' }],
                [{ 'align': [] }],
                ['link', 'image'],
                ['clean']
            ]
        }
    });
    const quillEdit = new Quill('#quill-edit-body', {
        theme: 'snow',
        placeholder: 'Tulis konten di sini...',
        modules: {
            toolbar: [
                [{ header: [1, 2, 3, false] }],
                ['bold', 'italic', 'underline', 'strike'],
                ['blockquote', 'code-block'],
                [{ list: 'ordered' }, { list: 'bullet' }],
                [{ 'align': [] }],
                ['link', 'image'],
                ['clean']
            ]
        }
    });

    // Edit modal logic
    [closeEditModal, cancelEditBtn].forEach(btn => {
        btn.addEventListener('click', function() {
            contentEditModal.classList.add('hidden');
        });
    });

    document.querySelectorAll('button[title="Edit"]').forEach(btn => {
        btn.addEventListener('click', function() {
            const id = btn.getAttribute('data-id');
            document.getElementById('edit-title').value = btn.getAttribute('data-title');
            document.getElementById('edit-type').value = btn.getAttribute('data-type');
            quillEdit.root.innerHTML = decodeHTMLEntities(btn.getAttribute('data-body'));
            document.getElementById('content-edit-form').action = `/content/${id}/edit`;
            contentEditModal.classList.remove('hidden');
        });
    });

    document.getElementById('content-edit-form').addEventListener('submit', function(e) {
        document.getElementById('edit-body').value = quillEdit.root.innerHTML;
    });

    function decodeHTMLEntities(text) {
        var txt = document.createElement('textarea');
        txt.innerHTML = text;
        return txt.value;
    }


    /* =========================
       QuillJS setup untuk Create & Edit
       ========================= */

    // Create modal logic
    createBtn.addEventListener('click', function() {
        document.getElementById('content-create-form').reset();
        quillCreate.setContents([]);
        contentCreateModal.classList.remove('hidden');
    });

    [closeCreateModal, cancelCreateBtn].forEach(btn => {
        btn.addEventListener('click', function() {
            contentCreateModal.classList.add('hidden');
        });
    });

    document.getElementById('content-create-form').addEventListener('submit', function(e) {
        document.getElementById('create-body').value = quillCreate.root.innerHTML;
    });

    // Edit modal logic
    [closeEditModal, cancelEditBtn].forEach(btn => {
        btn.addEventListener('click', function() {
            contentEditModal.classList.add('hidden');
        });
    });

    document.querySelectorAll('form.content-edit-form').forEach(form => {
        form.addEventListener('submit', function(e) {
            const hiddenInput = form.querySelector('.edit-body-hidden');
            const quillContainer = form.querySelector('.quill-edit-body');
            if (hiddenInput && quillContainer) {
                hiddenInput.value = quillEditInstances[quillContainer.id].root.innerHTML;
            }
        });
    });

    // Search functionality
    document.getElementById('search-input').addEventListener('input', function(e) {
        const searchTerm = e.target.value.toLowerCase();
        console.log('Searching for:', searchTerm);
    });

    function filterContents() {
        const searchTerm = document.getElementById('search-input').value.toLowerCase();
        const filterType = document.getElementById('type-filter').value;
        const filterAuthor = document.getElementById('author-filter').value;

        document.querySelectorAll('.content-row').forEach(row => {
            const title = row.getAttribute('data-title');
            const type = row.getAttribute('data-type');
            const author = row.getAttribute('data-author');

            let visible = true;

            if (searchTerm && !title.includes(searchTerm)) {
                visible = false;
            }
            if (filterType && type !== filterType) {
                visible = false;
            }
            if (filterAuthor && author !== filterAuthor) {
                visible = false;
            }

            row.style.display = visible ? '' : 'none';
        });
    }

    document.getElementById('search-input').addEventListener('input', filterContents);
    document.getElementById('type-filter').addEventListener('change', filterContents);
    document.getElementById('author-filter').addEventListener('change', filterContents);

    // Content type icon mapping for dynamic creation
    const typeIcons = {
        'artikel': { icon: 'fas fa-newspaper', color: 'from-blue-500 to-blue-600', badge: 'bg-blue-100 text-blue-800' },
        'quiz': { icon: 'fas fa-question-circle', color: 'from-green-500 to-green-600', badge: 'bg-green-100 text-green-800' },
        'poster': { icon: 'fas fa-image', color: 'from-amber-500 to-amber-600', badge: 'bg-amber-100 text-amber-800' },
        'event': { icon: 'fas fa-calendar-alt', color: 'from-purple-500 to-purple-600', badge: 'bg-purple-100 text-purple-800' },
        'map_asset': { icon: 'fas fa-map-marked-alt', color: 'from-teal-500 to-teal-600', badge: 'bg-teal-100 text-teal-800' },
        'submission': { icon: 'fas fa-file-upload', color: 'from-indigo-500 to-indigo-600', badge: 'bg-indigo-100 text-indigo-800' }
    };

    // Update content type styling based on selection
    document.getElementById('content-type').addEventListener('change', function(e) {
        const selectedType = e.target.value;
        if (selectedType && typeIcons[selectedType]) {
            console.log('Selected content type:', selectedType);
        }
    });

    // Quick actions for bulk operations
    function bulkDelete() {
        if (confirm('Apakah Anda yakin ingin menghapus semua konten yang dipilih?')) {
            console.log('Bulk delete confirmed');
        }
    }

    function exportContent() {
        console.log('Exporting content...');
    }

    // Keyboard shortcuts
    document.addEventListener('keydown', function(e) {
        if ((e.ctrlKey || e.metaKey) && e.key === 'n') {
            e.preventDefault();
            createBtn.click();
        }
        if (e.key === 'Escape') {
            contentCreateModal.classList.add('hidden');
            contentEditModal.classList.add('hidden');
            deleteModal.classList.add('hidden');
        }
    });

    // Auto-save draft functionality (placeholder)
    let draftTimer;
    function saveDraft() {
        const title = document.getElementById('title').value;
        const body = document.getElementById('body').value;
        const type = document.getElementById('content-type').value;

        if (title || body || type) {
            console.log('Auto-saving draft...');
        }
    }

    ['title', 'body', 'content-type'].forEach(id => {
        document.getElementById(id).addEventListener('input', function() {
            clearTimeout(draftTimer);
            draftTimer = setTimeout(saveDraft, 2000);
        });
    });
</script>

@endsection
