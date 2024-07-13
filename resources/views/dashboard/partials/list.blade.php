<section>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.css">
    <style>
        #notificationsTable_wrapper, #notificationsTable_wrapper tr th, #notificationsTable_wrapper tr td
        {
            border-color: white;
            color: white !important;
        }

        #notificationsTable_wrapper
        {
            margin-top: 20px;
        }
    </style>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Notifications') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('List of all reminders') }}
        </p>
    </header>

    <table id="notificationsTable" class="display" style="width: 100%;">
        <thead>
            <tr>
                <th>Title</th>
                <th>Content</th>
                <th>File</th>
                <th>Date</th>
                <th>Sent</th>
            </tr>
        </thead>
        <tbody>
            @foreach($notifications as $notification)
                <tr>
                    <td>{{$notification->title}}</td>
                    <td>{{$notification->content}}</td>
                    <td>{{$notification->file}}</td>
                    <td>{{\Carbon\Carbon::parse($notification->scheduled_at)->format('Y-m-d H:i:s')}}</td>
                    <td>@if($notification->sent) Yes @else No @endif</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <script>
        $(document).ready(function () {
            new DataTable('#notificationsTable');
        });
    </script>
</section>
