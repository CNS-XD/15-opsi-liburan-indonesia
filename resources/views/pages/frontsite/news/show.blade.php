@extends('layouts.frontsite')

@section('activeMenuNews', 'active')

@section('title', $blog->title . ' - Travel News')

@section('meta_description', Str::limit(strip_tags($blog->description), 160))

@section('content')
<!-- Hero Section -->
<section class="hero-section" style="min-height: 40vh; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 80px 0;">
    <div class="container">
        <div class="row align-items-center justify-content-center text-center">
            <div class="col-lg-10">
                <div class="hero-content animate-fade-in-up">
                    <div class="mb-3">
                        <a href="{{ route('frontsite.news.index') }}" style="color: rgba(255, 255, 255, 0.9); text-decoration: none; font-size: 0.95rem; transition: all 0.3s; display: inline-flex; align-items: center; gap: 0.5rem;">
                            <i class="bi bi-arrow-left"></i>Back to News
                        </a>
                    </div>
                    <h1 style="color: white; margin-bottom: 1.5rem; font-size: 2.5rem; line-height: 1.3; font-weight: 700;">{{ $blog->title }}</h1>
                    <div style="display: flex; align-items: center; justify-content: center; gap: 2rem; flex-wrap: wrap;">
                        <span style="color: rgba(255, 255, 255, 0.95); font-size: 1rem;">
                            <i class="bi bi-calendar3 me-2"></i>{{ \Carbon\Carbon::parse($blog->created_at)->format('F d, Y') }}
                        </span>
                        @if($blog->created_by)
                        <span style="color: rgba(255, 255, 255, 0.95); font-size: 1rem;">
                            <i class="bi bi-person me-2"></i>{{ $blog->created_by }}
                        </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Blog Details Section -->
<section style="padding: 80px 0; background: #f8fafc;">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-8">
                <div style="background: white; border-radius: 1.5rem; overflow: hidden; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);">
                    <div style="padding: 0 1.5rem 3rem 1.5rem;">
                        <div class="blog-content" style="color: #475569; font-size: 1.05rem; line-height: 1.8;">
                            {!! $blog->description !!}
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4">
                <!-- Related Posts -->
                @if($relatedBlogs->count() > 0)
                <div style="background: white; border-radius: 1.5rem; padding: 2rem; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08); margin-bottom: 1.5rem;">
                    <h4 style="color: #1e293b; font-weight: 700; margin-bottom: 1.5rem; font-size: 1.5rem;">
                        <i class="bi bi-newspaper me-2" style="color: #667eea;"></i>Related Articles
                    </h4>
                    <div style="display: flex; flex-direction: column; gap: 1.5rem;">
                        @foreach($relatedBlogs as $relatedBlog)
                        <a href="{{ route('frontsite.news.show', $relatedBlog->slug) }}" style="text-decoration: none; display: flex; gap: 1rem; padding: 1rem; border-radius: 0.75rem; background: #f8fafc; transition: all 0.3s;" class="related-post-link">
                            <div style="width: 100px; height: 80px; border-radius: 0.5rem; overflow: hidden; flex-shrink: 0;">
                                @if($relatedBlog->image)
                                    @if(filter_var($relatedBlog->image, FILTER_VALIDATE_URL))
                                        <img src="{{ $relatedBlog->image }}" alt="{{ $relatedBlog->title }}" style="width: 100%; height: 100%; object-fit: cover;">
                                    @elseif(file_exists(storage_path('app/public/' . $relatedBlog->image)))
                                        <img src="{{ asset('storage/' . $relatedBlog->image) }}" alt="{{ $relatedBlog->title }}" style="width: 100%; height: 100%; object-fit: cover;">
                                    @else
                                        <img src="{{ asset('frontsite-assets/img/packages/' . (($loop->index % 13) + 1) . '.jpg') }}" alt="{{ $relatedBlog->title }}" style="width: 100%; height: 100%; object-fit: cover;">
                                    @endif
                                @else
                                    <img src="{{ asset('frontsite-assets/img/packages/' . (($loop->index % 13) + 1) . '.jpg') }}" alt="{{ $relatedBlog->title }}" style="width: 100%; height: 100%; object-fit: cover;">
                                @endif
                            </div>
                            <div style="flex: 1; display: flex; flex-direction: column; justify-content: center;">
                                <span style="color: #667eea; font-size: 0.85rem; margin-bottom: 0.25rem;">
                                    <i class="bi bi-calendar3 me-1"></i>{{ \Carbon\Carbon::parse($relatedBlog->created_at)->format('M d, Y') }}
                                </span>
                                <h6 style="color: #1e293b; font-weight: 600; margin: 0; line-height: 1.4; font-size: 0.95rem;">{{ Str::limit($relatedBlog->title, 60) }}</h6>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif
                
                <!-- Back to News Button -->
                <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 1.5rem; padding: 2rem; text-align: center; box-shadow: 0 4px 20px rgba(102, 126, 234, 0.3);">
                    <a href="{{ route('frontsite.news.index') }}" style="color: white; text-decoration: none; display: flex; align-items: center; justify-content: center; gap: 0.5rem; font-weight: 600; font-size: 1.1rem;">
                        <i class="bi bi-arrow-left"></i>
                        Back to All News
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('after-style')
<style>
/* Related Post Hover Effect */
.related-post-link:hover {
    background: white !important;
    box-shadow: 0 4px 15px rgba(102, 126, 234, 0.15);
    transform: translateX(5px);
}

