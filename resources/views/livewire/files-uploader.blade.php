<div>
    <!-- Image form input -->
    <div id="image_section">
        <div class="post_container-aside-row">
            <div class="post_container-aside-row-label">
                <label for="image">Image </label>
            </div>
            <div class="post_container-aside-row-input">
                <input wire:model="imageUrl" type="text" id="image" name="image" list="stored_images">
                <datalist id="stored_images">
                    @foreach($imageNames as $imageName)
                        <option value="{{$imageName}}">{{$imageName}}</option>
                    @endforeach
                </datalist>
            </div>
        </div>

        <div class="post_container--uploader">
            <div class="flex pl-2 mb-4" style="font-size: 0.85rem; border-bottom: 1px solid #999;">
                Status: <span wire:click="clearStatusMessage"
                              style="padding-left: 1rem; color: red; font-size: 0.8rem;">{{ $statusMessage }}</span>
            </div>
            <form wire:submit.prevent="save">
                <div>
                    <div>
                        <input type="file" wire:model="photo">
                        @error('photo') <span class="error">{{ $message }}</span> @enderror
                    </div>

                    <div class="post_container-aside-row">

                        <div class="post_container-image_preview" id="image_preview">

                            @if (isset($photo))
                                <img src="{{ $photo->temporaryUrl() }}">
                            @elseif($imageUrl)
                                <img src="{{ asset('storage/images/' .$imageUrl )}}">
                            @endif
                        </div>
                    </div>
                </div>
                <div x-data="{saveButtonDisabled: @entangle('saveButtonDisabled')}" class="flex justify-between mt-2">
                    <button x-bind:disabled="saveButtonDisabled" class="btn"
                            :class="{'btn-success': saveButtonDisabled == false, 'btn-disabled': saveButtonDisabled == true}"
                            type="submit">Save Photo
                    </button>
                    <button wire:click="resetToOriginal" class="btn btn-secondary text-white" type="button">Reset
                        Photo
                    </button>
                </div>
            </form>
        </div>

    </div>
</div>