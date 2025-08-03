        <!-- laravel handles rules well enough, but we'll add an extra spice on top with input -->

        <div class="input-container flex flex-f-center g-10">
            <label class="button round-20 p-10 bold flex flex-f-center" for="artist">artist</label>
            <input type="text" name="artist" max="40" value="{{ old('artist', $map->artist ?? '') }}">
        </div>

        <div class="input-container flex flex-f-center g-10">
                <label class="button round-20 p-10 bold flex flex-f-center" for="title">title</label>
                <input type="text" name="title" max="80" value="{{ old('title', $map->title ?? '') }}">
        </div>

        <div class="input-container flex flex-f-center g-10">
            <label class="button round-20 p-10 bold flex flex-f-center" for="artistUnicode">artist (unicode)</label>
            <input type="text" name="artistUnicode" max="25" value="{{ old('artistUnicode', $map->artistUnicode ?? '') }}">
        </div>

        <div class="input-container flex flex-f-center g-10">
            <label class="button round-20 p-10 bold flex flex-f-center" for="titleUnicode">title (unicode)</label>
            <input type="text" name="titleUnicode" max="50" value="{{ old('titleUnicode', $map->titleUnicode ?? '') }}">
        </div>

        <div class="input-container flex flex-f-center g-10">
            <label class="button round-20 p-10 bold flex flex-f-center" for="creator">creator</label>
            <input type="text" name="creator" max="20" value="{{ old('creator', $map->creator ?? '') }}">
        </div>

        <!-- map metadata -->

        <div class="input-container flex flex-f-center g-10">
            <label class="button round-20 p-10 bold flex flex-f-center" for="sr">star rating</label>
            <input type="number" name="sr" min="0" step="0.01" value="{{ old('sr', $map->sr ?? '') }}">
        </div>

        <div class="input-container flex flex-f-center g-10">
            <label class="button round-20 p-10 bold flex flex-f-center" for="length">length (seconds)</label>
            <input type="number" name="length" min="0" step="1" value="{{ old('length', $map->length ?? '') }}">
        </div>

        <div class="input-container input-settings flex flex-f-center g-10">
            <label class="button round-20 p-10 bold flex flex-f-center" for="cs">cs</label>
            <input type="number" name="cs" min="0" max="10" step="0.1" value="{{ old('cs', $map->cs ?? '') }}">

            <label class="button round-20 p-10 bold flex flex-f-center" for="hp">hp</label>
            <input type="number" name="hp" min="0" max="10" step="0.1" value="{{ old('hp', $map->hp ?? '') }}">

            <label class="button round-20 p-10 bold flex flex-f-center" for="ar">ar</label>
            <input type="number" name="ar" min="0" max="10" step="0.1" value="{{ old('ar', $map->ar ?? '') }}">

            <label class="button round-20 p-10 bold flex flex-f-center" for="od">od</label>
            <input type="number" name="od" min="0" max="10" step="0.1" value="{{ old('od', $map->od ?? '') }}">
        </div>

        <div class="input-container flex flex-f-center g-10">
            <label class="button round-20 p-10 bold flex flex-f-center" for="setId">set id</label>
            <input type="number" name="setId" min="0" value="{{ old('setId', $map->setId ?? '') }}">
        </div>

        <div class="input-container flex flex-f-center g-10">
            <label class="button round-20 p-10 bold flex flex-f-center" for="mapId">map id</label>
            <input type="number" name="mapId" min="0" value="{{ old('mapId', $map->mapId ?? '') }}">
        </div>

        <div class="input-container flex flex-f-center g-10">
            <label class="button round-20 p-10 bold flex flex-f-center" for="submitDate">submit date</label>
            <input type="datetime-local" name="submitDate" step="1" value="{{ old('submitDate', $map->submitDate ?? '') }}">
        </div>

        <div class="input-container flex flex-f-center g-10">
            <label class="button round-20 p-10 bold flex flex-f-center" for="lastUpdated">last updated</label>
            <input type="datetime-local" name="lastUpdated" step="1" value="{{ old('lastUpdated', $map->lastUpdated ?? '') }}">
        </div>

        <div class="input-container input-tags flex stretch g-10">
            <label class="button round-20 p-10 bold flex flex-f-center" for="tags">tags</label>
            <div id="tags-container" class="g-10">
                <div class="tag-container flex flex-f-center g-10">
                    <input id="tag1" type="text" name="tags[]" class="tag" />
                    <button type="button" class="remove-tag invisible">✖</button>
                </div>
                <div class="tag-container flex flex-f-center g-10">
                    <input id="tag2" type="text" name="tags[]" class="tag" />
                    <button type="button" class="remove-tag invisible">✖</button>
                </div>            
                <div class="tag-container flex flex-f-center g-10">
                    <input id="tag3" type="text" name="tags[]" class="tag" />
                    <button type="button" class="remove-tag invisible">✖</button>
                </div>
            </div>
            <button type="button" id="add-tag">+ Add tag</button>
        </div>
         
        <div class="input-container flex flex-f-center g-10">
            <label class="button round-20 p-10 bold flex flex-f-center" for="background">background</label>
            <input type="file" name="background">
            @if(isset($map) && $map->background)
                <img class="w-full round-10" src="{{ asset('storage/images/maps_background/' . $map->background) }}" alt="current background">
            @endif
        </div>