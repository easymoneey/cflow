<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Fun CaG</title>

  <!-- Custom fonts for this template-->
  <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">

  <link rel="stylesheet"
      href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.15.10/styles/default.min.css">

</head>

<body id="page-top">

  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Fun CAG</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Heading -->
      <div class="sidebar-heading">
        Files
      </div>

      <!-- Nav COG Item -->
      @foreach($codes['flist'] as $code)
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" onclick="outputFile('{{ $code }}');">
          <i class="fas fa-fw fa-cube"></i>
          <span>{{ $code }}</span>        
        </a>
      </li>
      @endforeach

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <!-- Nav Item - Messages -->
            <li class="nav-item dropdown no-arrow mx-1">
              <a class="navbar-brand mr-1" href="{{ url('/filelist/'.$id) }}">Files</a>
            </li>
            <li class="nav-item dropdown no-arrow mx-1">
              <a class="navbar-brand mr-1" href="{{ url('/analyze/'.$id) }}">Analyze</a>
            </li>
          </ul>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">
  
          <div class="row">

            <!-- Area Code -->
            <div class="col-xl-8 col-lg-7">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 id="mainfile" class="m-0 font-weight-bold text-primary"></h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                  <pre>
                      <code id="codeblocks">
                        <!-- your code here -->

                      </code>
                  </pre>
                </div>
              </div>
            </div>

            <!-- Area Project -->
            <div class="col-xl-4 col-lg-5">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Project Statistics</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-bordered" id="dataTables" width="100%" cellspacing="0">
                      <tbody>
                          <tr>
                            <td>Language: </td>
                            <td id="statLang"></td>
                          </tr>
                          <tr>
                            <td>Files: </td>
                            <td id="statFiles"></td>
                          </tr>
                          <tr>
                            <td>Folders: </td>
                            <td id="statFolder"></td>
                          </tr>
                          <tr>
                            <td>Methods: </td>
                            <td id="statMeth"></td>
                          </tr>
                          <tr>
                            <td>Recursive Methods: </td>
                            <td id="statRec"></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                </div>

              </div>
            </div>

          </div>

        </div>
      <!-- End of Main Content -->

    </div>
    <!-- /.content-wrapper -->

  </div>
  <!-- /#wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Bootstrap core JavaScript-->
  <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

  <!-- Core plugin JavaScript-->
  <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

  <!-- Page level plugin JavaScript-->
  <script src="{{ asset('vendor/chart.js/Chart.min.js') }}"></script>
  <script src="{{ asset('vendor/datatables/jquery.dataTables.js') }}"></script>
  <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.js') }}"></script>

  <!-- Custom scripts for all pages-->
  <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

  <!-- Demo scripts for this page-->
  <script src="{{ asset('js/demo/datatables-demo.js') }}"></script>

  <script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.15.10/highlight.min.js"></script>
  <script src="//cdn.jsdelivr.net/gh/TRSasasusu/highlightjs-highlight-lines.js@1.1.5/highlightjs-highlight-lines.min.js"></script>

  <script>
    hljs.initHighlightingOnLoad();

    function outputFile(linecode){
      var temp = funList(linecode);
      temp = temp[0].replace("(","").replace(")","").split(":");
      codeStatistics({{ $id }}, "{{ $codes['name'] }}");      

      $.get('/find/'+{{ $id }}+'/'+temp[0], function(response) {
          $("#codeblocks").html(response);
          $("#mainfile").html(temp[0]);
          
          hljs.initHighlightLinesOnLoad([
              [{start: temp[1]-1, end: temp[1]-1, color: '#999'}], // Highlight line code
          ]);          
        });
    }

    function funList(text) {
      var reglist = text.match(/\(.*?\)/g);
      reglist = reglist.filter(s=>~s.indexOf(":"));
      return reglist.reduce(function(a,b){
              if (a.indexOf(b) < 0 ) a.push(b);
              return a;
            },[]);
    }

    function codeStatistics(id, filename) {
      $("#statLang").html("{{ $csv[0]['language'] }}");
      $("#statFiles").html("{{ $stat['total_files'] }}");
      $("#statFolder").html("{{ $stat['total_folder'] }}");
      countRegex(id, filename);
    }    

    function countRegex(id, filename) {
      $.get('/filelist/'+id+'/'+filename, function(response) {
        $("#statMeth").html(response.split("*").length);
        $("#statRec").html(response.split("[R]").length);            
      });
    }
  </script>
</body>

</html>