/* Blog Content Styling */
.blog-content h1, .blog-content h2, .blog-content h3, .blog-content h4, .blog-content h5, .blog-content h6 {
    color: #1e293b;
    font-weight: 700;
    margin-top: 2rem;
    margin-bottom: 1rem;
}

.blog-content h1 { font-size: 2rem; }
.blog-content h2 { font-size: 1.75rem; }
.blog-content h3 { font-size: 1.5rem; }
.blog-content h4 { font-size: 1.25rem; }

.blog-content p {
    margin-bottom: 1.5rem;
}

.blog-content img {
    max-width: 100%;
    height: auto;
    border-radius: 0.75rem;
    margin: 1.5rem 0;
}

.blog-content ul, .blog-content ol {
    margin-bottom: 1.5rem;
    padding-left: 2rem;
}

.blog-content li {
    margin-bottom: 0.5rem;
}

.blog-content a {
    color: #667eea;
    text-decoration: underline;
    transition: all 0.3s;
}

.blog-content a:hover {
    color: #764ba2;
}

.blog-content blockquote {
    border-left: 4px solid #667eea;
    padding-left: 1.5rem;
    margin: 2rem 0;
    font-style: italic;
    color: #64748b;
    background: #f8fafc;
    padding: 1.5rem;
    border-radius: 0.5rem;
}

.blog-content strong {
    font-weight: 700;
    color: #1e293b;
}

.blog-content em {
    font-style: italic;
}

.blog-content code {
    background: #f1f5f9;
    padding: 0.2rem 0.5rem;
    border-radius: 0.25rem;
    font-family: 'Courier New', monospace;
    font-size: 0.9em;
    color: #667eea;
}

.blog-content pre {
    background: #1e293b;
    color: #f8fafc;
    padding: 1.5rem;
    border-radius: 0.75rem;
    overflow-x: auto;
    margin: 1.5rem 0;
}

.blog-content pre code {
    background: transparent;
    color: inherit;
    padding: 0;
}

.blog-content table {
    width: 100%;
    border-collapse: collapse;
    margin: 1.5rem 0;
}

.blog-content table th,
.blog-content table td {
    padding: 0.75rem;
    border: 1px solid #e2e8f0;
    text-align: left;
}

.blog-content table th {
    background: #f8fafc;
    font-weight: 700;
    color: #1e293b;
}

.blog-content table tr:hover {
    background: #f8fafc;
}
</style>
@endpush
