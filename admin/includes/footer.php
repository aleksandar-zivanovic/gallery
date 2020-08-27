  </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    
    <!-- TinyMCE text editor -->
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    
    <script src="js/scripts.js"></script>
    
    <!--Google Chart-->
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Category', 'Count'],
          ['Views',     <?php echo $session->count; ?>],
          ['Comments',  <?php echo Comment::count_all(); ?>],
          ['Users',     <?php echo User::count_all(); ?>],
          ['Photos',    <?php echo Photo::count_all(); ?>]
        ]);

        var options = {
          title: 'My Daily Activities',
          is3D: true,
          backgroundColor: 'transparent',
          legend: {position: 'left', textStyle: {fontSize: 16}, alignment: 'center'}, // Edwinov kod ima vrednost 'none
          pieSliceText: 'label'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));
        chart.draw(data, options);

      }
    </script>

    
    

</body>

</html>