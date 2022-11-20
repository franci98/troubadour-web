<div>
    <audio controls>
        <source src="/audio/{{ $rhythmExercise->exercise->id }}.mp3" type="audio/mpeg">
    </audio>
</div>
<div id="rhythm_exercise_{{ $rhythmExercise->id }}"></div>
<a href="{{ route('exercises.recreate', $rhythmExercise->exercise) }}" class="btn btn-sm btn-primary">Recreate</a>
@once
    @push('scripts')
        <script>
            var elementToStaveNote = function (element) {
                let key = "g/4";
                let duration = "w";
                switch (element['value']) {
                    case 2:
                        duration = "h"
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
                if (element['type'] === 'r') {
                    duration += 'r'
                    key = "b/4"
                }
                let staveNote =  new StaveNote({
                    keys: [key],
                    duration: duration
                });
                if (element['dot'] === true) {
                    Dot.buildAndAttach([staveNote], {
                        all: true,
                    });
                }
                return staveNote;
            }
        </script>
    @endpush
@endonce
@push('scripts')
<script>
    var array = [].concat(@json($rhythmExercise->notesCollection()));
    console.log(array);
    var part1 = array.slice(0, array.map(e => e.type).indexOf('bar'));
    var part2 = array.slice(array.map(e => e.type).indexOf('bar') + 1);
    // This approach to importing classes works in CJS contexts (i.e., a regular <script src="..."> tag).
    var { Stave, StaveNote, Beam, Formatter, Renderer, Dot } = Vex;

    // Create an SVG renderer and attach it to the DIV element with id="output".
    var div = document.getElementById("rhythm_exercise_{{ $rhythmExercise->id }}");
    var renderer = new Renderer(div, Renderer.Backends.SVG);

    // Configure the rendering context.
    renderer.resize(720, 130);
    var context = renderer.getContext();

    // Measure 1
    var staveMeasure1 = new Stave(10, 0, 400);
    staveMeasure1
        .addClef("treble")
        .addTimeSignature("{{ $rhythmExercise->barInfo->bar_info['num_beats'] }}/{{ $rhythmExercise->barInfo->bar_info['base_note'] }}")
        .setContext(context)
        .draw();

    var notesMeasure1 = part1.map(elementToStaveNote)

    // Helper function to justify and draw a 4/4 voice
    Formatter.FormatAndDraw(context, staveMeasure1, notesMeasure1);

    // Measure 2 - second measure is placed adjacent to first measure.
    var staveMeasure2 = new Stave(staveMeasure1.width + staveMeasure1.x, 0, 400);

    var notesMeasure2_part1 = part2.map(elementToStaveNote);

    var notesMeasure2 = notesMeasure2_part1;

    staveMeasure2.setContext(context).draw();
    Formatter.FormatAndDraw(context, staveMeasure2, notesMeasure2);

</script>
@endpush
