<?php ?>
<footer class="sticky-footer">
               <div class="container">
                  <div class="row no-gutters">
                     <div class="col-lg-6 col-sm-6">
                        <p class="mt-1 mb-0">© Copyright 2020 <strong class="text-dark">Engage Geeks</strong>. All Rights Reserved<br>
                       
                        </p>
                     </div>
                     <div class="col-lg-6 col-sm-6 text-right">
                        <div class="app">
                           <a href="javascript:void(0);"><img alt="" src="img/google.png"></a>
                           <a href="javascript:void(0);"><img alt="" src="img/apple.png"></a>
                        </div>
                     </div>
                  </div>
               </div>
            </footer>
 
         </div>
         <!-- /.content-wrapper -->
      </div>
      <!-- /#wrapper -->
      <!-- Scroll to Top Button-->
      <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
      </a>
      <!-- Logout Modal-->
      <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                  <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                  </button>
               </div>
               <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
               <div class="modal-footer">
                  <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                  <a class="btn btn-primary" href="customer/logout">Logout</a>
               </div>
            </div>
         </div>
      </div>
      <!-- Bootstrap core JavaScript-->
<?php if($pageurl=="https://www.engagegeeks.com/") { ?>
	  <script src="https://cdnjs.cloudflare.com/ajax/libs/react/16.13.1/umd/react.production.min.js"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/react-dom/16.13.1/umd/react-dom.production.min.js"></script>
<script>
const DonutChart = props => {
  const cx = 50;
  const cy = 50;
  const strokeWidth = 20;
  const radius = 30;
  const dashArray = 2 * Math.PI * radius;
  const startAngle = -90;

  let filled = 0;

  const sum = donut.reduce((sum, item) => {
    return sum + item.value;
  }, 0);

  const ratio = 100 / sum;

  props.data.forEach(obj => {
    const itemRatio = ratio * obj.value;

    obj.itemRatio = itemRatio;
    obj.angle = filled * 360 / 100 + startAngle;
    obj.offset = dashArray - dashArray * itemRatio / 100;
    obj.filled = filled;

    filled += itemRatio;
  });

  return (
    React.createElement("div", { className: "donut-chart" },
    React.createElement("svg", { width: "300px", height: "300px", viewBox: "0 0 100 100" },
    props.data.map((item, index) =>
    React.createElement("circle", {
      key: index,
      cx: cx,
      cy: cy,
      r: radius,
      fill: "transparent",
      strokeWidth: strokeWidth,
      stroke: item.color,
      strokeDasharray: dashArray,
      strokeDashoffset: item.offset,
      transform: `rotate(${item.angle} ${cx} ${cy})` },

    React.createElement("animateTransform", {
      attributeName: "transform",
      attributeType: "XML",
      type: "rotate",
      from: `${startAngle} ${cx} ${cy}`,
      to: `${item.angle} ${cx} ${cy}`,
      dur: "1s" }),


    React.createElement("title", null,
    item.name, ": ", item.value)))),




    React.createElement("ul", { className: "items-names" },
    props.data.map((item, index) =>
    React.createElement("li", {
      key: index++,
      className: "item-name",
      style: {
        background: `linear-gradient(90deg, ${item.color} 0, ${item.color} 20px, transparent 20px, transparent 100%)` } },


    item.name)))));





};

const donut = [
{
  name: "New Delhi",
  color: "#05103b",
  value: 80 },

{
  name: "Bengaluru",
  color: "#2facff",
  value: 40 },

{
  name: "Noida",
  color: "#ffcf04",
  value: 40 },

{
  name: "Gurgaon",
  color: "#ff8900",
  value: 40 },
  
  {
  name: "Malappuram",
  color: "#800000",
  value: 22 },
  

{
  name: "Mumbai",
  color: "#ff3838",
  value: 40 }];



const App = props => {
  return React.createElement(DonutChart, { data: donut });
};

ReactDOM.render(React.createElement(App, null), document.getElementById("root"));
</script>
<?php } ?>
<script src="js/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
 <link rel="stylesheet" href="https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css">

 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css">

<script src="https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/1.0.7/js/dataTables.responsive.min.js"></script>
<!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"></script>-->

<script>

$(document).ready(function() {
    $('#example').DataTable();
	$('#example1').DataTable();
} );
</script>
<?php echo $extra_js;?>
 <?php if($pageurl=="https://www.engagegeeks.com/customer/myaccount") { ?>


 <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
     <script>
     $(document).ready(function() {
    $('.countries').select2();
   $('.states').select2();
   $('.cities').select2();
});
     </script>
     <script src="js/location.js"></script> 
     <?php } ?>
       
      <script src="js/bootstrap.bundle.min.js"></script>
      <!-- Core plugin JavaScript-->
      <script src="js/jquery.easing.min.js"></script>
      <!-- Owl Carousel -->
      <script src="js/owl.carousel.js"></script>
      <!-- Custom scripts for all pages-->
      <script src="js/custom.js"></script>
      
   </body>
</html>



