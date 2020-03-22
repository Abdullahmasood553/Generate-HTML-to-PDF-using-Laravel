@extends('layouts.master')
@section('content')

  <!-- Navbar -->
<nav class="navbar navbar-expand-sm navbar-dark bg-dark p-0">
  <div class="container">
      <a href="" class="navbar-brand">ABNATION</a>
      <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
          <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
          <ul class="navbar-nav">
              <li class="nav-item px-2">
                  <a href="" class="nav-link active">Home</a>
              </li>
              <li class="nav-item px-2">
                <a href="" class="nav-link active">About</a>
            </li>
            <li class="nav-item px-2">
              <a href="" class="nav-link active">Contacts</a>
          </li>
          </ul>
      </div>
  </div>
</nav>


<!-- Add User Modal -->

<div class="modal fade" id="addUserModal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title">Add User</h5>
        <button class="close" data-dismiss="modal"><span>&times;</span></button>
      </div>
      <div class="modal-body">
        <form action="">
          @csrf
          <div class="form-group">
            <label for="title">First Name</label>
            <input type="text" name="fname" id="fname" class="form-control">
          </div>
          <div class="form-group">
            <label for="title">Last Name</label>
            <input type="text" name="lname" id="lname" class="form-control">
          </div>
          <div class="form-group">
            <label for="title">Email</label>
            <input type="text" name="email" id="email" class="form-control">
          </div>
          <div class="form-group">
            <label for="title">Contact</label>
            <input type="text" name="phone" id="phone" class="form-control">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button class="btn btn-dark save_user" data-dismiss="modal">Save</button>
      </div>
    </div>
  </div>
</div>

<!-- Tables -->

    <section id="posts" class="mt-4">
      <div class="container">
          <div class="row">
              <div class="col-md-9">
                  <div class="card">
                    <a href="" class="btn btn-secondary" data-toggle="modal" data-target="#addUserModal"><i class="fas fa-angle-double-right"></i>Add User</a>
                      <div class="card-header">
                          <h4>Users Listings</h4>
                      </div>
                        <div id="get_data"></div>
                  </div>
              </div>
              <div class="col-md-3">
                  <div class="card text-center bg-dark text-white mb-3">
                      <div class="card-body">
                          <h3>Posts</h3>
                          <h4 class="display-4">
                             <div class="total_users"></div>
                          </h4>
                          <a href="{{ route('pdf') }}"><i class="fa fa-print" style="font-size:36px; color: #fff"></i></a>
                      </div>
                  </div>
              </div>
          </div>
      </div>
    </section>
  @endsection



  @push('javascript')
    <script>
      $(document).ready(function() {
        getUserList();
        totalUsers();
        $('.save_user').on('click', function(e) {

          var fname = $('#fname').val();
          var lname = $('#lname').val();
          var email = $('#email').val();
          var phone = $('#phone').val();

          $.ajax({
            url: 'save_user',
            type: 'POST',
            data: {
              '_token': '<?= csrf_token() ?>',
              fname: fname,
              lname: lname,
              email: email,
              phone: phone
            },
            success:function(data) {
              if(data.success) {
                getUserList();
                totalUsers();
                console.log('success');
              } else {
                console.log('Error');
              }
            }
          });
        });
      });

  function totalUsers() {
    $.ajax({
      type: 'GET',
      url: 'total_users',
      success:function(response) {
        var response = JSON.parse(response);
        console.log(response);
        $('.total_users').text(response.length);
      }
    });
  }    

  function getUserList() {
    $.ajax({
        type: 'GET',
        url: 'userFetchList',
        success: function (response) {
            var response = JSON.parse(response);
            $('#get_data').empty();
            $('#get_data').append(`<table class="table table-striped userList">
              <thead class="thead-dark">
                  <tr>
                      <th>#</th>
                      <th>First Name</th>
                      <th>Last Name</th>
                      <th>Email</th>
                      <th>Phone</th>
                  </tr>
              </thead>
            <tbody>
        </tbody>
    </table>`);
        
              response.forEach(element => {
                  $('.userList tbody').append(`
                        <tr>
                            <td>${element.id}</td>
                            <td>${element.fname}</td>
                            <td>${element.lname}</td>
                            <td>${element.email}</td>
                            <td>${element.phone}</td>
                        </tr>`);
                    });
                  }
               });
            }
    </script>
  @endpush