
 $('.confirmation').on('click', function () {
                return confirm('Are you sure you want do delete this user?');
            });
//GET Shopper By Id
 function myFunction() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("myTable");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[0];
                if (td ) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                       tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
 }
 // CREATE A NEW ORDER BY SHOPPER ID
$(document).ready(function(){
    $('#searchUser').click(function(){
         var id =$('input[name="orderId"]').val();
         window.location.href = location.origin + `/PHP_COURSE_FILES/interview/Fisha_store/orderForm.php?id=${id}`;
         return
    })
})

//GET SHOPPER ORFERS
$(document).ready(function(){
 $('#search').click(function(){
  var id= $('#employee_list').val();
  
  if(id != '')
  {
   $.ajax({
    url:"getOrders.php",
    method:"POST",
    data:{id:id},
    dataType:"JSON",
    success:function(data)
    {
     $('#employee_details').css("display", "block");
     $('#orderId').text(data.orderId);
     $('#userId').text(data.userId);
     $('#orderTotal').text(data.orderTotal);
     $('#created_at').text(data.created_at);
     id= "0";
     
    }
   })
  }
  else
  {
   alert("Please Select Employee");
   $('#employee_details').css("display", "none");
  }
 });
});

// SAVED THE ORDER FORM
function saveForm(){
    var id =$('input[name="userId"]').val();
    var idString = JSON.stringify(id)
    var orderTotal =$('#orderTotal').val();
    var orderTotalString = JSON.stringify(orderTotal);
    $.ajax({
        url:"classes/Order.php",
        method : "POST",
        data :{
            id:idString,
            orderTotal:orderTotalString
        },
        success: function(data){
               alert(data)
        }
    })
}
$('#save_order').click(function(){
 if (orderTotal =! null ){
    return
 }else{
         alert("please enter total order to create a order ");
      }
})

