<div class="table-responsive">
    <table id="{{ $id ?? 'data-table' }}" class="table table-bordered table-hover">
        <thead>
            <tr>
                @foreach($columns as $column)
                    <th class="{{ $column['class'] ?? '' }}">{{ $column['title'] }}</th>
                @endforeach
            </tr>
        </thead>
    </table>
</div>
