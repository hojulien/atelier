let media = document.getElementById('media-field');
const music = document.getElementById('music-field');
const selectType = document.getElementById('select-media');

function toggleMediaField() {
    if (selectType.value === 'media') {
        // re-initializes media in case it's been replaced
        media = document.getElementById('media-field');

        media.classList.remove("hidden");
        media.disabled = false;

        music.classList.add("hidden");
        music.disabled = true;
        music.value = '';
    } else {
        media.classList.add("hidden");
        media.disabled = true;

        // clones media, replace it and updates DOM pointer

        const newMedia = media.cloneNode(true);
        media.parentNode.replaceChild(newMedia, media);
        media = newMedia;
        media.id = 'media-field';

        music.classList.remove("hidden");
        music.disabled = false;
    }
}

selectType.addEventListener('change', toggleMediaField);
toggleMediaField();