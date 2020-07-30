<!-- Content Header (Page header) -->
            <section class="content-header">
                <!--section starts-->
                <h1>Project Category List</h1>
                <ol class="breadcrumb">
                    <li>
                        <a href="index.html">
                            <i class="livicon" data-name="home" data-size="14" data-c="#000" data-loop="true"></i> Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="#">Project</a>
                    </li>
                    <li class="active">Project Category List</li>
                </ol>
            </section>
            <!--section ends-->
            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-primary ">
                            <div class="panel-heading clearfix">
                                <h4 class="panel-title pull-left"> <i class="livicon" data-name="users" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i> Blog Category List</h4>
                                <div class="pull-right">
                                <a href="{{ url('/add_category')}}" class="btn btn-sm btn-default"><span class="glyphicon glyphicon-plus"></span> Create</a>
                                </div>
                            </div>
                            <br />
                            <div class="panel-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Name</th>
                                            <th>Description</th>
                                            <th>Created at</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($category_project as $cat)
                                            <tr>
                                                <td>{{ $cat->id }}</td>
                                                <td>{{ $cat->name }}</td>
                                                <td>{{ $cat->description}}</td>
                                                <td>{{ $cat->created_at }}</td>
                                                <td>
                                                    <a href="edit_blog.html"><i class="livicon" data-name="edit" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="update blog"></i></a>
                                                    <a href="#" data-toggle="modal" data-target="#delete_confirm">
                                                        <i class="livicon" data-name="remove-alt" data-size="18" data-loop="true" data-c="#f56954" data-hc="#f56954" title="Delete blog category"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <!-- Modal for showing delete confirmation -->
                                <div class="modal fade" id="delete_confirm" tabindex="-1" role="dialog" aria-labelledby="user_delete_confirm_title" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                <h4 class="modal-title" id="user_delete_confirm_title">
                                                    Delete User
                                                </h4>
                                            </div>
                                            <div class="modal-body">
                                                Are you sure to delete this user? This operation is irreversible.
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                                <a href="#" class="btn btn-danger">Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--end of modal-->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- row-->
            </section>
            <!-- content -->