<!-- Video Meta -->
<div class="video-meta mt-3">
    <div class="meta-grid">
        <div class="meta-item">
            <span class="meta-label">Duration</span>
            <span class="meta-value">{{ $entry->duration }}</span>
        </div>
        <div class="meta-item">
            <span class="meta-label">Video Type</span>
            <span class="meta-value">{{ ucfirst($entry->video_type) }}</span>
        </div>
        @if($entry->production_details)
        <div class="meta-item full-width">
            <span class="meta-label">Production Details</span>
            <div class="production-team">
                @foreach($entry->production_details as $role => $name)
                    <span class="team-member">
                        <span class="role">{{ $role }}:</span>
                        <span class="name">{{ $name }}</span>
                    </span>
                @endforeach
            </div>
        </div>
        @endif
        @if($entry->tags)
        <div class="meta-item full-width">
            <span class="meta-label">Tags</span>
            <div class="tag-list">
                @foreach($entry->tags as $tag)
                    <span class="tag">{{ $tag }}</span>
                @endforeach
            </div>
        </div>
        @endif
    </div>
    <div class="meta-actions mt-2">
        @if($entry->video_url)
            <a href="{{ $entry->video_url }}" target="_blank" class="btn btn-montoya btn-outline">
                <span class="btn-label">Watch Video</span>
                <span class="btn-icon">
                    <i class="fas fa-play"></i>
                </span>
            </a>
        @endif
        @if($entry->behind_the_scenes)
            <a href="{{ $entry->behind_the_scenes }}" class="btn btn-montoya btn-text">
                <span class="btn-label">Behind the Scenes</span>
                <span class="btn-icon">
                    <i class="fas fa-film"></i>
                </span>
            </a>
        @endif
    </div>
</div>

<style>
/* Montoya Theme Styling */
.video-meta .meta-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 1rem;
}

.full-width {
    grid-column: 1 / -1;
}

.production-team {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.team-member {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.875rem;
}

.team-member .role {
    color: var(--montoya-text-muted);
    font-weight: 500;
}

.team-member .name {
    color: var(--montoya-text);
}

.tag-list {
    display: flex;
    flex-wrap: wrap;
    gap: 0.5rem;
    margin-top: 0.25rem;
}

.tag {
    display: inline-flex;
    align-items: center;
    padding: 0.25rem 0.75rem;
    background: var(--montoya-bg-light);
    border-radius: 20px;
    font-size: 0.75rem;
    color: var(--montoya-text);
    font-weight: 500;
    transition: all 0.3s ease;
}

.tag:hover {
    background: var(--montoya-primary);
    color: white;
    transform: translateY(-1px);
}

/* Inherit common meta styles */
.meta-item {
    display: flex;
    flex-direction: column;
}

.meta-label {
    font-size: 0.75rem;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    color: var(--montoya-text-muted);
    margin-bottom: 0.25rem;
}

.meta-value {
    font-size: 0.875rem;
    color: var(--montoya-text);
    font-weight: 500;
}

.btn-montoya {
    display: inline-flex;
    align-items: center;
    padding: 0.5rem 1rem;
    border-radius: 2px;
    transition: all 0.3s ease;
    font-size: 0.875rem;
    font-weight: 500;
    letter-spacing: 0.02em;
}

.btn-montoya .btn-icon {
    margin-left: 0.5rem;
    font-size: 0.75rem;
}

.meta-actions {
    display: flex;
    gap: 1rem;
    align-items: center;
    margin-top: 1rem;
}

/* Video-specific animations */
.btn-montoya.btn-outline:hover .btn-icon {
    animation: pulse 1s infinite;
}

@keyframes pulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.2); }
    100% { transform: scale(1); }
}
</style> 