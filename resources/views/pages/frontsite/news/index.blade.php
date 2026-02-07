@extends('layouts.frontsite')

@section('activeMenuNews', 'active')

@section('title', 'Travel News & Blog - Travel Indonesia')

@section('meta_description', 'Read the latest travel news, tips, and stories from Indonesia. Stay updated with travel trends and destinations.')

@section('content')
<!-- Hero Section -->
<section class="hero-section" style="min-height: 50vh; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
    <div class="container">
        <div class="row align-items-center justify-content-center text-center">
            <div class="col-lg-8">
                <div class="hero-content animate-fade-in-up">
                    <h1 style="color: white; margin-bottom: 1rem;">Travel News & Blog</h1>
                    <p style="color: rgba(255, 255, 255, 0.95); font-size: 1.2rem;">
                        <center>Stay updated with the latest travel trends, tips, and destination guides</center>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- News Section -->
<section class="section-modern bg-white">
    <div class="container">
        <div class="row g-4">
            @forelse($blogs as $blog)
            <div class="col-xl-4 col-lg-6 col-md-6">
                <div class="card-modern">
                    <div class="card-modern-image">
                        <a href="{{ route('frontsite.news.show', $blog->slug) }}">
                            @if($blog->image)
                                @if(filter_var($blog->image, FILTER_VALIDATE_URL))
                                    {{-- Image is already a full URL --}}
                                    <img src="{{ $blog->image }}" alt="{{ $blog->title }}" loading="lazy">
                                @elseif(file_exists(storage_path('app/public/' . $blog->image)))
                                    {{-- Image is a relative path --}}
                                    <img src="{{ asset('storage/' . $blog->image) }}" alt="{{ $blog->title }}" loading="lazy">
                                @else
                                    {{-- Fallback image --}}
                                    <img src="{{ asset('frontsite-assets/img/packages/' . (($loop->index % 13) + 1) . '.jpg') }}" alt="{{ $blog->title }}" loading="lazy">
                                @endif
                            @else
                                {{-- No image, use fallback --}}
                                <img src="{{ asset('frontsite-assets/img/packages/' . (($loop->index % 13) + 1) . '.jpg') }}" alt="{{ $blog->title }}" loading="lazy">
                            @endif
                        </a>
                        <div class="card-modern-badge" style="background: rgba(102, 126, 234, 0.95); color: white;">
                            <i class="bi bi-calendar3 me-1"></i>{{ \Carbon\Carbon::parse($blog->created_at)->format('M d, Y') }}
                        </div>
                    </div>
                    <div class="card-modern-content">
                        <h3 class="card-modern-title">
                            <a href="{{ route('frontsite.news.show', $blog->slug) }}">{{ $blog->title }}</a>
                        </h3>
                        <p class="card-modern-text" style="color: #64748b; line-height: 1.6; margin-bottom: 1rem;">{{ Str::limit(strip_tags($blog->description), 120) }}</p>
                        <div class="mt-auto">
                            <a href="{{ route('frontsite.news.show', $blog->slug) }}" 
                               class="btn-modern btn-modern-primary" 
                               style="padding: 0.75rem 1.5rem; width: 100%;">
                                Read More
                                <i class="bi bi-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="text-center py-5">
                    <div class="mb-4">
                        <i class="bi bi-inbox" style="font-size: 5rem; color: #cbd5e1;"></i>
                    </div>
                    <h4 style="color: #334155; font-weight: 700; margin-bottom: 15px;">No news articles found</h4>
                    <p style="color: #64748b; margin-bottom: 25px;">Please check back later for the latest travel news and updates.</p>
                </div>
            </div>
            @endforelse
        </div>
        
        @if($blogs->hasPages())
        <div class="row mt-5">
            <div class="col-12">
                <nav aria-label="News pagination">
                    <ul class="pagination justify-content-center gap-2">
                        {{-- Previous Page Link --}}
                        @if ($blogs->onFirstPage())
                            <li class="page-item disabled">
                                <span class="page-link" style="border-radius: 0.75rem; border: 2px solid #e2e8f0; background: white; color: #94a3b8; padding: 0.75rem 1rem;">
                                    <i class="bi bi-chevron-left"></i>
                                </span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $blogs->previousPageUrl() }}" style="border-radius: 0.75rem; border: 2px solid #667eea; background: white; color: #667eea; padding: 0.75rem 1rem; transition: all 0.3s;">
                                    <i class="bi bi-chevron-left"></i>
                                </a>
                            </li>
                        @endif

                        {{-- Pagination Elements --}}
                        @foreach ($blogs->links()->elements[0] as $page => $url)
                            @if ($page == $blogs->currentPage())
                                <li class="page-item active">
                                    <span class="page-link" style="border-radius: 0.75rem; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none; color: white; padding: 0.75rem 1rem; min-width: 45px; text-align: center;">
                                        {{ $page }}
                                    </span>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link" href="{{ $url }}" style="border-radius: 0.75rem; border: 2px solid #e2e8f0; background: white; color: #475569; padding: 0.75rem 1rem; min-width: 45px; text-align: center; transition: all 0.3s;">
                                        {{ $page }}
                                    </a>
                                </li>
                            @endif
                        @endforeach

                        {{-- Next Page Link --}}
                        @if ($blogs->hasMorePages())
                            <li class="page-item">
                                <a class="page-link" href="{{ $blogs->nextPageUrl() }}" style="border-radius: 0.75rem; border: 2px solid #667eea; background: white; color: #667eea; padding: 0.75rem 1rem; transition: all 0.3s;">
                                    <i class="bi bi-chevron-right"></i>
                                </a>
                            </li>
                        @else
                            <li class="page-item disabled">
                                <span class="page-link" style="border-radius: 0.75rem; border: 2px solid #e2e8f0; background: white; color: #94a3b8; padding: 0.75rem 1rem;">
                                    <i class="bi bi-chevron-right"></i>
                                </span>
                            </li>
                        @endif
                    </ul>
                </nav>
            </div>
        </div>
        @endif
    </div>
</section>
@endsection

@push('after-style')
<style>
/* Pagination Hover Effects */
.pagination .page-link:hover {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
    color: white !important;
    border-color: #667eea !important;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
}

.pagination .page-item.disabled .page-link:hover {
    transform: none;
    box-shadow: none;
    background: white !important;
    color: #94a3b8 !important;
}

.pagination .page-item.active .page-link {
    box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
}
</style>
@endpush