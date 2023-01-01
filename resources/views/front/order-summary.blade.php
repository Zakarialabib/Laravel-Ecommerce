@section('title', __('Thank you for your order'))

<x-app-layout>
    @livewire('front.thank-you', ['order' => $order], key($order->id))
</x-app-layout>