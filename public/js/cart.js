//cart count price function
$(document).ready(function(){

    //for pizza order decrease
    $('.btn-minus').click(function(){
        $parentNode = $(this).parents("tr");
        $price = Number($parentNode.find('#price').text().replace(" MMK",""));
        $quantity = Number($parentNode.find('#qty').val());
        $total = $price * $quantity;
        $parentNode.find('#total').html($total+" MMK");
        // main summary total calculation
        summaryCalculation();
    })

    //for pizza order increase
    $('.btn-plus').click(function(){
        $parentNode = $(this).parents("tr");
        $price = Number($parentNode.find('#price').text().replace(" MMK",""));
        $quantity = Number($parentNode.find('#qty').val());
        $total = $price * $quantity;
        $parentNode.find('#total').html($total+" MMK");
        // main summary total calculation
        summaryCalculation();
    })

    //for remove order
    $('.btnRemove').click(function(){
        $parentNode = $(this).parents("tr").remove();
        summaryCalculation();
    })

    // main summary total calculation
    function summaryCalculation() {
        $totalPrice = 0 ;
        $('#dataTable tbody tr').each(function(index,row){
            $totalPrice += Number($(row).find('#total').text().replace(" MMK",""));
        });

        $('#subTotal').html(`${$totalPrice} MMK`);
        $('#finalPrice').html(`${$totalPrice + 2000} MMK`);
    }
})
