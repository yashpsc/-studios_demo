<?php

session_start();
function test_input($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

if (isset($_POST['update']))
{
    $id = test_input($_POST['custid']);
    $date = date('d-m-Y H:i:s',time());
    $status = test_input($_POST['status']);
    $sql = "UPDATE enquire set created_date = '$date', status = '$status' where id = '$id' ";
    if ($conn->query($sql) === TRUE) 
    {
        $responseMessage = "Successfull Updated Enquiry Status";
    }
    else
    {
        $responseMessage = "Error updating record: " . $conn->error;
    }
}
if (isset($_POST['custid']))
{
    $id = test_input($_POST['custid']);
    $sql = "SELECT * From enquire Where id = $id";
    $result = $conn->query($sql);
    if ($result->num_rows>0)
    {
        $enquirerval = $result->fetch_assoc();
    }
}
 ?>
<div class="inner" style="">
    <div class="row">
        <div class="col-lg-12">

            <h2 style="margin-top: 25px;"> Update Enquiry Details </h2>
        </div>
    </div>

    <hr />

    <div class="">
        <div class="">
            <div class="">

                <div class="">
                    <div class="table-responsive" style=" width: 100%; overflow:scroll; max-height: 550px;">
                        <form method="post">
                            <input type="hidden" name="custid" value="<?php echo $_POST['custid']; ?>">
                            <div class="form-group form-inline">
				                <div class="row">
                                    <div class="col-sm-4">
        				                <table>
                                            <tr>
                                                <th><label for="text">Name:-</label></th>
                                                <td><input type="text" class="form-control" name="firstName" placeholder="FirstName" value="<?php echo (isset($enquirerval)?$enquirerval['name']:""); ?>"></td>
                                            </tr>
                                            <tr>
                                                <th><label for="text">Email:-</label></th>
                                                <td><input type="email" class="form-control" name="email" placeholder="Email" value="<?php echo (isset($enquirerval)?$enquirerval['email']:""); ?>"></td>
                                            </tr>
                                            <tr>
                                                <th><label for="text">Phone:-</label></th>
                                                <td><input type="text" class="form-control" name="number" placeholder="Number" value="<?php echo (isset($enquirerval)?$enquirerval['phone']:""); ?>"></td>
                                            </tr>
                                            <tr>
                                                <th><label for="text">Location:-</label></th>
                                                <td><input type="text" class="form-control" name="address" placeholder="Address" value="<?php echo (isset($enquirerval)?$enquirerval['location']:""); ?>"></td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="col-sm-4">
        				                <table>
                                            <tr>
                                                <th><label for="text">City:-</label></th>
                                                <td><input type="text" class="form-control" name="city" placeholder="City" value="<?php echo (isset($enquirerval)?$enquirerval['city']:""); ?>"></td>
                                            </tr>
        				                    <tr>
                                                <th> <label for="text">Pincode:-</label></th>
                                                <td><input type="text" class="form-control"  name="zip" placeholder="ZipCode" value="<?php echo (isset($enquirerval)?$enquirerval['pincode']:""); ?>"></td>
                                            </tr>
                                            <tr>
                                                <th><label for="text">IP Address:-</label></th>
                                                <td><input type="text" class="form-control" name="country" placeholder="Country" value="<?php echo (isset($enquirerval)?$enquirerval['ip']:""); ?>"></td>
                                            </tr>
                                        </table>
                                    </div>
        				            <div class="col-sm-4">
        				                <table>
                                            <!-- <div class="form-group form-inline"> -->
                                                <tr>
                                                    <th><label >status:-</label></th>
                                                    <td>
                                                        <select name="status" class="form-control">
                                                            <option value="Open" <?php if(isset($enquirerval) && ($enquirerval['status'] == 'Open') ){ echo 'selected'; } ?> >Open</option>
                                                            <option value="Closed" <?php if(isset($enquirerval) && ($enquirerval['status'] == 'Closed') ){ echo 'selected'; } ?> >Closed</option>
                                                            <option value="Pending" <?php if(isset($enquirerval) && ($enquirerval['status'] == 'Pending') ){ echo 'selected'; } ?> >Pending</option>
                                                        </select>  
                                                    </td>
                                                </tr> 
                                                <tr>
                                                    <th><label >Comments:-</label></th>
                                                    <td><?php echo (isset($enquirerval)?$enquirerval['comment']:""); ?></td>
                                                </tr>
                                                <tr><th><input type="submit" class="btn btn-success" name="update" style="margin-top:43px;"></th></tr> 
                                           <!--  </div> -->                
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                
            </div>
        </div>
    </div>

</div>