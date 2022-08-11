<div wire:model="visitors">
    <div class="flex flex-center--all ml-auto text-xl">{{ $visitors->count() }} {{ $visitors->count() == 1 ? 'entry' : 'entries' }}</div>
    <div class="flex justify-between flex-wrap pb-8 pt-8">
        <div class="flex flex-center--all">
            <b>Group by: </b>
            <button wire:click="$set('groupBy', 'remote_addr')"
                    class="ml-2 btn {{ $groupBy == 'session_id' ? 'btn-secondary' : 'btn-success' }}">IP
            </button>
            <button wire:click="$set('groupBy', 'session_id')"
                    class="ml-2 btn {{ $groupBy == 'session_id' ? 'btn-success' : 'btn-secondary' }}">Session
            </button>
            <div class="flex-center--all">
                <span class="text-bold ml-8 mr-4">Filters: </span>
                Visitors <input wire:model="visits" class="mr-4" type="checkbox">
                Errors <input wire:model="errors" class="mr-4" type="checkbox">
                Bots <input wire:model="bots" class="mr-4" type="checkbox">
            </div>
        </div>
        <button wire:click="deleteAll()" class="btn btn-danger">Delete all stats</button>
    </div>
    @if( ! empty($visitors))
        @foreach($visitors as $visitor)
            <div x-data="{show: true}" class="mb-8 pt-4 pr-4 pl-4 pb-1" style="border: 1px solid #666; background: #f3f3f3;">
                <div class="flex justify-between pb-4 mb-2" style="border-bottom: 1px solid #999;">
                    <div class="flex-1 align-items-center text-md">
                        <b>Visits:</b> {{ $visitor->count() }}<br>
                        @if($groupBy == 'session_id')
                            <b>Session ID:</b> {{ $visitor->first()->session_id }}
                        @else
                            <b>IP:</b> {{ $visitor->first()->remote_addr }}
                        @endif
                        <br>
                        <b>Agent: </b> {{ $visitor->first()->http_user_agent }}
                        <br><br>
                    </div>
                    <div class="flex-1 flex align-items-start justify-end">
                        <button
                                x-on:click="show = !show"
                                x-text="show == true ? 'Hide' : 'Show'"
                                type="button" class="btn-sm btn-primary mr-8"></button>
                        <button wire:click="delete('{{ $visitor->first()->$groupBy }}')" class="btn-sm btn-danger">Delete</button>
                    </div>
                </div>
                <table
                        x-show.transition="show"
                        class="responsive_table"
                >
                    <thead>
                    <tr>
                        <th class="text-left">Time</th>
                        <th class="text-left">Visited</th>
                        <th class="text-left">From</th>
                        <th>Status</th>
                        <th>Search term</th>
                        <th>Method</th>
                        <th>Query</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($visitor as $visit)
                        <tr>
                            <td class="w-2/12">
                                @if($loop->first)
                                    {{ publicationDateTime($visit->created_at) }}
                                @else
                                    Then, {{ $visit->created_at->diffForHumans($visitor[$loop->index - 1]->created_at, 1, false, 2) }}
                                    later
                                @endif
                            </td>
                            <td class="w-2/12"> {{ $visit->request_uri == '/' ? 'homepage' : ltrim($visit->request_uri, '/') }}</td>
                            <td class="w-3/12">{{ $visit->request_uri  == '/' ? 'homepage' : ltrim(str_replace(request()->getSchemeAndHttpHost() , '', $visit->http_referer), '/') }}</td>
                            <td class="w-1/12 text-center"><span
                                        style="background: {{ $visit->status_code >= 400 ? 'red' : 'green' }}; color: white; padding: 0.35rem 0.75rem; border-radius: 7px;">{{ $visit->status_code }}</span>
                            </td>
                            <td class="w-2/12">{{ $visit->search_term }}</td>
                            <td class="w-1/12 text-center">{{ $visit->request_method }}</td>
                            <td class="w-1/12">{{ $visit->query_string }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">[ No entries ]</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        @endforeach
    @endif
</div>