@extends('layouts.frontsite')

@section('activeMenuNews', 'active')

@section('title', 'Travel News & Blog - Travel Indonesia')

@section('meta_description', 'Read the latest travel news, tips, and stories from Indonesia. Stay updated with travel trends and destinations.')

@section('content')
<!-- Breadcrumb Section -->
<div class="breadcrumb-section" style="background-image: linear-gradient(270deg, rgba(0, 0, 0, .3), rgba(0, 0, 0, 0.3) 101.02%), url('{{ asset('frontsite-assets/img/innerpages/destination-card4-img4.jpg') }}');">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 d-flex justify-content-center">
                <div class="banner-content">
                    <h1>Travel News & Blog</h1>
                    <ul class="breadcrumb-list">
                        <li><a href="{{ route('frontsite.home.index') }}">Home</a></li>
                        <li>News</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- News Section -->
<div class="news-section pt-120 pb-120">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-head">
                    <h2>Latest Travel News</h2>
                    <p>Stay updated with the latest travel trends, tips, and destination guides</p>
                </div>
            </div>
        </div>
        <div class="row g-4">
            @forelse($blogs as $blog)
            <div class="col-xl-4 col-lg-6 col-md-6">
                <div class="news-card">
                    <div class="news-img">
                        @if($blog->image && file_exists(storage_path('app/public/' . $blog->image)))
                        <img src="{{ asset('storage/' . $blog->image) }}" alt="{{ $blog->title }}">
                        @else
                        <img src="{{ asset('frontsite-assets/img/packages/' . (($loop->index % 13) + 1) . '.jpg') }}" alt="{{ $blog->title }}">
                        @endif
                        <div class="news-overlay">
                            <a href="{{ route('frontsite.news.show', $blog->id) }}" class="news-btn">
                                <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                    <div class="news-content">
                        <div class="news-meta">
                            <span class="news-date">
                                <i class="bi bi-calendar3"></i>
                                {{ \Carbon\Carbon::parse($blog->created_at)->format('M d, Y') }}
                            </span>
                        </div>
                        <h5><a href="{{ route('frontsite.news.show', $blog->id) }}">{{ $blog->title }}</a></h5>
                        <p>{{ Str::limit(strip_tags($blog->content), 120) }}</p>
                        <div class="news-footer">
                            <a href="{{ route('frontsite.news.show', $blog->id) }}" class="read-more-btn">
                                Read More <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="text-center py-5">
                    <h4>No news articles found</h4>
                    <p>Please check back later for the latest travel news and updates.</p>
                </div>
            </div>
            @endforelse
        </div>
        
        @if($blogs->hasPages())
        <div class="row">
            <div class="col-lg-12">
                <div class="pagination-area">
                    {{ $blogs->links() }}
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection