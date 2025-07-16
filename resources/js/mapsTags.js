document.addEventListener("DOMContentLoaded", () => {
    // display at least 3 tags, up to 10
    const minTags = 3;
    const maxTags = 10;

    const container = document.getElementById('tags-container');
    const addButton = document.getElementById('add-tag');

    function createTagInput(value = '') {
        // create div including input & remove button
        const div = document.createElement('div');
        div.className = "tag-container flex g-5";

        // create input
        const input = document.createElement('input');
        input.className = 'tag';
        input.id = `tag${minTags+1}`;
        input.name = "tags[]";
        input.type = 'text';
        input.value = value;

        // create remove button
        const removeButton = document.createElement('button');
        removeButton.type = 'button';
        removeButton.className = "remove-tag";
        removeButton.textContent = "✖";

        // event listener for removeButton
        removeButton.addEventListener('click', () => {
            const currentTags = container.querySelectorAll('.tag').length;
            if (currentTags > minTags) {
                div.remove();
                addButton.disabled = false;
            }
        });

        // append child elements to div
        div.appendChild(input);
        div.appendChild(removeButton);
        return div;
    }

    function addTag() {
        // appends a new input if maxTags hasn't been reached
        // if currentTags = 9 then addButton gets disabled after last append
        const currentTags = container.querySelectorAll('.tag').length;
        if (currentTags < maxTags) {
            container.appendChild(createTagInput());
            if (currentTags+1 === maxTags) {
                addButton.disabled = true;
            }
        }
    }

    // clicking on the button calls addTag
    addButton.addEventListener('click', addTag);
});