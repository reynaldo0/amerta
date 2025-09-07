@extends('layouts.app')

@section('breadcrumb', 'Pesan Masuk')
@section('content')
    <div class="min-h-screen bg-gradient-to-br from-orange-50 via-yellow-50 to-amber-50 cultural-pattern">
        <!-- Header -->
        <div class="bg-white shadow-sm border-b-2 border-amerta-accent/20 mb-8">
            <div class="max-w-7xl mx-auto px-4 py-6">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <div class="bg-gradient-to-r from-amerta-primary to-amerta-secondary p-3 rounded-xl">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2 2v-5m16 0h-2M4 13h2m-2 0l3-3m0 0l3 3M4 10h16" />
                            </svg>
                        </div>
                        <div>
                            <h1 class="text-3xl font-bold text-amerta-dark">Admin Inbox</h1>
                            <p class="text-amerta-secondary">Panel Review Kontribusi Budaya Nusantara</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-4">
                        <div class="bg-amerta-accent/20 px-4 py-2 rounded-lg">
                            <span class="text-amerta-dark font-semibold" id="totalSubmissions">25 Total Submission</span>
                        </div>
                        <button
                            class="bg-gradient-to-r from-amerta-primary to-amerta-secondary text-white px-4 py-2 rounded-lg hover:shadow-lg transition-all duration-300">
                            <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            Settings
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 pb-8">
            <!-- Filter and Stats Section -->
            <div class="mb-8">
                <div class="bg-white rounded-2xl shadow-lg p-6 border border-amerta-accent/20">
                    <!-- Stats Cards -->
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                        <div class="bg-gradient-to-br from-blue-50 to-blue-100 p-4 rounded-xl border border-blue-200">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-blue-600 text-sm font-medium">Pending Review</p>
                                    <p class="text-2xl font-bold text-blue-800" id="pendingCount">12</p>
                                </div>
                                <div class="bg-blue-500 p-2 rounded-lg">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <div class="bg-gradient-to-br from-green-50 to-green-100 p-4 rounded-xl border border-green-200">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-green-600 text-sm font-medium">Approved</p>
                                    <p class="text-2xl font-bold text-green-800" id="approvedCount">8</p>
                                </div>
                                <div class="bg-green-500 p-2 rounded-lg">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <div class="bg-gradient-to-br from-red-50 to-red-100 p-4 rounded-xl border border-red-200">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-red-600 text-sm font-medium">Rejected</p>
                                    <p class="text-2xl font-bold text-red-800" id="rejectedCount">3</p>
                                </div>
                                <div class="bg-red-500 p-2 rounded-lg">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <div
                            class="bg-gradient-to-br from-amerta-accent/20 to-amerta-accent/30 p-4 rounded-xl border border-amerta-accent">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-amerta-dark text-sm font-medium">Under Review</p>
                                    <p class="text-2xl font-bold text-amerta-dark" id="reviewCount">2</p>
                                </div>
                                <div class="bg-amerta-secondary p-2 rounded-lg">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Filters -->
                    <div class="flex flex-wrap items-center gap-4">
                        <div class="flex items-center space-x-2">
                            <label class="text-amerta-dark font-medium">Filter Status:</label>
                            <select id="statusFilter"
                                class="border border-amerta-accent/30 rounded-lg px-3 py-2 focus:border-amerta-secondary focus:ring-0 text-sm">
                                <option value="all">Semua Status</option>
                                <option value="pending">Pending Review</option>
                                <option value="approved">Approved</option>
                                <option value="rejected">Rejected</option>
                                <option value="reviewing">Under Review</option>
                            </select>
                        </div>

                        <div class="flex items-center space-x-2">
                            <label class="text-amerta-dark font-medium">Kategori:</label>
                            <select id="categoryFilter"
                                class="border border-amerta-accent/30 rounded-lg px-3 py-2 focus:border-amerta-secondary focus:ring-0 text-sm">
                                <option value="all">Semua Kategori</option>
                                <option value="budaya-tradisional">Budaya Tradisional</option>
                                <option value="tarian-daerah">Tarian Daerah</option>
                                <option value="makanan-khas">Makanan Khas</option>
                                <option value="pakaian-adat">Pakaian Adat</option>
                                <option value="rumah-adat">Rumah Adat</option>
                                <option value="bahasa-daerah">Bahasa Daerah</option>
                                <option value="upacara-adat">Upacara Adat</option>
                            </select>
                        </div>

                        <div class="flex items-center space-x-2">
                            <input type="text" id="searchInput" placeholder="Cari nama, email, atau daerah..."
                                class="border border-amerta-accent/30 rounded-lg px-4 py-2 focus:border-amerta-secondary focus:ring-0 text-sm w-64">
                            <button
                                class="bg-amerta-secondary text-white p-2 rounded-lg hover:bg-amerta-primary transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Submissions Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="submissionsGrid">
                @foreach ($mails as $mail)
                    <div
                        class="form-card bg-white rounded-2xl shadow-lg hover:shadow-xl border border-amerta-accent/20 overflow-hidden transition-all duration-300 hover:transform hover:-translate-y-1">
                        <div class="p-6">
                            <div class="flex items-start justify-between mb-4">
                                <div class="flex items-start space-x-4">
                                    <div
                                        class="bg-gradient-to-r from-amerta-primary to-amerta-secondary p-3 rounded-xl text-white">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <h3 class="text-xl font-bold text-amerta-dark mb-1">{{ $mail->name }}</h3>
                                        <p class="text-amerta-secondary text-sm mb-2">{{ $mail->email }}</p>
                                        <div class="flex items-center space-x-4 text-sm">
                                            <span class="flex items-center text-amerta-primary">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                                </svg>
                                                {{ $mail->address }}
                                            </span>
                                            <span class="flex items-center text-gray-500">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                                {{ $mail->created_at->diffForHumans() }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Media Preview -->
                            <div class="mb-4">
                                <h4 class="font-semibold text-amerta-dark mb-2">Media</h4>
                                @if ($mail->media)
                                    @if (Str::endsWith($mail->media, ['.jpg', '.jpeg', '.png', '.gif']))
                                        <img src="{{ Storage::url($mail->media) }}" alt="media"
                                            class="rounded-lg shadow max-h-40 object-cover">
                                    @else
                                        <a href="{{ $mail->media }}" target="_blank"
                                            class="text-amerta-primary underline">Lihat Media</a>
                                    @endif
                                @else
                                    <p class="text-sm text-gray-500">Belum ada media</p>
                                @endif
                            </div>

                            <!-- Footer -->
                            <div class="flex justify-between items-center pt-4 border-t border-gray-200">
                                <div class="text-sm text-gray-500">
                                    ID: #SUB-{{ str_pad($mail->id, 3, '0', STR_PAD_LEFT) }}
                                </div>
                                <div class="flex space-x-2">
                                    <button onclick="openReviewModal('submission-{{ $mail->id }}')"
                                        class="bg-amerta-primary text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-amerta-secondary transition">
                                        Lihat Detail
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Review Detail Modal -->
        <div id="reviewModal"
            class="fixed inset-0 bg-black/50 backdrop-blur-sm hidden z-50 flex items-center justify-center p-4">
            <div class="bg-white rounded-2xl shadow-2xl max-w-4xl w-full max-h-[95vh] overflow-hidden">
                <!-- Modal Header -->
                <div class="bg-gradient-to-r from-amerta-primary to-amerta-secondary p-6 text-white">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <svg class="w-8 h-8 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                            <div>
                                <h3 class="text-2xl font-bold">Review Detail Submission</h3>
                                <p class="text-white/90 text-sm" id="modalSubmissionId"></p>
                            </div>
                        </div>
                        <button onclick="closeReviewModal()" class="text-white/80 hover:text-white transition-colors">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Modal Body -->
                <div class="p-6 overflow-y-auto max-h-[calc(95vh-200px)] custom-scrollbar">
                    <!-- Contributor Info -->
                    <div class="bg-gradient-to-r from-amerta-accent/10 to-transparent rounded-xl p-6 mb-6 border border-amerta-accent/20">
                        <h4 class="text-lg font-bold text-amerta-dark mb-4">Informasi Kontributor</h4>
                        <div class="grid md:grid-cols-2 gap-4">
                            <div>
                                <label class="text-sm font-medium text-gray-600">Nama Lengkap</label>
                                <p class="text-amerta-dark font-semibold" id="modalContributorName"></p>
                            </div>
                            <div>
                                <label class="text-sm font-medium text-gray-600">Email</label>
                                <p class="text-amerta-dark" id="modalContributorEmail"></p>
                            </div>
                            <div>
                                <label class="text-sm font-medium text-gray-600">Asal Daerah</label>
                                <p class="text-amerta-dark" id="modalContributorRegion"></p>
                            </div>
                            <div>
                                <label class="text-sm font-medium text-gray-600">Tanggal Submit</label>
                                <p class="text-amerta-dark" id="modalSubmitDate"></p>
                            </div>
                        </div>
                    </div>

                    <!-- Contribution Details -->
                    <div class="bg-white rounded-xl p-6 mb-6 border border-gray-200">
                        <h4 class="text-lg font-bold text-amerta-dark mb-4">Detail Kontribusi</h4>
                        {{-- <div class="mb-4">
                            <label class="text-sm font-medium text-gray-600">Kategori</label>
                            <div class="mt-1">
                                <span class="bg-amerta-accent text-amerta-dark px-3 py-1 rounded-full text-sm font-medium"
                                    id="modalCategory"></span>
                            </div>
                        </div> --}}
                        <div class="mb-4">
                            <label class="text-sm font-medium text-gray-600">Fitur yang Diinginkan</label>
                            <div class="mt-2 flex flex-wrap gap-2" id="modalFeatures"></div>
                        </div>
                        <div class="mb-4">
                            <label class="text-sm font-medium text-gray-600">Deskripsi Kontribusi</label>
                            <div class="mt-2 bg-gray-50 rounded-lg p-4">
                                <p class="text-gray-700 leading-relaxed" id="modalDescription"></p>
                            </div>
                        </div>
                        <div class="mb-4">
                            <label class="text-sm font-medium text-gray-600">Pengalaman Relevan</label>
                            <div class="mt-2 bg-gray-50 rounded-lg p-4">
                                <p class="text-gray-700 leading-relaxed" id="modalExperience"></p>
                            </div>
                        </div>
                    </div>

                    <!-- Media Files -->
                    <div class="bg-white rounded-xl p-6 mb-6 border border-gray-200">
                        <h4 class="text-lg font-bold text-amerta-dark mb-4">Media Terlampir</h4>
                        <div id="modalMediaFiles" class="grid md:grid-cols-3 gap-4"></div>
                    </div>

                    <!-- Admin Review Section -->
                    {{-- <div class="bg-amerta-accent/10 rounded-xl p-6 border border-amerta-accent/20">
                        <h4 class="text-lg font-bold text-amerta-dark mb-4">Review Admin</h4>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                            <select id="modalStatus" onchange="updateModalStatus()"
                                class="w-full border border-amerta-accent/30 rounded-lg px-4 py-2 focus:border-amerta-secondary focus:ring-0">
                                <option value="pending">Pending Review</option>
                                <option value="reviewing">Under Review</option>
                                <option value="approved">Approved</option>
                                <option value="rejected">Rejected</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Catatan/Feedback</label>
                            <textarea id="modalFeedback" rows="4"
                                class="w-full border border-amerta-accent/30 rounded-lg px-4 py-3 focus:border-amerta-secondary focus:ring-0 resize-none"
                                placeholder="Berikan feedback atau catatan untuk kontributor..."></textarea>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Priority Level</label>
                            <select id="modalPriority"
                                class="w-full border border-amerta-accent/30 rounded-lg px-4 py-2 focus:border-amerta-secondary focus:ring-0">
                                <option value="low">Low Priority</option>
                                <option value="medium">Medium Priority</option>
                                <option value="high">High Priority</option>
                                <option value="urgent">Urgent</option>
                            </select>
                        </div>

                        <div class="flex justify-end space-x-3">
                            <button onclick="closeReviewModal()"
                                class="px-6 py-3 text-gray-600 bg-gray-200 hover:bg-gray-300 rounded-lg transition-colors font-medium">
                                Batal
                            </button>
                            <button onclick="saveReview()"
                                class="px-6 py-3 bg-gradient-to-r from-amerta-primary to-amerta-secondary hover:from-amerta-dark hover:to-amerta-primary text-white rounded-lg transition-all duration-200 font-semibold shadow-lg">
                                💾 Simpan Review
                            </button>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>

    <style>
        .cultural-pattern {
            background-image:
                radial-gradient(circle at 25% 25%, rgba(139, 69, 19, 0.1) 2px, transparent 2px),
                radial-gradient(circle at 75% 75%, rgba(210, 105, 30, 0.1) 2px, transparent 2px);
            background-size: 20px 20px;
        }

        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 3px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #D2691E;
            border-radius: 3px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #8B4513;
        }
    </style>

    <script>
        // Filter functionality
        document.getElementById('statusFilter').addEventListener('change', filterSubmissions);
        document.getElementById('categoryFilter').addEventListener('change', filterSubmissions);
        document.getElementById('searchInput').addEventListener('input', filterSubmissions);

        function filterSubmissions() {
            const statusFilter = document.getElementById('statusFilter').value;
            const categoryFilter = document.getElementById('categoryFilter').value;
            const searchTerm = document.getElementById('searchInput').value.toLowerCase();

            const cards = document.querySelectorAll('.form-card');

            cards.forEach(card => {
                const status = card.dataset.status;
                const category = card.dataset.category;
                const text = card.textContent.toLowerCase();

                const statusMatch = statusFilter === 'all' || status === statusFilter;
                const categoryMatch = categoryFilter === 'all' || category === categoryFilter;
                const searchMatch = searchTerm === '' || text.includes(searchTerm);

                if (statusMatch && categoryMatch && searchMatch) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        }

        // Modal functionality
        // Make sure mails data is available globally
        window.mails = @json($mails);

        function openReviewModal(submissionId) {
            // submissionId is like 'submission-8', get the numeric id
            const id = submissionId.replace('submission-', '');
            if (!window.mails) {
                alert('Data tidak tersedia');
                return;
            }
            const mail = window.mails.find(m => m.id == id);
            if (!mail) {
                alert('Data tidak ditemukan');
                return;
            }

            document.getElementById('modalSubmissionId').textContent = `ID: #SUB-${String(mail.id).padStart(3, '0')}`;
            document.getElementById('modalContributorName').textContent = mail.name || '';
            document.getElementById('modalContributorEmail').textContent = mail.email || '';
            document.getElementById('modalContributorRegion').textContent = mail.address || '';
            document.getElementById('modalSubmitDate').textContent = mail.created_at ? new Date(mail.created_at).toLocaleString('id-ID') : '';
            // document.getElementById('modalCategory').textContent = mail.category || '';

            // Features
            const featuresContainer = document.getElementById('modalFeatures');
            featuresContainer.innerHTML = '';
            if (mail.features && Array.isArray(mail.features)) {
                mail.features.forEach(f => {
                    const span = document.createElement('span');
                    span.className = 'bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm';
                    span.textContent = f;
                    featuresContainer.appendChild(span);
                });
            }

            document.getElementById('modalDescription').textContent = mail.description || '';
            document.getElementById('modalExperience').textContent = mail.story || '';

            // Media files
            const mediaFilesContainer = document.getElementById('modalMediaFiles');
            mediaFilesContainer.innerHTML = '';
            if (mail.media_files && Array.isArray(mail.media_files)) {
                mail.media_files.forEach(file => {
                    let url = '/storage/' + file.url.replace(/^\/?storage\//, '');
                    let html = '';
                    if (/\.(jpg|jpeg|png|gif)$/i.test(file.url)) {
                        html = `<div class="bg-gray-100 rounded-lg p-4 aspect-square flex items-center justify-center">
                            <div class="text-center">
                                <img src="${url}" alt="${file.name}" class="rounded-lg shadow max-h-40 object-cover mb-2">
                                <p class="text-xs text-gray-500">${file.size}</p>
                            </div>
                        </div>`;
                    } else {
                        html = `<div class="bg-gray-100 rounded-lg p-4 aspect-square flex items-center justify-center">
                            <div class="text-center">
                                <a href="${url}" target="_blank" class="text-amerta-primary underline">${file.name}</a>
                                <p class="text-xs text-gray-500">${file.size}</p>
                            </div>
                        </div>`;
                    }
                    mediaFilesContainer.innerHTML += html;
                });
            } else if (mail.media) {
                let url = '/storage/' + mail.media.replace(/^\/?storage\//, '');
                let html = '';
                if (/\.(jpg|jpeg|png|gif)$/i.test(mail.media)) {
                    html = `<div class="bg-gray-100 rounded-lg p-4 aspect-square flex items-center justify-center">
                        <div class="text-center">
                            <img src="${url}" alt="media" class="rounded-lg shadow max-h-40 object-cover mb-2">
                        </div>
                    </div>`;
                } else {
                    html = `<div class="bg-gray-100 rounded-lg p-4 aspect-square flex items-center justify-center">
                        <div class="text-center">
                            <a href="${url}" target="_blank" class="text-amerta-primary underline">Lihat Media</a>
                        </div>
                    </div>`;
                }
                mediaFilesContainer.innerHTML = html;
            }

            document.getElementById('reviewModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeReviewModal() {
            document.getElementById('reviewModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        function updateStatus(submissionId, newStatus) {
            console.log(`Updating ${submissionId} to ${newStatus}`);

            const card = document.querySelector(`[onclick*="${submissionId}"]`).closest('.form-card');
            const statusBadge = card.querySelector('.status-badge');

            card.dataset.status = newStatus;

            const statusConfig = {
                pending: {
                    class: 'bg-yellow-100 text-yellow-800',
                    text: 'Pending Review'
                },
                reviewing: {
                    class: 'bg-blue-100 text-blue-800',
                    text: 'Under Review'
                },
                approved: {
                    class: 'bg-green-100 text-green-800',
                    text: 'Approved ✓'
                },
                rejected: {
                    class: 'bg-red-100 text-red-800',
                    text: 'Rejected ✕'
                }
            };

            const config = statusConfig[newStatus];
            statusBadge.className =
                `status-badge ${config.class} px-3 py-1 rounded-full text-xs font-semibold transition-all duration-300`;
            statusBadge.textContent = config.text;

            updateStats();
        }

        function updateModalStatus() {
            const status = document.getElementById('modalStatus').value;
            console.log('Modal status updated to:', status);
        }

        function saveReview() {
            const status = document.getElementById('modalStatus').value;
            const feedback = document.getElementById('modalFeedback').value;
            const priority = document.getElementById('modalPriority').value;

            console.log('Saving review:', {
                status,
                feedback,
                priority
            });

            alert('Review berhasil disimpan!');
            closeReviewModal();
        }

        function updateStats() {
            const cards = document.querySelectorAll('.form-card');
            let pending = 0,
                approved = 0,
                rejected = 0,
                reviewing = 0;

            cards.forEach(card => {
                const status = card.dataset.status;
                switch (status) {
                    case 'pending':
                        pending++;
                        break;
                    case 'approved':
                        approved++;
                        break;
                    case 'rejected':
                        rejected++;
                        break;
                    case 'reviewing':
                        reviewing++;
                        break;
                }
            });

            document.getElementById('pendingCount').textContent = pending;
            document.getElementById('approvedCount').textContent = approved;
            document.getElementById('rejectedCount').textContent = rejected;
            document.getElementById('reviewCount').textContent = reviewing;
            document.getElementById('totalSubmissions').textContent =
                `${pending + approved + rejected + reviewing} Total Submission`;
        }

        // Close modal when clicking outside
        document.addEventListener('click', function(e) {
            if (e.target.id === 'reviewModal') {
                closeReviewModal();
            }
        });

        // Handle escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeReviewModal();
            }
        });

        // Initialize stats on page load
        document.addEventListener('DOMContentLoaded', updateStats);
    </script>

    {{-- Example: window.mails = @json($mails); --}}
    {{-- Add this after your <script> tag if not already present --}}
@endsection