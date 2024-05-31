
function viewDashbord(){  
    $.ajax({
        url:"./adminView/dashbord.php",
        method:"post",
        data:{record:1},
        success:function(data){
            $('.allContent-section').html(data);
        }
    });
}
function viewMap(){  
    $.ajax({
        url:"./adminView/map.php",
        method:"post",
        data:{record:1},
        success:function(data){
            $('.allContent-section').html(data);
        }
    });
}

function viewCows(){  
    $.ajax({
        url:"./adminView/cows.php",
        method:"post",
        data:{record:1},
        success:function(data){
            $('.allContent-section').html(data);
        }
    });
}

function viewSheeps(){  
    $.ajax({
        url:"./adminView/sheeps.php",
        method:"post",
        data:{record:1},
        success:function(data){
            $('.allContent-section').html(data);
        }
    });
}

function viewStock(){  
    $.ajax({
        url:"./adminView/stock/index.php",
        method:"post",
        data:{record:1},
        success:function(data){
            $('.allContent-section').html(data);
        }
    });
}