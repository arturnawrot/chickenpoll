<div class="shadow mb-5 bg-white rounded">
    <div class="pt-3 pl-3 pb-3">
        <span style="font-size:1.1rem;font-weight:500;color:#424242;">New voters</span>
    </div>
    <table class="table" style="font-size:0.8rem;">
        <tbody>
            <?php $responses = $poll->responses()->paginate(10); ?>
            @foreach($responses as $response)
                <?php
                    $visitor = $response->visitor();
                ?>
                @if($visitor === null)
                    @continue
                @endif
                <tr>
                    <td><span class="flag-icon flag-icon-{{ strtolower($visitor->country_code) }}"></span> {{ $visitor->country }}, {{ $visitor->city }}</td>
                    <td>{{ Helper::time_elapsed_string($visitor->created_at->toString()) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $responses->links('pagination::simple-bootstrap-4') }}
</div>
