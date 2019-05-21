<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>php-id-w10</title>
        <!-- Bootstrap -->
        <link href="bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css">
        <link href="bootstrap/css/bootstrap-theme.css" rel="stylesheet" type="text/css">
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="bootstrap/js/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="bootstrap/js/bootstrap.min.js"></script>        
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="bootstrap/js/html5shiv.min.js"></script>
            <script src="bootstrap/js/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>        
        <div class="container">
            <div class="row"> 
                <div class="jumbotron" style="background-color: cornflowerblue;">
                    <?php include 'topbanner.php';?>
                </div>
            </div>
            <div class="row">
                <?php include 'menu.php';?>
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-3 col-lg-3">
                    <p>Login Area</p>
                </div>  
                <div class="col-sm-12 col-md-9 col-lg-9">
                    <h4>แก้ไขข้อมูลประเภทหนังสือ</h4>
                    <?php
                        $bd_id = $_REQUEST['bd_id'];
                        if(isset($_GET['submit'])){
                            $bd_id = $_GET['bd_id'];
                            $bd_bt_id = $_GET['bd_bt_id'];
                            $bd_name = $_GET['bd_name'];
                            $bd_size = $_GET['bd_size'];
                            $bd_weight = $_GET['bd_weight'];
                            $bd_date = $_GET['bd_date'];
                            $bd_prize = $_GET['bd_prize'];
                            $sql = "update book_det set ";
                            $sql .= "bd_id='$bd_id',bd_name='$bd_name',bd_bt_id='$bd_bt_id',bd_size='$bd_size',bd_weight='$bd_weight',bd_date='$bd_date',bd_prize='$bd_prize',bd_bt_id='$bd_bt_id'";
                            $sql .="where bd_id='$bd_id' ";
                            include 'connectdb.php';
                            mysqli_query($conn,$sql);
                            mysqli_close($conn);
                            echo "แก้ไขข้อมูลนักศึกษา $bd_name $bd_size $bd_weight $bd_prize $bd_date  เรียบร้อยแล้ว<br>";
                            echo '<a href="book_det_list.php">แสดงรายชื่อนักศึกษาทั้งหมด</a>';
                        }else{
                    ?>
                    <form class="form-horizontal" role="form" name="book_det_edit" action="<?php echo $_SERVER['PHP_SELF'];?>">
                        <div class="form-group">
                            <input type="hidden" name="bd_id" id="bd_id" value="<?php echo "$bd_id";?>">
                            <label for="bd_bt_id" class="col-md-2 col-lg-2 control-label">คำนำหน้าชื่อ</label>
                            <div class="col-md-10 col-lg-10">
                                <select name="bd_bt_id" id="bd_bt_id" class="form-control">
                                <?php
                                    include 'connectdb.php';
                                    $sql2 = "select * from book_det where bd_id='$bd_id'";
                                    $result2 = mysqli_query($conn,$sql2);
                                    $row2 = mysqli_fetch_array($result2,MYSQLI_ASSOC);
                                    $fbd_id = $row2['bd_id'];
                                    $fbd_name = $row2['bd_name'];
                                    $fbd_size = $row2['bd_size'];
                                    $fbd_weight = $row2['bd_weight'];

                                    $fbd_date = $row2['bd_date'];
                                    $fbd_prize = $row2['bd_prize'];
                                    $fbd_bt_id = $row2['bd_bt_id'];
                                    $sql =  "SELECT * FROM book_type order by bt_id";
                                    $result = mysqli_query($conn,$sql);
                                    while (($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) != NULL) {
                                        echo '<option value=';
                                        echo '"' . $row['bt_id'].'"';
                                        if($row['bt_id']==$fbd_bt_id){
                                            echo ' selected="selected" ';
                                        }
                                        echo ">";
                                        echo $row['bt_name'];
                                        echo '</option>';
                                    }
                                    mysqli_free_result($result);
                                    mysqli_close($conn);
                                ?>
                                </select>
                           </div>    
                        </div>
                      
                        <div class="form-group">
                            <label for="bd_id" class="col-md-2 col-lg-2 control-label">รหัสหนังสือ</label>
                            <div class="col-md-10 col-lg-10">
                                <input type="text" name="bd_id" id="bd_id" class="form-control" 
                                       value="<?php echo $fbd_id;?>">
                            </div>    
                        </div> 
                        <div class="form-group">
                            <label for="bd_name" class="col-md-2 col-lg-2 control-label">ชื่อหนังสือ</label>
                            <div class="col-md-10 col-lg-10">
                                <input type="text" name="bd_name" id="bd_name" class="form-control" 
                                       value="<?php echo $fbd_name;?>">
                            </div>    
                        </div> 
                        <div class="form-group">
                            <label for="bd_size" class="col-md-2 col-lg-2 control-label">ขนาด</label>
                            <div class="col-md-10 col-lg-10">
                                <input type="text" name="bd_size" id="bd_size" class="form-control" 
                                       value="<?php echo $fbd_size;?>">
                            </div>    
                        </div> 
                  
                      
                        <div class="form-group">
                            <label for="bd_weight" class="col-md-2 col-lg-2 control-label">น้ำหนัก</label>
                            <div class="col-md-10 col-lg-10">
                                <input type="text" name="bd_weight" id="bd_weight" class="form-control" 
                                       value="<?php echo $fbd_weight;?>">
                            </div>    
                        </div> 
                       
                        <div class="form-group">
                            <label for="bd_date" class="col-md-2 col-lg-2 control-label">วดป</label>
                            <div class="col-md-10 col-lg-10">
                                <input type="text" name="bd_date" id="bd_date" class="form-control" 
                                       value="<?php echo $fbd_date;?>">
                            </div>    
                        </div> 
                        <div class="form-group">
                            <label for="bd_prize" class="col-md-2 col-lg-2 control-label">ราคา</label>
                            <div class="col-md-10 col-lg-10">
                                <input type="text" name="bd_prize" id="bd_prize" class="form-control" 
                                       value="<?php echo $fbd_prize;?>">
                            </div>    
                        </div> 
                        <div class="form-group">
                            <div class="col-md-10 col-lg-10">
                                <input type="submit" name="submit" value="ตกลง" class="btn btn-default">
                            </div>    
                        </div> 
                    </form>
                    <?php
                        }
                    ?>
                </div>    
            </div>
            <div class="row">
                <address>คณะวิทยาการคอมพิวเตอร์และเทคโนโลยีสารสนเทศ</address>
            </div>
        </div>    
    </body>
</html>