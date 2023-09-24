<div class="row">
    <div class="form-group col-12" id="input-difficulty_id-container">
        <label class="form-control-label w-100">
            <div class="mb-2">
                <span class="h6 ml-2 mb-2">@lang('messages.homework_create_difficulty_id_title')</span>
            </div>
        </label>
        <div class="input-group mb-3 ps-3">
            <select id="input-difficulty_id" class="form-control  @error('difficulty_id') is-invalid @enderror" name="difficulty_id" value="{{ old('difficulty_id') }}" required >

            </select>
            @error('difficulty_id')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>
</div>
@push('scripts')
    <script>
      const DIFFICULTIES = @json($difficulties);

      var settings = {
        valueField: 'id',
        labelField: 'description',
        searchField: 'description'
      };
      const difficultySelect = new TomSelect('#input-difficulty_id', settings);
      document.getElementById('input-game_type_id').addEventListener('change', function() {
        console.log('You selected: ', this.value);
        let value = this.value;
        let options = DIFFICULTIES.filter(difficulty => difficulty.game_type_id == value).map(difficulty => {
          return {
            id: difficulty.id,
            description: difficulty.description
          };
        });
        difficultySelect.clear(true);
        difficultySelect.clearOptions();
        difficultySelect.addOptions(options);
      });

      // Dirty fix to load the difficulties for default game type
      document.getElementById('input-game_type_id').dispatchEvent(new Event('change'));
    </script>
@endpush
