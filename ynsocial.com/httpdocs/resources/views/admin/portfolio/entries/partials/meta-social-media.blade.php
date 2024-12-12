<!-- Social Media Meta -->
<div class="social-meta mt-3">
    <div class="meta-grid">
        <div class="meta-item">
            <span class="meta-label">Platform</span>
            <span class="meta-value platform-badge">
                <i class="fab fa-{{ strtolower($entry->platform) }}"></i>
                {{ $entry->platform }}
            </span>
        </div>
        <div class="meta-item">
            <span class="meta-label">Post Type</span>
            <span class="meta-value">{{ $entry->post_type }}</span>
        </div>
        @if($entry->engagement_stats)
        <div class="meta-item">
            <span class="meta-label">Engagement</span>
            <div class="engagement-stats">
                <span class="stat-item">
                    <i class="fas fa-heart"></i>
                    {{ number_format($entry->engagement_stats['likes']) }}
                </span>
                <span class="stat-item">
                    <i class="fas fa-comment"></i>
                    {{ number_format($entry->engagement_stats['comments']) }}
                </span>
                <span class="stat-item">
                    <i class="fas fa-share"></i>
                    {{ number_format($entry->engagement_stats['shares']) }}
                </span>
            </div>
        </div>
        @endif
    </div>
    <div class="meta-actions mt-2">
        @if($entry->post_url)
            <a href="{{ $entry->post_url }}" target="_blank" class="btn btn-montoya btn-outline">
                <span class="btn-label">View Post</span>
                <span class="btn-icon">
                    <i class="fas fa-external-link-alt"></i>
                </span>
            </a>
        @endif
        @if($entry->campaign_brief)
            <a href="{{ asset($entry->campaign_brief) }}" class="btn btn-montoya btn-text" download>
                <span class="btn-label">Campaign Brief</span>
                <span class="btn-icon">
                    <i class="fas fa-download"></i>
                </span>
            </a>
        @endif
    </div>
</div>

<style>
/* Montoya Theme Styling */
.social-meta .meta-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 1rem;
}

.platform-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.25rem 0.75rem;
    border-radius: 20px;
    font-size: 0.875rem;
    font-weight: 500;
    background: var(--montoya-bg-light);
}

.platform-badge i {
    font-size: 1rem;
}

.platform-badge[data-platform="instagram"] i {
    color: #E1306C;
}

.platform-badge[data-platform="facebook"] i {
    color: #4267B2;
}

.platform-badge[data-platform="tiktok"] i {
    color: #000000;
}

.engagement-stats {
    display: flex;
    gap: 1rem;
    margin-top: 0.25rem;
}

.stat-item {
    display: flex;
    align-items: center;
    gap: 0.25rem;
    font-size: 0.875rem;
    color: var(--montoya-text-muted);
}

.stat-item i {
    font-size: 0.75rem;
}

/* Inherit common meta styles from website partial */
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
</style> 