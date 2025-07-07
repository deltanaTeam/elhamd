<script type="text/javascript">
$(document).ready(function () {
    if ($('#{{ $id }}').length > 0) {
        $('#{{ $id }}').DataTable({
            processing: true,
            serverSide: true,
            language: {
                paginate: {
                    previous: "{{ __('lang.previous') }}",
                    next: "{{ __('lang.next') }}"
                },
                emptyTable: "{{ __('lang.empty_table') }}",
                infoEmpty: "{{ __('lang.info_empty') }}",
                infoFiltered: "({{ __('lang.filtered_from') }} _MAX_ {{ __('lang.total_entries') }})",
                lengthMenu: "{{ __('lang.show') }} _MENU_ {{ __('lang.entries') }}",
                search: "{{ __('lang.search') }}:",
                zeroRecords: "{{ __('lang.zero_records') }}",
                sInfo: "{{ __('lang.sInfo') }}",
                sInfoEmpty: "{{ __('lang.sInfoEmpty') }}"
            },
            dom: 'lBfrtip',
            buttons: [
                // { extend: 'copy', text: '{{ __("lang.copy") }}' },
                // { extend: 'csv', text: '{{ __("lang.csv") }}' },
                // { extend: 'excel', text: '{{ __("lang.excel") }}' },
                { extend: 'pdf', text: '{{ __("lang.pdf") }}' },
                { extend: 'print', text: '{{ __("lang.print") }}' }

            ],
            ajax: {
                url: "{{ $ajax_url }}",
                type: 'GET',
                data: function (d) {
                                     }
            },
            columns: {!! json_encode($datatable_columns) !!},
            order: [[0, 'desc']]
        });
    }
});
</script>
