<section class="knowledge-content" aria-labelledby="knowledge-posts-title">
    <p class="knowledge-eyebrow">Knowledge Centre</p>
    <h1 id="knowledge-posts-title">{{ $videosOnly ? 'Video articles' : 'Articles' }}</h1>
    <nav class="knowledge-nav" aria-label="Knowledge Centre">
        <a href="{{ route('knowledge.articles') }}">All articles</a>
        <a href="{{ route('knowledge.videos') }}">With videos</a>
    </nav>
    <div class="knowledge-post-grid">
        @forelse($posts as $post)
            <article class="knowledge-post-card">
                @if($post->featured_image)
                    <a href="{{ route('knowledge.show', $post) }}" tabindex="-1" aria-hidden="true">
                        <img src="{{ asset('storage/'.$post->featured_image) }}" alt="" loading="lazy">
                    </a>
                @endif
                <div class="knowledge-post-card-body">
                    <h2><a href="{{ route('knowledge.show', $post) }}">{{ $post->title }}</a></h2>
                    <p>{{ $post->excerpt }}</p>
                    @php($videoCount = count($post->playableVideos()))
                    <p class="knowledge-count">{{ $videoCount }} {{ $videoCount === 1 ? 'video' : 'videos' }}</p>
                    <a href="{{ route('knowledge.show', $post) }}">Read article &rarr;</a>
                </div>
            </article>
        @empty
            <p>No articles have been published yet.</p>
        @endforelse
    </div>
    {{ $posts->links() }}
</section>
