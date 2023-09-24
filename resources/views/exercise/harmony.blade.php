<div>
    <audio controls>
        <source src="/audio/{{ $exercise->exercise->id }}.mp3" type="audio/mpeg">
    </audio>
</div>
<div>
    @foreach($exercise->value['keys'] as $note)
        {{ $note }}
    @endforeach
    <div id="interval_exercise_{{ $exercise->id }}"></div>
</div>
<a href="{{ route('exercises.recreate', $exercise->exercise) }}" class="btn btn-sm btn-primary">Recreate</a>
@push('scripts')
    <script>
        var array = [].concat(@json($exercise->value['keys']));
        VF = Vex.Flow;

        var svg = document.getElementById("interval_exercise_{{ $exercise->id }}")
        var renderer = new VF.Renderer(svg, VF.Renderer.Backends.SVG);

        // Size our SVG:
        renderer.resize(600, 100);

        // And get a drawing context:
        var context = renderer.getContext();

        var stave = new VF.Stave(0, 0, 300)
            .addClef("treble")
            .setContext(context)
            .draw();

        var notes = [];
        for (i = 0; i < array.length; i++) {
            var note = array[i];
            let key = [note.slice(0, note.length - 1), '/', note.slice(note.length - 1)].join('')
            let staveNote = new VF.StaveNote({clef: "treble", keys: [key], duration: 'w'})
            if (note.includes('#'))
                staveNote
                    .addModifier(new VF.Accidental("#"))
            notes = notes.concat(staveNote)
        }
        Vex.Flow.Formatter.FormatAndDraw(context, stave, notes);
    </script>
@endpush
