<div>
    <div class="container-lg mx-auto">
        <div class="flex">
            <div class="flex-1" style=" border-right: 1px dashed #999; padding-right: 1rem; height: 500px;">
                <div class="flex pl-2 mb-4" style="font-size: 0.85rem; border-bottom: 1px solid #999;">
                    Status: <span wire:click="clearStatusMessage"
                                  style="padding-left: 1rem; color: red; font-size: 0.8rem;">{{ $statusMessage }}</span>
                </div>
                <form wire:submit.prevent="save">
                    <div>
                        <input type="file" wire:model="photo">
                        @error('photo') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <div x-data="{saveButtonDisabled: @entangle('saveButtonDisabled')}"
                         class="flex justify-between mt-8">
                        <button x-bind:disabled="saveButtonDisabled" class="btn"
                                :class="{'btn-success': saveButtonDisabled == false, 'btn-disabled': saveButtonDisabled == true}"
                                type="submit">Save Photo
                        </button>
                        <button wire:click="resetToOriginal" class="btn btn-secondary text-white" type="button">Reset
                        </button>
                    </div>
                </form>
                <div style="margin-top: 16rem">
                    <ul>
                        <li>Stores images in the storage/app/public/graphics folder</li>
                        <li>For use in Posts in the wysiwyg editor</li>
                        <li>Graphics can be linked to using "/storage/graphics/image_name.jpg" etc.</li>
                    </ul>
                </div>
            </div>
            <div class="flex-1">
                <div style="max-width: 500px; max-height: 500px;" class="p-4 ml-4 flex">
                    @if (isset($photo))
                        <img src="{{ $photo->temporaryUrl() }}">
                    @elseif($imageUrl)
                        <img src="{{ asset('storage/graphics/' .$imageUrl )}}">
                    @endif
                </div>

            </div>
        </div>
    </div>
</div>