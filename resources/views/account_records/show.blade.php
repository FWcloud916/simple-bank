<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            帳戶明細
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <table class="table-auto w-full border-2">
                        <thead class="bg-gray-300">
                            <tr class="border-b">
                                <th class="text-left p-2">金額</th>
                                <th class="text-left p-2">存款金額</th>
                                <th class="text-left p-2">日期</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($records as $record)
                                <tr class="border-b">
                                    <td class="p-2">{{ $record->amount_change }}</td>
                                    <td class="p-2">{{ $record->balance }}</td>
                                    <td class="p-2">{{ $record->created_at }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
