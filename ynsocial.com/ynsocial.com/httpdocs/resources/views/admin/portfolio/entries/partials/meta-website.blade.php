<!-- Website Meta -->
<div class="website-meta mt-3">
    <div class="meta-grid">
        <div class="meta-item">
            <span class="meta-label">Client</span>
            <span class="meta-value">{{ $entry->client_name }}</span>
        </div>
        <div class="meta-item">
            <span class="meta-label">Launch Date</span>
            <span class="meta-value">{{ $entry->completion_date->format('M Y') }}</span>
        </div>
    </div>
    <div class="meta-actions mt-2">
        @if($entry->website_url)
            <a href="{{ $entry->website_url }}" target="_blank" class="btn btn-montoya btn-outline">
                <span class="btn-label">Visit Website</span>
                <span class="btn-icon">
                    <i class="fas fa-external-link-alt"></i>
                </span>
            </a>
        @endif
        @if($entry->case_study_url)
            <a href="{{ $entry->case_study_url }}" class="btn btn-montoya btn-text">
                <span class="btn-label">View Case Study</span>
                <span class="btn-icon">
                    <i class="fas fa-file-alt"></i>
                </span>
            </a>
        @endif
    </div>
</div>

<style>
/* Montoya Theme Styling */
.meta-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 1rem;
}

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

.btn-outline {
    border: 1px solid var(--montoya-primary);
    color: var(--montoya-primary);
}

.btn-outline:hover {
    background: var(--montoya-primary);
    color: white;
    transform: translateY(-2px);
}

.btn-text {
    color: var(--montoya-text);
    padding: 0.5rem;
}

.btn-text:hover {
    color: var(--montoya-primary);
    transform: translateX(2px);
}

.meta-actions {
    display: flex;
    gap: 1rem;
    align-items: center;
}
</style> 