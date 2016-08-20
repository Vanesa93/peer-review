<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <title>Peer-Review</title>
        <link href="/css/app.css" rel="stylesheet">       
         <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.css">
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">
        <link href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css"  rel='stylesheet' type='text/css'>
        <link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script> 
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.1/js/bootstrap-datepicker.min.js"></script> 
        <script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/jquery.validate.js"></script>
        <script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/jquery.validate.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
        <script ype="text/javascript" src="http://cdn.jsdelivr.net/jquery.validation/1.15.0/additional-methods.min.js"></script>
        <script ype="text/javascript" src='https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js'></script>
        <script ype="text/javascript" src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
    </head>
    <body style="background: #e6eeff">
        @include('partials.header') 
        <!-- Scripts -->

        <div  style=" position: relative;padding-top: 80px;">
            @yield('content')
            @yield('welcome')
            @yield('upload')
            @yield('files')
            @yield('courses')
            @yield('create_courses')
            @yield('edit_course')
            @yield('users')
            @yield('edit_user')
            @yield('create_groups')
            @yield('get_groups')
            @yield('see_users_from_group')
            @yield('edit_group')
            @yield('faculties')
            @yield('majors')
            @yield('add_faculty')
            @yield('add_major')
            @yield('edit_faculty')
            @yield('edit_major')
            @yield('add_major_all_faculties')
            @yield('tasks')
            @yield('create_task')
            @yield('edit_task')
            @yield('students_to_task')
            @yield('lecturer_file')
            @yield('file_upload_tasks')
            @yield('reviews_lecturers')
            @yield('create_reviews_lecturers')
            @yield('edit_lecturer_review')
            @yield('view_task')
            @yield('mycourses')
            @yield('mygroups')
        </div>
    </body>
</html>
