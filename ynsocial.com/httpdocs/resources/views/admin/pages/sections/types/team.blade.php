@php
    $content = $section->content ?? [];
    $style = $content['style'] ?? 'grid';
    $title = $content['title'] ?? '';
    $subtitle = $content['subtitle'] ?? '';
    $description = $content['description'] ?? '';
    $showSocialLinks = $content['show_social_links'] ?? true;
    $showPosition = $content['show_position'] ?? true;
    $showBio = $content['show_bio'] ?? true;
    $members = $content['members'] ?? [];
@endphp

<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Team Members Grid Settings</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Section Title</label>
                    <input type="text" class="form-control" name="content[title]" value="{{ $title }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Subtitle</label>
                    <input type="text" class="form-control" name="content[subtitle]" value="{{ $subtitle }}">
                </div>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea class="form-control" name="content[description]" rows="3">{{ $description }}</textarea>
        </div>

        <div class="row mb-4">
            <div class="col-md-4">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="content[show_social_links]" value="1" {{ $showSocialLinks ? 'checked' : '' }}>
                    <label class="form-check-label">Show Social Links</label>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="content[show_position]" value="1" {{ $showPosition ? 'checked' : '' }}>
                    <label class="form-check-label">Show Position</label>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="content[show_bio]" value="1" {{ $showBio ? 'checked' : '' }}>
                    <label class="form-check-label">Show Bio</label>
                </div>
            </div>
        </div>

        <div class="team-members mb-3">
            <label class="form-label">Team Members</label>
            <div class="team-members-list" data-items="{{ json_encode($members) }}">
                @foreach($members as $index => $member)
                    <div class="team-member-item card mb-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Name</label>
                                        <input type="text" class="form-control" name="content[members][{{ $index }}][name]" value="{{ $member['name'] ?? '' }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Position</label>
                                        <input type="text" class="form-control" name="content[members][{{ $index }}][position]" value="{{ $member['position'] ?? '' }}">
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Photo URL</label>
                                <input type="text" class="form-control" name="content[members][{{ $index }}][photo]" value="{{ $member['photo'] ?? '' }}">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Bio</label>
                                <textarea class="form-control" name="content[members][{{ $index }}][bio]" rows="2">{{ $member['bio'] ?? '' }}</textarea>
                            </div>

                            <div class="social-links mb-3">
                                <label class="form-label">Social Links</label>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-2">
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="fab fa-linkedin"></i></span>
                                                <input type="text" class="form-control" name="content[members][{{ $index }}][social][linkedin]" value="{{ $member['social']['linkedin'] ?? '' }}" placeholder="LinkedIn URL">
                                            </div>
                                        </div>
                                        <div class="mb-2">
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="fab fa-twitter"></i></span>
                                                <input type="text" class="form-control" name="content[members][{{ $index }}][social][twitter]" value="{{ $member['social']['twitter'] ?? '' }}" placeholder="Twitter URL">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-2">
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="fab fa-facebook"></i></span>
                                                <input type="text" class="form-control" name="content[members][{{ $index }}][social][facebook]" value="{{ $member['social']['facebook'] ?? '' }}" placeholder="Facebook URL">
                                            </div>
                                        </div>
                                        <div class="mb-2">
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="fab fa-instagram"></i></span>
                                                <input type="text" class="form-control" name="content[members][{{ $index }}][social][instagram]" value="{{ $member['social']['instagram'] ?? '' }}" placeholder="Instagram URL">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <button type="button" class="btn btn-danger btn-sm remove-member">Remove Member</button>
                        </div>
                    </div>
                @endforeach
            </div>
            <button type="button" class="btn btn-primary add-member mt-2">Add New Team Member</button>
        </div>
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        let memberIndex = $('.team-member-item').length;

        $('.add-member').click(function() {
            const template = `
                <div class="team-member-item card mb-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Name</label>
                                    <input type="text" class="form-control" name="content[members][${memberIndex}][name]">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Position</label>
                                    <input type="text" class="form-control" name="content[members][${memberIndex}][position]">
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Photo URL</label>
                            <input type="text" class="form-control" name="content[members][${memberIndex}][photo]">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Bio</label>
                            <textarea class="form-control" name="content[members][${memberIndex}][bio]" rows="2"></textarea>
                        </div>

                        <div class="social-links mb-3">
                            <label class="form-label">Social Links</label>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-2">
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fab fa-linkedin"></i></span>
                                            <input type="text" class="form-control" name="content[members][${memberIndex}][social][linkedin]" placeholder="LinkedIn URL">
                                        </div>
                                    </div>
                                    <div class="mb-2">
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fab fa-twitter"></i></span>
                                            <input type="text" class="form-control" name="content[members][${memberIndex}][social][twitter]" placeholder="Twitter URL">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-2">
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fab fa-facebook"></i></span>
                                            <input type="text" class="form-control" name="content[members][${memberIndex}][social][facebook]" placeholder="Facebook URL">
                                        </div>
                                    </div>
                                    <div class="mb-2">
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fab fa-instagram"></i></span>
                                            <input type="text" class="form-control" name="content[members][${memberIndex}][social][instagram]" placeholder="Instagram URL">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button type="button" class="btn btn-danger btn-sm remove-member">Remove Member</button>
                    </div>
                </div>
            `;
            $('.team-members-list').append(template);
            memberIndex++;
        });

        $(document).on('click', '.remove-member', function() {
            $(this).closest('.team-member-item').remove();
        });
    });
</script>
@endpush 