        <!-- laravel handles rules well enough, but we'll add an extra spice on top with input -->

        <label for="artist">artist</label>
        <input type="text" name="artist" max="40" value="{{ old('artist', $map->artist ?? '') }}">

        <label for="title">title</label>
        <input type="text" name="title" max="80" value="{{ old('title', $map->title ?? '') }}">

        <label for="artistUnicode">artist (unicode)</label>
        <input type="text" name="artistUnicode" max="25" value="{{ old('artistUnicode', $map->artistUnicode ?? '') }}">

        <label for="titleUnicode">title (unicode)</label>
        <input type="text" name="titleUnicode" max="50" value="{{ old('titleUnicode', $map->titleUnicode ?? '') }}">

        <label for="rc">theme</label>
        <input type="text" name="rc" max="20" value="{{ old('rc', $map->rc ?? '') }}">

        <label for="creator">creator</label>
        <input type="text" name="creator" max="20" value="{{ old('creator', $map->creator ?? '') }}">

        <!-- map metadata -->

        <label for="sr">star rating</label>
        <input type="number" name="sr" min="0" step="0.01" value="4.00" value="{{ old('sr', $map->sr ?? '') }}">

        <label for="length">length (seconds)</label>
        <input type="number" name="length" min="0" step="1" value="{{ old('length', $map->length ?? '') }}">


        <label for="cs">circle size</label>
        <input type="number" name="cs" min="0" max="10" step="0.1" value="5" value="{{ old('cs', $map->cs ?? '') }}">

        <label for="hp">hp drain</label>
        <input type="number" name="hp" min="0" max="10" step="0.1" value="5" value="{{ old('hp', $map->hp ?? '') }}">

        <label for="ar">approach rate</label>
        <input type="number" name="ar" min="0" max="10" step="0.1" value="5" value="{{ old('ar', $map->ar ?? '') }}">

        <label for="od">overall difficulty</label>
        <input type="number" name="od" min="0" max="10" step="0.1" value="5" value="{{ old('od', $map->od ?? '') }}">

        <label for="setId">set id</label>
        <input type="number" name="setId" min="0" value="{{ old('setId', $map->setId ?? '') }}">
        
        <label for="mapId">map id</label>
        <input type="number" name="mapId" min="0" value="{{ old('mapId', $map->mapId ?? '') }}">

        <label for="submitDate">submit date</label>
        <input type="datetime-local" name="submitDate" step="1" value="{{ old('submitDate', $map->submitDate ?? '') }}">

        <label for="lastUpdated">last updated</label>
        <input type="datetime-local" name="lastUpdated" step="1" value="{{ old('lastUpdated', $map->lastUpdated ?? '') }}">

        <!-- TO DO LATER: TAGS -->
         
        <label for="background">background</label>
        <input type="file" name="background">
        @if(isset($map) && $map->background)
            <img src="{{ asset('storage/images/maps_background/' . $map->background) }}" alt="current banner" height="128">
        @endif