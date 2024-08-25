<div>
    @if (is_null($appointment->rating))
    <div class="rating">
        <input type="radio" name="rating-{{ $appointment->id }}" id="rating-5-{{ $appointment->id }}" value="5" wire:model.live="rating" />
        <label for="rating-5-{{ $appointment->id }}"></label>

        <input type="radio" name="rating-{{ $appointment->id }}" id="rating-4-{{ $appointment->id }}" value="4" wire:model.live="rating" />
        <label for="rating-4-{{ $appointment->id }}"></label>

        <input type="radio" name="rating-{{ $appointment->id }}" id="rating-3-{{ $appointment->id }}" value="3" wire:model.live="rating" />
        <label for="rating-3-{{ $appointment->id }}"></label>

        <input type="radio" name="rating-{{ $appointment->id }}" id="rating-2-{{ $appointment->id }}" value="2" wire:model.live="rating" />
        <label for="rating-2-{{ $appointment->id }}"></label>

        <input type="radio" name="rating-{{ $appointment->id }}" id="rating-1-{{ $appointment->id }}" value="1" wire:model.live="rating" />
        <label for="rating-1-{{ $appointment->id }}"></label>
    </div>
    @endif
</div>