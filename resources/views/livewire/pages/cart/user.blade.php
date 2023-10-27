<div class="p-4 bg-white rounded-lg border">
  
  <div class="pb-1">
    <h2 class="font-bold">To:</h2>
  </div>
  
  <form
      wire:submit="update"
      class="text-[12px]"
  >
    <div class="pb-2">
      <label
          for="name"
          class="text-[11px]"
      >Full Name</label>
      <input
          type="text"
          wire:model.blur="name"
          class="w-full text-sm rounded"
      >
    </div>
    
    <div class="pb-2">
      <label
          for="phone"
          class="text-[11px]"
      >Contact Number</label>
      <input
          type="text"
          wire:model.blur="phone"
          class="w-full text-sm rounded"
      >
    </div>
    
    <div class="pb-2">
      <label
          for="email"
          class="text-[11px]"
      >Email</label>
      <input
          type="email"
          wire:model.blur="email"
          class="w-full text-sm rounded"
      >
    </div>
    
    <div class="pb-2">
      <label
          for="company"
          class="text-[11px]"
      >Company (Optional)</label>
      <input
          type="text"
          wire:model.blur="company"
          class="w-full text-sm rounded"
      >
    </div>
    
    <div class="pb-2">
      <label
          for="company"
          class="text-[11px]"
      >VAT Number (Optional)</label>
      <input
          type="text"
          wire:model.blur="vat_number"
          class="w-full text-sm rounded"
      >
    </div>
  </form>
</div>
