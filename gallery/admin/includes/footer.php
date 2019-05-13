  </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
  <!-- WYSIWYG text editor -->
  <script src="https://cloud.tinymce.com/5/tinymce.min.js"></script>
  <script src="js/scripts.js"></script>

  <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

          var data = google.visualization.arrayToDataTable([
              ['Task', 'Hours per Day'],
              ['Views',     <?php echo $session->count; ?>],
              ['Photos',      <?php echo Photo::COUNT_ALL(); ?>],
              ['Users',  <?php echo User::COUNT_ALL(); ?>],
              ['Comments', <?php echo Comment::COUNT_ALL(); ?>],
          ]);

          var options = {
              title: 'My Daily Activities',
              pieSliceText: 'label',
              legend: 'none',
              backgroundColor: 'transparent'
          };

          var chart = new google.visualization.PieChart(document.getElementById('piechart'));

          chart.draw(data, options);
      }
  </script>

</html>
