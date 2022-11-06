<div>
    @foreach($exercise->value as $note)
        {{ $note }}
    @endforeach
    <div id="interval_exercise_{{ $exercise->id }}"></div>
</div>
@push('scripts')
    <script>
        var array = [].concat(@json($exercise->value));
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

        console.log(array);
        var notes = [];
        for (i = 0; i < array.length; i++) {
            var note = array[i];
            let key = [note.slice(0, note.length - 1), '/', note.slice(note.length - 1)].join('')
            console.log(key);
            let staveNote = new VF.StaveNote({clef: "treble", keys: [key], duration: 'w'})
            if (note.includes('#'))
                staveNote.addAccidental(0, new VF.Accidental("#"))
            notes = notes.concat(staveNote)
        }
        Vex.Flow.Formatter.FormatAndDraw(context, stave, notes);
    </script>
@endpush
