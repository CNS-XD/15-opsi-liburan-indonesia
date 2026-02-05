@extends('layouts.frontsite')

@section('activeMenuNews', 'active')

@section('title', $blog->title . ' - Travel News')

@section('meta_description', Str::limit(strip_tags($blog->description), 160))

@section('content')
<!-- Breadcrumb Section -->
<div class="breadcrumb-section" style="background-image: linear-gradient(270deg, rgba(0, 0, 0, .3), rgba(0, 0, 0, 0.3) 101.02%), url('{{ ($blog->image && file_exists(storage_path('app/public/' . $blog->image))) ? asset('storage/' . $blog->image) : asset('frontsite-assets/img/packages/1.jpg') }}');">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 d-flex justify-content-center">
                <div class="banner-content">
                    <h1>{{ $blog->title }}</h1>
                    <ul class="breadcrumb-list">
                        <li><a href="{{ route('frontsite.home.index') }}">Home</a></li>
                        <li><a href="{{ route('frontsite.news.index') }}">News</a></li>
                        <li>{{ Str::limit($blog->title, 30) }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Blog Details Section -->
<div class="blog-details-section pt-120 pb-120">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="blog-details-content">
                    <div class="blog-details-img">
                        @if($blog->image && file_exists(storage_path('app/public/' . $blog->image)))
                        <img src="{{ asset('storage/' . $blog->image) }}" alt="{{ $blog->title }}">
                        @else
                        <img src="{{ asset('frontsite-assets/img/packages/1.jpg') }}" alt="{{ $blog->title }}">
                        @endif
                    </div>
                    <div class="blog-details-text">
                        <div class="blog-meta">
                            <span class="blog-date">
                                <i class="bi bi-calendar3"></i>
                                {{ \Carbon\Carbon::parse($blog->created_at)->format('F d, Y') }}
                            </span>
                            @if($blog->created_by)
                            <span class="blog-author">
                                <i class="bi bi-person"></i>
                                {{ $blog->created_by }}
                            </span>
                            @endif
                        </div>
                        <h2>{{ $blog->title }}</h2>
                        <div class="blog-content">
                            {!! $blog->description !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="blog-sidebar">
                    <!-- Related Posts -->
                    @if($relatedBlogs->count() > 0)
                    <div class="sidebar-widget">
                        <h4>Related Articles</h4>
                        <div class="related-posts">
                            @foreach($relatedBlogs as $relatedBlog)
                            <div class="related-post-item">
                                <div class="related-post-img">
                                    @if($relatedBlog->image && file_exists(storage_path('app/public/' . $relatedBlog->image)))
                                    <img src="{{ asset('storage/' . $relatedBlog->image) }}" alt="{{ $relatedBlog->title }}">
                                    @else
                                    <img src="{{ asset('frontsite-assets/img/packages/' . (($loop->index % 13) + 1) . '.jpg') }}" alt="{{ $relatedBlog->title }}">
                                    @endif
                                </div>
                                <div class="related-post-content">
                                    <span class="related-post-date">{{ \Carbon\Carbon::parse($relatedBlog->created_at)->format('M d, Y') }}</span>
                                    <h6><a href="{{ route('frontsite.news.show', $relatedBlog->id) }}">{{ Str::limit($relatedBlog->title, 50) }}</a></h6>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                    
                    <!-- Back to News -->
                    <div class="sidebar-widget">
                        <div class="back-to-news">
                            <a href="{{ route('frontsite.news.index') }}" class="back-btn">
                                <i class="bi bi-arrow-left"></i>
                                Back to News
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection