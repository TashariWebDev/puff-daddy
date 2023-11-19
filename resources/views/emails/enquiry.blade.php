<x-mail-layout>
    
    <div class="px-4 pt-10 w-full">
        <p class="text-lg font-bold">Hi admin</p>
        <p class="text-lg">
            You have received a new online enquiry.
        </p>
        <div class="py-6 text-lg">
            <p>Customer: {{ $data['name']}}</p>
            <p>Phone: {{ $data['phone']}}</p>
            <p>Email: {{ $data['email']}}</p>
            <p>Company: {{ $data['company'] ?? ''}}</p>
            <p>Message: {{ $data['message']}}</p>
        </div>
    
    </div>

</x-mail-layout>
