
$(document).ready(function() {
    $('.plan2').click(function(){
         //$(".plan3").prop("checked", false);
         var default_price = 49;
         var plan_2_price = 49;
        //$(".plan3").prop("checked", false);
        //var plan1_price = 49;
        var plan2_menu_ids = [];
        $("input[name='plan2_menu']:checked").each(function() {
          plan_2_price += parseInt($(this).val()) || 0;
          //plan_2_price += plan1_price || 0;
          $('#plan_selected').val(2);
           var menu_id = $(this).attr('id');  
           var id = menu_id.split('_').pop(); 
           plan2_menu_ids.push(id);
        });

        $('#hidmenu2_id').val(plan2_menu_ids);

         var plan_3_price=0;
        $("input[name='plan3_menu']:checked").each(function() {
            //alert(parseInt($(this).val()));
          plan_3_price += parseInt($(this).val()) || 0;
          plan_3_price += parseInt(plan_2_price);
        });

        var plan_3_price = parseInt(plan_3_price);

        $('#plan2_price').html('₹'+plan_2_price+'/<small>Per Month</small>');
        $('#plan3_price').html('₹'+plan_3_price+'/<small>Per Month</small>');
        
        var checkedLength = $('input[name="plan2_menu"]:checked').length;
        if(checkedLength==0){
            $('#plan_selected').val(1);
            $('#plan2_price').html('₹'+0+'/<small>Per Month</small>');
        }
    });
    $('.plan3').click(function(){

        var plan_2_price=0;
        $("input[name='plan2_menu']:checked").each(function() {
            //alert(parseInt($(this).val()));
          plan_2_price += parseInt($(this).val()) || 0;
          //plan_2_price += plan1_price || 0;
          //$('#plan_selected').val(2);
        });

        var plan_3_price = parseInt(plan_2_price);
        plan_3_price += 49;
        plan_2_price += 49;
        //$(".plan2").prop("checked", true);
        //var plan1_price = 49;
        var plan3_menu_ids = [];
        $("input[name='plan3_menu']:checked").each(function() {
          plan_3_price += parseInt($(this).val()) || 0;
          //plan_3_price += plan1_price || 0;
          $('#plan_selected').val(3);

            var menu_id = $(this).attr('id');  
            var id = menu_id.split('_').pop(); 
            plan3_menu_ids.push(id);
        });

        $('#hidmenu3_id').val(plan3_menu_ids);

        $('#plan3_price').html('₹'+plan_3_price+'/<small>Per Month</small>');
        //$('#plan2_price').html('₹'+plan_2_price+'/<small>Per Month</small>');
        
        var checkedLength = $('input[name="plan3_menu"]:checked').length;
        if(checkedLength==0){
            $('#plan_selected').val(1);
            $('#plan3_price').html('₹'+0+'/<small>Per Month</small>');
        }
    });
});
// function planSettings() {
//     alert("Test");
// }
function restrictInput(input) {
    // Remove special characters and spaces
    input.value = input.value.replace(/[^a-z0-9]/g, '');
}