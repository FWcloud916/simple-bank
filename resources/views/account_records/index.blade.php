<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            帳戶資訊
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <table class="table-auto w-full border-2">
                        <thead class="bg-gray-300">
                            <tr class="border-b">
                                <th class="text-left p-2">用戶 ID</th>
                                <th class="text-left p-2">帳號</th>
                                <th class="text-left p-2">存款金額</th>
                                <th class="text-left p-3">詳細資料</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-b">
                                <td class="p-2">{{ $data['id'] }}</td>
                                <td class="p-2">{{ $data['account'] }}</td>
                                <td class="p-2">{{ $data['balance'] }}</td>
                                <td class="p-3">
                                    <a class="text-white bg-blue-600 p-2 hover:bg-blue-500 rounded" href="{{ route('accounts.show', $data['id']) }}">
{{--                                        <x-application-logo class="block h-10 w-auto fill-current text-gray-600" />--}}
                                        查看
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
