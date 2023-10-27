<div>
  <div class="p-4 mt-2 bg-white rounded-lg border">
    <div class="pb-1">
      <h2 class="font-bold">Select Address:</h2>
    </div>
    @if($addresses)
      <div>
        <label for="address"></label>
        <select
            name=""
            id=""
            class="w-full capitalize rounded text-[11px]"
            wire:model.live="selectedAddressId"
        >
          @foreach($addresses as $address)
            <option
                value="{{ $address->id }}"
            >{{ $address->fullAddress() }}</option>
          @endforeach
        </select>
      </div>
      
      <div class="py-1">
        <h2 class="font-medium">- or - </h2>
      </div>
    @endif
    
    <div class="pb-1">
      <h2 class="font-bold">Add Address:</h2>
    </div>
    
    <form
        wire:submit="store"
        class="text-[12px]"
    >
      <div class="pb-2">
        <label
            for="line_one"
            class="text-[11px]"
        >Street Address</label>
        <input
            type="text"
            wire:model.live="line_one"
            class="w-full text-sm rounded"
        >
      </div>
      
      <div class="pb-2">
        <label
            for="line_two"
            class="text-[11px]"
        >Apartment / Building / Unit Number</label>
        <input
            type="text"
            wire:model.live="line_two"
            class="w-full text-sm rounded"
        >
      </div>
      
      <div class="pb-2">
        <label
            for="suburb"
            class="text-[11px]"
        >Suburb</label>
        <input
            type="text"
            wire:model.live="suburb"
            class="w-full text-sm rounded"
        >
      </div>
      
      <div class="pb-2">
        <label
            for="city"
            class="text-[11px]"
        >City</label>
        <input
            type="text"
            wire:model.live="city"
            class="w-full text-sm rounded"
        >
      </div>
      
      <div class="pb-2">
        <label
            for="city"
            class="text-[11px]"
        >Province</label>
        <div>
          <select
              wire:model.live="province"
              required
              class="w-full text-sm capitalize rounded"
          >
            <option value="">Choose</option>
            @foreach($provinces as $province)
              <option value="{{$province}}">{{ $province }}</option>
            @endforeach
          </select>
        </div>
      </div>
      
      <div class="pb-2">
        <label
            for="postal_code"
            class="text-[11px]"
        >Postal Code</label>
        <input
            type="text"
            wire:model.live="postal_code"
            class="w-full text-sm rounded"
        >
      </div>
      
      <div class="pb-2">
        <x-button class="w-full button-green">
          save address
        </x-button>
      </div>
    
    </form>
  
  </div>
  
  @if($deliveryOptions)
    <div class="p-4 mt-2 bg-white rounded-lg border">
      <div>
        <div class="mb-2">
          <h2 class="font-bold">Select a delivery option:</h2>
        </div>
        <div class="flex-col space-y-3">
          @foreach($deliveryOptions as $delivery)
            <label
                for="delivery-{{$delivery->id}}"
                class="flex justify-between items-center py-2 px-1 w-full rounded button-green"
            >
              <div class="flex items-center space-x-3">
                <input
                    type="radio"
                    value="{{ $delivery->id }}"
                    id="delivery-{{$delivery->id}}"
                    wire:model.live="delivery_id"
                    name="delivery_type_id"
                >
                <p class="text-left">{{ $delivery->description }}</p>
              </div>
              <p>
                R {{ number_format($delivery->getPrice($this->order->getSubTotal()),2) }}
              </p>
            </label>
          @endforeach
        </div>
      </div>
    </div>
  @endif
  
  <div class="p-4 mt-2 bg-white rounded-lg border">
    <x-button
        class="w-full button-green"
        wire:click="placeOrder"
    >
      Place order and proceed to payment
    </x-button>
  </div>


</div>
