let selectType = document.getElementById('select-media');
selectType.addEventListener('change', () => {
    if (selectType.value === 'media') {
        document.getElementById('media-field').style.display = 'block';
        document.getElementById('music-field').style.display = 'none';
    } else {
        document.getElementById('media-field').style.display = 'none';
        document.getElementById('music-field').style.display = 'block';
    }
});