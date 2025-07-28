<div class="mb-3">
    <label>Name</label>
    <input type="text" name="name" class="form-control" value="{{ e(old('name', $software->name ?? '')) }}" required>
</div>

<div class="mb-3">
    <label>Description</label>
    <textarea name="description" class="form-control">{{ e(old('description', $software->description ?? '')) }}</textarea>
</div>

<div class="mb-3">
    <label>Image</label>
    <input type="file" name="image" class="form-control">
</div>

<h5>Releases</h5>
<div id="release-section" class="sortable-list">
    @php
        $platforms = ['windows', 'mac', 'linux', 'kali'];
        $releases = old('releases', $software->releases ?? [['os' => '', 'version' => '', 'download_url' => '']]);
    @endphp
    @foreach($releases as $index => $release)
        <div class="border p-3 mb-2 release-block" data-index="{{ $index }}">
            <input type="hidden" name="releases[{{ $index }}][id]" value="{{ $release['id'] ?? '' }}">

            <div class="mb-2">
                <label>Platform</label>
                <select name="releases[{{ $index }}][os]" class="form-control" required>
                    <option value="">Select OS</option>
                    @foreach($platforms as $os)
                        <option value="{{ $os }}" @selected(($release['os'] ?? '') === $os)>{{ ucfirst($os) }}</option>
                    @endforeach
                </select>
            </div>

            <input type="text" name="releases[{{ $index }}][version]" placeholder="Version (e.g. 1.0.3)" class="form-control mb-2 version-field" value="{{ e($release['version'] ?? '') }}" required>
            <input type="text" name="releases[{{ $index }}][download_url]" placeholder="Download URL" class="form-control mb-2" value="{{ e($release['download_url'] ?? '') }}" required>

            <button type="button" class="btn btn-sm btn-danger" onclick="removeRelease(this)">Remove</button>
        </div>
    @endforeach
</div>

<button type="button" class="btn btn-secondary mb-3" onclick="addRelease()">+ Add Release</button>

<input type="hidden" id="release-count" value="{{ count($releases) }}">

<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
<script>
    let releaseIndex = parseInt(document.getElementById('release-count').value);
    const platforms = ['windows', 'mac', 'linux', 'kali'];

    function generatePlatformOptions() {
        return platforms.map(os => `<option value=\"${os}\">${os.charAt(0).toUpperCase() + os.slice(1)}</option>`).join('');
    }

    function addRelease() {
        const section = document.getElementById('release-section');
        const html = `
            <div class="border p-3 mb-2 release-block" data-index="\${releaseIndex}">
                <div class="mb-2">
                    <label>Platform</label>
                    <select name="releases[\${releaseIndex}][os]" class="form-control" required>
                        <option value="">Select OS</option>
                        ${generatePlatformOptions()}
                    </select>
                </div>
                <input type="text" name="releases[\${releaseIndex}][version]" placeholder="Version (e.g. 1.0.0)" class="form-control mb-2 version-field" required>
                <input type="text" name="releases[\${releaseIndex}][download_url]" placeholder="Download URL" class="form-control mb-2" required>
                <button type="button" class="btn btn-sm btn-danger" onclick="removeRelease(this)">Remove</button>
            </div>
        `;
        section.insertAdjacentHTML('beforeend', html);
        releaseIndex++;
    }

    function removeRelease(button) {
        button.closest('.release-block').remove();
    }

    // Enable sortable
    Sortable.create(document.getElementById('release-section'), {
        animation: 150,
        handle: '.release-block',
        onEnd: function () {
            console.log('Release order updated');
        }
    });

    // Semantic versioning validation
    document.querySelector('form').addEventListener('submit', function (e) {
        const versionFields = document.querySelectorAll('.version-field');
        const semverPattern = /^\\d+\\.\\d+\\.\\d+$/;

        for (const input of versionFields) {
            if (!semverPattern.test(input.value)) {
                e.preventDefault();
                alert(`Invalid version: ${input.value}. Use format: major.minor.patch (e.g. 1.2.3)`);
                input.focus();
                return;
            }
        }
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
