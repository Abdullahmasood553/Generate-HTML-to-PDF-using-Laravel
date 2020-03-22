<style>
    table,
    th,
    td {
        border: 1px solid black;
    }

</style>
<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6">

        <div class="col-md-6"><label><strong>Users Listing</strong></label></div>
        &nbsp;
        &nbsp;
            <table class="table table-bordered text-center ">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->fname }}</td>
                            <td>{{ $user->lname }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->phone }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
    </div>
    <div class="col-md-3"></div>
    <div class="clearfix"></div>
</div>
