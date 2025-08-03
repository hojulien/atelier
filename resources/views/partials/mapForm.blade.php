        <!-- laravel handles rules well enough, but we'll add an extra spice on top with input -->

        <div class="input-container flex flex-f-center g-10">
            <label class="button round-20 p-10 bold flex flex-f-center" for="artist">artist</label>
            <input type="text" name="artist" id="artist" maxlength="40" value="{{ old('artist', $map->artist ?? '') }}">
        </div>
        <div class="error hidden" id="error_artist"></div>

        <div class="input-container flex flex-f-center g-10">
            <label class="button round-20 p-10 bold flex flex-f-center" for="title">title</label>
            <input type="text" name="title" id="title" maxlength="80" value="{{ old('title', $map->title ?? '') }}">
        </div>
        <div class="error hidden" id="error_title"></div>

        <div class="input-container flex flex-f-center g-10">
            <label class="button round-20 p-10 bold flex flex-f-center" for="artistUnicode">artist (unicode)</label>
            <input type="text" name="artistUnicode" id="artistUnicode" maxlength="25" value="{{ old('artistUnicode', $map->artistUnicode ?? '') }}">
        </div>
        <div class="error hidden" id="error_artistUnicode"></div>

        <div class="input-container flex flex-f-center g-10">
            <label class="button round-20 p-10 bold flex flex-f-center" for="titleUnicode">title (unicode)</label>
            <input type="text" name="titleUnicode" id="titleUnicode" maxlength="50" value="{{ old('titleUnicode', $map->titleUnicode ?? '') }}">
        </div>
        <div class="error hidden" id="error_titleUnicode"></div>

        <div class="input-container flex flex-f-center g-10">
            <label class="button round-20 p-10 bold flex flex-f-center" for="creator">creator</label>
            <input type="text" name="creator" id="creator" maxlength="20" value="{{ old('creator', $map->creator ?? '') }}">
        </div>
        <div class="error hidden" id="error_creator"></div>

        <!-- map metadata -->

        <div class="input-container flex flex-f-center g-10">
            <label class="button round-20 p-10 bold flex flex-f-center" for="sr">star rating</label>
            <input type="number" name="sr" id="srForm" min="0" step="0.01" value="{{ old('sr', $map->sr ?? '') }}">
        </div>
        <div class="error hidden" id="error_sr"></div>

        <div class="input-container flex flex-f-center g-10">
            <label class="button round-20 p-10 bold flex flex-f-center" for="length">length (seconds)</label>
            <input type="number" name="length" id="lengthForm" min="0" step="1" value="{{ old('length', $map->length ?? '') }}">
        </div>
        <div class="error hidden" id="error_length"></div>

        <div class="input-container input-settings flex flex-f-center g-10">
            <label class="button round-20 p-10 bold flex flex-f-center" for="cs">cs</label>
            <input type="number" name="cs" id="csForm" min="0" max="10" step="0.1" value="{{ old('cs', $map->cs ?? '') }}">

            <label class="button round-20 p-10 bold flex flex-f-center" for="hp">hp</label>
            <input type="number" name="hp" id="hpForm" min="0" max="10" step="0.1" value="{{ old('hp', $map->hp ?? '') }}">

            <label class="button round-20 p-10 bold flex flex-f-center" for="ar">ar</label>
            <input type="number" name="ar" id="arForm" min="0" max="10" step="0.1" value="{{ old('ar', $map->ar ?? '') }}">

            <label class="button round-20 p-10 bold flex flex-f-center" for="od">od</label>
            <input type="number" name="od" id="odForm" min="0" max="10" step="0.1" value="{{ old('od', $map->od ?? '') }}">
        </div>
        <div class="error hidden" id="error_settings"></div>

        <div class="input-container flex flex-f-center g-10">
            <label class="button round-20 p-10 bold flex flex-f-center" for="setId">set id</label>
            <input type="number" name="setId" id="setId" min="0" value="{{ old('setId', $map->setId ?? '') }}">
        </div>
        <div class="error hidden" id="error_setId"></div>

        <div class="input-container flex flex-f-center g-10">
            <label class="button round-20 p-10 bold flex flex-f-center" for="mapId">map id</label>
            <input type="number" name="mapId" id="mapId" min="0" value="{{ old('mapId', $map->mapId ?? '') }}">
        </div>
        <div class="error hidden" id="error_mapId"></div>

        <div class="input-container flex flex-f-center g-10">
            <label class="button round-20 p-10 bold flex flex-f-center" for="submitDate">submit date</label>
            <input type="datetime-local" name="submitDate" id="submitDate" step="1" value="{{ old('submitDate', $map->submitDate ?? '') }}">
        </div>
        <div class="error hidden" id="error_submitDate"></div>

        <div class="input-container flex flex-f-center g-10">
            <label class="button round-20 p-10 bold flex flex-f-center" for="lastUpdated">last updated</label>
            <input type="datetime-local" name="lastUpdated" id="lastUpdated" step="1" value="{{ old('lastUpdated', $map->lastUpdated ?? '') }}">
        </div>
        <div class="error hidden" id="error_lastUpdated"></div>

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
         
        <div class="input-container flex stretch g-10">
            <label class="button round-20 p-10 bold h-auto flex flex-f-center" for="background">background</label>
            <div class="flex flex-col flex-f-center w-full max-w-600">
                <input type="file" name="background">
                @if(isset($map) && $map->background)
                    <img class="w-full round-10" src="{{ asset('storage/images/maps_background/' . $map->background) }}" alt="current background">
                @endif
            </div>
        </div>