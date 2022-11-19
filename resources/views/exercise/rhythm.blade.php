<div>
    <audio controls>
        <source src="/audio/{{ $rhythmExercise->exercise->id }}.mp3" type="audio/mpeg">
    </audio>
</div>
<div id="rhythm_exercise_{{ $rhythmExercise->id }}"></div>
<a href="{{ route('exercises.recreate', $rhythmExercise->exercise) }}" class="btn btn-sm btn-primary">Recreate</a>
@push('scripts')
<script>
    var array = [].concat(@json($rhythmExercise->notesCollection()));
    VF = Vex.Flow;

    // Create an SVG renderer and attach it to the DIV element named "boo".
    var svg = document.getElementById("rhythm_exercise_{{ $rhythmExercise->id }}")
    var renderer = new VF.Renderer(svg, VF.Renderer.Backends.SVG);

    // Size our SVG:
    renderer.resize(600, 100);

    // And get a drawing context:
    var context = renderer.getContext();

    var stave = new VF.Stave(0, 0, 300)
        .addClef("treble")
        .addTimeSignature("{{ $rhythmExercise->barInfo->bar_info['num_beats'] }}/{{ $rhythmExercise->barInfo->bar_info['base_note'] }}")
        .setContext(context)
        .draw();

    var notes = [];
    for (i = 0; i < array.length; i++) {
        var note = array[i];
        if (note['type'] === 'bar') {
            Vex.Flow.Formatter.FormatAndDraw(context, stave, notes);
            stave = new VF.Stave(stave.width + stave.x, 0, 300)
                .setContext(context)
                .draw();
            notes = []
        } else if (note['type'] === 'r' || note['type'] === 'n') {
            let duration = "w";
            switch (note['value']) {
                case 2:
                    duration = "w"
                    break;
                case 4:
                    duration = "q"
                    break;
                case 8:
                    duration = "8"
                    break;
                case 16:
                    duration = "16"
                    break;
            }
            if (note['type'] === 'r') {
                duration += 'r'
            }
            let staveNote = new VF.StaveNote({clef: "treble", keys: ["g/4"], duration: duration})
            if (note['dot'] === true)
                staveNote.addDot(0)
            notes = notes.concat(staveNote)
        }
    }

    Vex.Flow.Formatter.FormatAndDraw(context, stave, notes);

    // Render voice
    voice.draw(context, stave);
</script>
@endpush
