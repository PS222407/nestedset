<div>
    <input wire:model='customerName' type="text" placeholder="Customer firstname">

    @foreach ($products as $product)
        <p>{{ $product->name }}</p>
    @endforeach
</div>
