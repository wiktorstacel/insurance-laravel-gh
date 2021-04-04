<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>       
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        
        <title>Datatables Server Side Processing in Laravel</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
        <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>-->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
        <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>       
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    </head>
    <body>

        <div class="container">
            <br />
            <h3 align="center">Datatables Server Side Processing in Laravel</h3>
            <br />
            <div align="right">
                <a href="/student"><button type="button" class="btn btn-primary btn-sm">Student</button></a>
                <button type="button" name="add" id="add_data" class="btn btn-success btn-sm">Add</button>
            </div>
            <table id="student_table" class="table table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                    </tr>
                </thead>
            </table>
        </div>
        
        <div id="studentModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="post" id="student_form">
                        <div class="modal-header">
                           <button type="button" class="close" data-dismiss="modal">&times;</button>
                           <h4 class="modal-title">Add Data</h4>
                        </div>
                        <div class="modal-body">
                            {{csrf_field()}}
                            <span id="form_output"></span>
                            <div class="form-group">
                                <label>Enter First Name</label>
                                <input type="text" name="first_name" id="first_name" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label>Enter Last Name</label>
                                <input type="text" name="last_name" id="last_name" class="form-control" />
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="button_action" id="button_action" value="insert" />
                            <input type="submit" name="submit" id="action" value="Add" class="btn btn-info" />
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div> 

        <script type="text/javascript">
            //https://stackoverflow.com/questions/32738763/laravel-csrf-token-mismatch-for-ajax-post-request
            $(document).ready(function () {
                
                /*$.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });*/
                
                $('#student_table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: "{{route('ajaxdata.getdata')}}", //"ajaxdata/getdata",//
                        //contentType: "application/json; charset=utf-8",
                        //dataType: "json",
                        /*success: function (response) {
                            console.log("jestem");
                        },*/
                        //"dataType" :"json",
                        type:"GET",
                        /*error: function (error) {
                        alert(error);
                        }*/
                        //"contentType": "application/x-www-form-urlencoded; charset=UTF-8",
                    },
                    columns: [
                        {data: "first_name"},
                        {data: "last_name"}
                    ]
                });
                
                $('#add_data').click(function(){
                $('#studentModal').modal('show');
                $('#student_form')[0].reset();
                $('#form_output').html('');
                $('#button_action').val('insert');
                $('#action').val('Add');
                }); 
                
                $('#student_form').on('submit', function(event){
                    event.preventDefault();
                    var form_data = $(this).serialize();
                    $.ajax({
                        /*headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },*/
                        url:"{{ route('ajaxdata.postdata') }}",//"ajaxdata/postdata",//
                        method:"POST",
                        data:form_data,
                        /*data: {
                            "_token": "{{ csrf_token() }}",
                            "form_data": form_data
                        },*/
                        dataType:"json",
                        //headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        success:function(data)
                        {
                            if(data.error.length > 0)
                            {
                                var error_html = '';
                                for(var count = 0; count < data.error.length; count++)
                                {
                                    error_html += '<div class="alert alert-danger">'+data.error[count]+'</div>';
                                }
                                $('#form_output').html(error_html);
                            }
                            else
                            {
                                $('#form_output').html(data.success);
                                $('#student_form')[0].reset();
                                $('#action').val('Add');
                                $('.modal-title').text('Add Data');
                                $('#button_action').val('insert');
                                $('#student_table').DataTable().ajax.reload();
                            }
                        }
                    })
                });
                
            });
            

            
            
            
        </script>

    </body>
</html>

